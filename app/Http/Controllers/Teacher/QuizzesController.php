<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\QuizDegreesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SecondStepCreateCourseRequest;
use App\Http\Requests\StoreQuizFirstStepRequest;
use App\Models\BankGroup;
use App\Models\BankQuestion;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\QuizSection;
use App\Models\StudentsGroup;
use App\Models\User;
use App\Notifications\QuizAddedToCourse;
use App\Notifications\QuizAnswerHasBeenReviewed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Excel;

class QuizzesController extends Controller
{
    public function index(Course $course)
    {
        $quizzes = Quiz::where('course_id', $course->id)->get();
        return view('teacher.courses.quizzes.index', compact('course', 'quizzes'));
    }

    public function first_step_create(Course $course)
    {
        $groups = StudentsGroup::where('course_id', $course->id)->get();
        return view('teacher.courses.quizzes.first_step_create', compact('course', 'groups'));
    }

    public function first_step_store(Request $request, Course $course)
    {
        if ($request->quiz_type == 'group') {
            Session::put('group_id', $request->group_id);
        }
        return redirect()->route('teacher.courses.quizzes.create', $course->slug);
    }

    public function create(Course $course)
    {
        return view('teacher.courses.quizzes.create', compact('course'));
    }


    public function store(StoreQuizFirstStepRequest $request, Course $course)
    {
        $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('H:i');
        $startDateTime = Carbon::parse($start_date . $start_time);

        $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('H:i');
        $endDateTime = Carbon::parse($end_date . $end_time);
        if ($startDateTime >= $endDateTime) {
            session()->flash('error', 'Error');
            return redirect()->back();
        }
        $data = $request->validated();
        $data['start_time'] = $startDateTime;
        $data['end_time'] = $endDateTime;
        $data['course_id'] = $course->id;
        $data['total_mark'] = 0;

        if (Session::get('group_id')) {
            $data['student_group_id'] = Session::get('group_id');
            Session::forget('group_id');
        }
        $quiz = Quiz::create($data);

        $quiz->update([
            'step' => Quiz::STEP_ONE,
            'start_time' => $quiz->start_time,
            'end_time' => $quiz->end_time,
        ]);
        return redirect()->route('teacher.courses.quizzes.choose_questions_method', ['course' => $course->slug, 'quiz' => $quiz->id]);
    }

    public function choose_questions_method(Course $course, Quiz $quiz)
    {
        return view('teacher.courses.quizzes.choose_questions_method', compact('course', 'quiz'));
    }

    public function redirect_after_choose_method(Request $request, Course $course, Quiz $quiz)
    {
        if ($request->type == "normal") {
            return redirect()->route('teacher.courses.quizzes.create_sections', ['course' => $course->slug, 'quiz' => $quiz->id]);
        } elseif ($request->type == "copy") {
            return redirect()->route('teacher.courses.quizzes.show_other_quizzes', ['course' => $course->slug, 'quiz' => $quiz->id]);
        } elseif ($request->type == "bank") {
            return redirect()->route('teacher.courses.quizzes.show_bank_groups', ['course' => $course->slug, 'quiz' => $quiz->id]);
        }
        return abort(404);
    }

    public function create_sections(Course $course, Quiz $quiz)
    {
        return view('teacher.courses.quizzes.create_sections', compact('course', 'quiz'));
    }

    public function store_sections(SecondStepCreateCourseRequest $request, Course $course, Quiz $quiz)
    {
        foreach ($request->validated()['sections'] as $section) {
            QuizSection::create([
                'quiz_id' => $quiz->id,
                'title' => $section,
            ]);
        }
        $quiz->update([
            'step' => Quiz::STEP_TWO,
            'start_time' => $quiz->start_time,
            'end_time' => $quiz->end_time,
        ]);
        return redirect()->route('teacher.courses.quizzes.create_questions', ['course' => $course->slug, 'quiz' => $quiz->id]);
    }


    public function show_other_quizzes(Course $course, Quiz $quiz)
    {
        $quizzes = Quiz::where('course_id', $course->id)->where('id', '!=', $quiz->id)->where('step', Quiz::STEP_THREE)->get();
        return view('teacher.courses.quizzes.copy_from_exam', compact('course', 'quiz', 'quizzes'));
    }

