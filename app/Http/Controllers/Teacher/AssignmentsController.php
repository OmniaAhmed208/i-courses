<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecondStepCreateCourseRequest;
use App\Http\Requests\StoreAssignmentFirstStepRequest;
use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use App\Models\AssignmentQuestion;
use App\Models\AssignmentSection;
use App\Models\BankGroup;
use App\Models\BankQuestion;
use App\Models\Course;
use App\Models\StudentsGroup;
use App\Models\User;
use App\Notifications\AssignmentAddedToCourse;
use App\Notifications\AssignmentAnswerHasBeenReviewed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class AssignmentsController extends Controller
{
    public function index(Course $course)
    {
        $assignments = Assignment::where('course_id', $course->id)->get();
        return view('teacher.courses.assignments.index', compact('course', 'assignments'));
    }

    public function first_step_create(Course $course)
    {
        $groups = StudentsGroup::where('course_id', $course->id)->get();
        return view('teacher.courses.assignments.first_step_create', compact('course', 'groups'));
    }

    public function first_step_store(Request $request, Course $course)
    {
        if ($request->assignment_type == 'group') {
            Session::put('group_id', $request->group_id);
        }
        return redirect()->route('teacher.courses.assignments.create', $course->slug);
    }

    public function create(Course $course)
    {
        return view('teacher.courses.assignments.create', compact('course'));
    }


    public function store(StoreAssignmentFirstStepRequest $request, Course $course)
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
        $assignment = Assignment::create($data);

        $assignment->update([
            'step' => Assignment::STEP_ONE,
            'start_time' => $assignment->start_time,
            'end_time' => $assignment->end_time,
        ]);
        return redirect()->route('teacher.courses.assignments.choose_questions_method', ['course' => $course->slug, 'assignment' => $assignment->id]);
    }

    public function choose_questions_method(Course $course, Assignment $assignment)
    {
        return view('teacher.courses.assignments.choose_questions_method', compact('course', 'assignment'));
    }

    public function redirect_after_choose_method(Request $request, Course $course, Assignment $assignment)
    {
        if ($request->type == "normal") {
            return redirect()->route('teacher.courses.assignments.create_sections', ['course' => $course->slug, 'assignment' => $assignment->id]);
        } elseif ($request->type == "copy") {
            return redirect()->route('teacher.courses.assignments.show_other_assignments', ['course' => $course->slug, 'assignment' => $assignment->id]);
        } elseif ($request->type == "bank") {
            return redirect()->route('teacher.courses.assignments.show_bank_groups', ['course' => $course->slug, 'assignment' => $assignment->id]);
        }
        return abort(404);
    }

    public function create_sections(Course $course, Assignment $assignment)
    {
        return view('teacher.courses.assignments.create_sections', compact('course', 'assignment'));
    }

    public function store_sections(SecondStepCreateCourseRequest $request, Course $course, Assignment $assignment)
    {
        foreach ($request->validated()['sections'] as $section) {
            AssignmentSection::create([
                'assignment_id' => $assignment->id,
                'title' => $section,
            ]);
        }
        $assignment->update([
            'step' => Assignment::STEP_TWO,
            'start_time' => $assignment->start_time,
            'end_time' => $assignment->end_time,
        ]);
        return redirect()->route('teacher.courses.assignments.create_questions', ['course' => $course->slug, 'assignment' => $assignment->id]);
    }


    public function show_other_assignments(Course $course, Assignment $assignment)
    {
        $assignments = Assignment::where('course_id', $course->id)->where('id', '!=', $assignment->id)->get();
        return view('teacher.courses.assignments.copy_from_exam', compact('course', 'assignment', 'assignments'));
    }

    public function generate_assignment_from_other_assignment_questions(Request $request, Course $course, Assignment $assignment)
    {
        $this->validate($request, [
            'assignment_id' => 'required|integer'
        ]);
        $source_assignment = Assignment::with('sections.questions')->find($request->assignment_id);
        DB::transaction(function () use ($source_assignment, $assignment) {
            $total_mark = $assignment->total_mark;
            foreach ($source_assignment->sections as $section) {
                $s = AssignmentSection::create([
                    'assignment_id' => $assignment->id,
                    'title' => $section->title
                ]);
                foreach ($section->questions as $question) {
                    AssignmentQuestion::create([
                        'assignment_section_id' => $s->id,
                        'title' => $question->title,
                        'type' => $question->type,
                        'mark' => $question->mark,
                        'choices' => json_encode($question->choices),
                        'picture' => $question->picture
                    ]);
                    $total_mark += $question->mark;
                }
            }
            $assignment->update([
                'step' => Assignment::STEP_THREE,
                'total_mark' => $total_mark,
                'start_time' => $assignment->start_time,
                'end_time' => $assignment->end_time,
            ]);
        });
        //notify students
        if ($assignment->student_group_id) {
            $students = User::where('group_id', $assignment->student_group_id)->get();
        } else {
            $students = $course->generated_students;
            $students->merge($course->students);
        }
        Notification::send($students, new AssignmentAddedToCourse($course, $assignment->name));

        session()->flash('success', __('site.assignment_data_submitted'));
        return redirect()->route('teacher.courses.assignments.index', $course->slug);
    }

    public function show_bank_groups(Course $course, Assignment $assignment)
    {
        $groups = BankGroup::withCount('questions')->where('course_id', $course->id)->get();
        return view('teacher.courses.assignments.generate_from_bank', compact('course', 'assignment', 'groups'));
    }

    public function generate_questions_from_bank(Request $request, Course $course, Assignment $assignment)
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
        DB::transaction(function () use ($request, $assignment, $questions) {
            $total_mark = $assignment->total_mark;
            $section = AssignmentSection::create([
                'assignment_id' => $assignment->id,
                'title' => $request->section_name
            ]);
            foreach ($questions as $question) {
                $q = AssignmentQuestion::create([
                    'assignment_section_id' => $section->id,
                    'title' => $question->title,
                    'type' => $question->type,
                    'mark' => $question->mark,
                    'choices' => json_encode($question->choices),
                    'picture' => $question->picture
                ]);
                $total_mark += $q->mark;
            }
            $assignment->update([
                'step' => Assignment::STEP_TWO,
                'total_mark' => $total_mark,
                'start_time' => $assignment->start_time,
                'end_time' => $assignment->end_time,
            ]);
        });

        session()->flash('success', __('site.questions_generated_successfully'));
        return redirect()->back();
    }

    public function create_questions(Course $course, $assignment)
    {
        $assignment = Assignment::with('sections', 'questions.section')->where('id', $assignment)->first();
        $sections = $assignment->sections;
        $questions = $assignment->questions;
        return view('teacher.courses.assignments.questions.create_question', compact('course', 'assignment', 'sections', 'questions'));
    }

    public function finish_assignment(Course $course, Assignment $assignment)
    {
        $assignment->update([
            'step' => Assignment::STEP_THREE,
            'start_time' => $assignment->start_time,
            'end_time' => $assignment->end_time,
        ]);
        //notify students

        if ($assignment->student_group_id) {
            $students = User::where('group_id', $assignment->student_group_id)->get();
        } else {
            $students = $course->generated_students;
            $students->merge($course->students);
        }
        Notification::send($students, new AssignmentAddedToCourse($course, $assignment->name));
        session()->flash('success', __('site.assignment_data_submitted'));
        return redirect()->route('teacher.courses.assignments.index', $course);
    }

    public function destroy(Course $course, Assignment $assignment)
    {
        $assignment->delete();
        session()->flash('success', __('site.assignment_deleted'));
        return redirect()->back();
    }

    public function assignment_answers($course, Assignment $assignment)
    {
        $answers = $assignment->attempts()->with('student')->get();
        return view('teacher.courses.assignments.answers.index', compact('answers', 'course', 'assignment'));
    }

    public function show_results($course, $assignment, AssignmentAttempt $assignment_attempt)
    {
        $assignment = Assignment::find($assignment);
        return view('teacher.courses.assignments.answers.results', compact('course', 'assignment', 'assignment_attempt'));
    }

    public function assignment_answer($course, $assignment, AssignmentAttempt $assignment_attempt)
    {
        if ($assignment_attempt->is_final_mark) {
            return redirect()->route('teacher.courses.assignments.answers', ['course' => $course, 'assignment' => $assignment]);
        }
        $assignment = Assignment::with('sections.questions')->where('id', $assignment)->first();
        return view('teacher.courses.assignments.answers.show', compact('assignment', 'assignment_attempt', 'course'));
    }

    public function submit_final_mark(Request $request, $course, Assignment $assignment, AssignmentAttempt $assignment_attempt)
    {
        if ($assignment_attempt->is_final_mark) {
            return redirect()->route('teacher.courses.assignments.answers', ['course' => $course, 'assignment' => $assignment]);
        }
        $answers = $assignment_attempt->answers;
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
                $assignment_attempt->update([
                    'mark' => $assignment_attempt->mark + $request[$answer->id]
                ]);
            }
        }
        $assignment_attempt->update([
            'answers' => json_encode($answers),
            'is_final_mark' => true
        ]);

        $assignment_attempt->student->notify(new AssignmentAnswerHasBeenReviewed($course, $assignment, $assignment_attempt));

        session()->flash('success', __('site.assignment_marked'));
        return redirect()->route('teacher.courses.assignments.answers', ['course' => $course, 'assignment' => $assignment]);
    }
}