    public function generate_quiz_from_other_quiz_questions(Request $request, Course $course, Quiz $quiz)
    {
        $this->validate($request, [
            'quiz_id' => 'required|integer'
        ]);
        $source_quiz = Quiz::with('sections.questions')->find($request->quiz_id);
        DB::transaction(function () use ($source_quiz, $quiz) {
            $total_mark = $quiz->total_mark;
            foreach ($source_quiz->sections as $section) {
                $s = QuizSection::create([
                    'quiz_id' => $quiz->id,
                    'title' => $section->title
                ]);
                foreach ($section->questions as $question) {
                    QuizQuestion::create([
                        'quiz_section_id' => $s->id,
                        'title' => $question->title,
                        'type' => $question->type,
                        'mark' => $question->mark,
                        'choices' => json_encode($question->choices),
                        'picture' => $question->picture
                    ]);
                    $total_mark += $question->mark;
                }
            }
            $quiz->update([
                'step' => Quiz::STEP_THREE,
                'total_mark' => $total_mark,
                'start_time' => $quiz->start_time,
                'end_time' => $quiz->end_time,
            ]);
        });

        //notify students
        if ($quiz->student_group_id) {
            $students = User::where('group_id', $quiz->student_group_id)->get();
        } else {
            $students = $course->generated_students;
            $students->merge($course->students);
        }
        Notification::send($students, new QuizAddedToCourse($course, $quiz->name));

        session()->flash('success', __('site.quiz_data_submitted'));
        return redirect()->route('teacher.courses.quizzes.index', $course->slug);
    }

    public function show_bank_groups(Course $course, Quiz $quiz)
    {
        $groups = BankGroup::withCount('questions')->where('course_id', $course->id)->get();
        return view('teacher.courses.quizzes.generate_from_bank', compact('course', 'quiz', 'groups'));
    }

    public function generate_questions_from_bank(Request $request, Course $course, Quiz $quiz)
    {
        $this->validate($request, [
            'section_name' => 'required|string',
            'group_id' => 'required|integer',
            'number_of_questions' => 'required|integer|min:1',
        ]);
        $group = BankGroup::withCount('questions')->find($request->group_id);

        if ($request->number_of_questions > $group->questions_count) {
            session()->flash("generate_error", __('site.generate_questions_from_bank_number_of_questions_error'));
            return redirect()->back()->withInput();
        }
        $questions_ids = $group->questions()->pluck('id')->toArray();
        $random_questions_numbers = unique_random_numbers($questions_ids, $request->number_of_questions);
        $questions = BankQuestion::where('group_id', $group->id)->whereIn('id', $random_questions_numbers)->get();
        DB::transaction(function () use ($request, $quiz, $questions) {
            $total_mark = $quiz->total_mark;
            $section = QuizSection::create([
                'quiz_id' => $quiz->id,
                'title' => $request->section_name
            ]);
            foreach ($questions as $question) {
                $q = QuizQuestion::create([
                    'quiz_section_id' => $section->id,
                    'title' => $question->title,
                    'type' => $question->type,
                    'mark' => $question->mark,
                    'choices' => json_encode($question->choices),
                    'picture' => $question->picture
                ]);
                $total_mark += $q->mark;
            }
            $quiz->update([
                'step' => Quiz::STEP_TWO,
                'total_mark' => $total_mark,
                'start_time' => $quiz->start_time,
                'end_time' => $quiz->end_time,
            ]);
        });

        session()->flash('success', __('site.questions_generated_successfully'));
        return redirect()->back();
    }

    public function create_questions(Course $course, $quiz)
    {
        $quiz = Quiz::with('sections', 'questions.section')->where('id', $quiz)->first();
        $sections = $quiz->sections;
        $questions = $quiz->questions;
        return view('teacher.courses.quizzes.questions.create_question', compact('course', 'quiz', 'sections', 'questions'));
    }

    public function finish_quiz(Course $course, Quiz $quiz)
    {
        $quiz->update([
            'step' => Quiz::STEP_THREE,
            'start_time' => $quiz->start_time,
            'end_time' => $quiz->end_time,
        ]);

        //notify students
        if ($quiz->student_group_id) {
            $students = User::where('group_id', $quiz->student_group_id)->get();
        } else {
            $students = $course->generated_students;
            $students->merge($course->students);
        }
        Notification::send($students, new QuizAddedToCourse($course, $quiz->name));

        session()->flash('success', __('site.quiz_data_submitted'));
        return redirect()->route('teacher.courses.quizzes.index', $course);
    }

    public function destroy(Course $course, Quiz $quiz)
    {
        $quiz->delete();
        session()->flash('success', __('site.quiz_deleted'));
        return redirect()->back();
    }

    public function quiz_answers($course, Quiz $quiz)
    {
        $answers = $quiz->attempts()->with('student')->get();
        return view('teacher.courses.quizzes.answers.index', compact('answers', 'course', 'quiz'));
    }

    public function quiz_answers_download($course, Quiz $quiz)
    {
        $data = [];
        $answers = $quiz->attempts()->with('student')->get();
        foreach ($answers as $answer) {
            array_push($data, [
                'name' => $answer->student->name,
                'student_mobile' => $answer->student->mobile,
                'parent_mobile' => $answer->student->parent_mobile,
                'email' => $answer->student->email,
                'mark' => (string)$answer->mark
            ]);
        }
        return Excel::download(new QuizDegreesExport($data), $quiz->id . '.xlsx');
    }

    public function show_results($course, $quiz, QuizAttempt $quiz_attempt)
    {
        $quiz = Quiz::find($quiz);
        return view('teacher.courses.quizzes.answers.results', compact('course', 'quiz', 'quiz_attempt'));
    }

    public function quiz_answer($course, $quiz, QuizAttempt $quiz_attempt)
    {
        if ($quiz_attempt->is_final_mark) {
            return redirect()->route('teacher.courses.quizzes.answers', ['course' => $course, 'quiz' => $quiz]);
        }
        $quiz = Quiz::with('sections.questions')->where('id', $quiz)->first();
        return view('teacher.courses.quizzes.answers.show', compact('quiz', 'quiz_attempt', 'course'));
    }

    public function submit_final_mark(Request $request, $course, Quiz $quiz, QuizAttempt $quiz_attempt)
    {
        if ($quiz_attempt->is_final_mark) {
            return redirect()->route('teacher.courses.quizzes.answers', ['course' => $course, 'quiz' => $quiz]);
        }
        $answers = $quiz_attempt->answers;
        $q_ids = array_keys($request->all());
        unset($q_ids[0]);
        foreach ($answers as $index => $answer) {
            if (in_array($answer->id, $q_ids)) {
                unset($answers[$index]);
                array_push($answers, [
                    'id' => $answer->id,
                    'mark' => $request[$answer->id],
                    'title' => $answer->title,
                    'answer' => $answer->answer,
                    'images' => $answer->images
                ]);
                $quiz_attempt->update([
                    'mark' => $quiz_attempt->mark + $request[$answer->id]
                ]);
            }
        }
        $quiz_attempt->update([
            'answers' => json_encode($answers),
            'is_final_mark' => true
        ]);

        //notify student
        $quiz_attempt->student->notify(new QuizAnswerHasBeenReviewed($course, $quiz, $quiz_attempt));

        session()->flash('success', __('site.quiz_marked'));
        return redirect()->route('teacher.courses.quizzes.answers', ['course' => $course, 'quiz' => $quiz]);
    }

    public function statistics(Course $course, $quiz)
    {
        $quiz = Quiz::with('attempts', 'questions')->where('id', $quiz)->first();
        $most_wrong_questions = [];

        $passed_students = 0;
        $failed_students = 0;
        $number_of_absence = $course->students()->count() - count($quiz->attempts);
        $number_of_attendees = count($quiz->attempts);
        foreach ($quiz->questions as $question) {
            $most_wrong_questions[$question->id] = [
                'id' => $question->id,
                'name' => $question->title,
                'type' => $question->type,
                'mark' => $question->mark,
                'number_of_wrong_answers' => 0
            ];
        }
        foreach ($quiz->attempts as $attempt) {
            $percent = (double)number_format($attempt->mark / $quiz->total_mark * 100, 2);
            if ($percent >= 50) {
                $passed_students++;
            } else {
                $failed_students++;
            }
            foreach ($attempt->answers as $answer) {
                $percentage = (double)number_format((int)$answer->mark / (int)$most_wrong_questions[$answer->id]['mark'] * 100, 2);
                if ($percentage < 50) {
                    $most_wrong_questions[$answer->id]['number_of_wrong_answers'] = $most_wrong_questions[$answer->id]['number_of_wrong_answers'] + 1;
                }
            }
        }
        $number_of_wrong_answers_arr = array_column($most_wrong_questions, 'number_of_wrong_answers');
        array_multisort($number_of_wrong_answers_arr, SORT_DESC, $most_wrong_questions);

        return view('teacher.courses.quizzes.statistics', compact('passed_students', 'failed_students', 'number_of_attendees', 'number_of_absence', 'most_wrong_questions'));
    }

}
