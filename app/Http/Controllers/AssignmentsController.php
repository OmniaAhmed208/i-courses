<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use App\Models\AssignmentQuestion;
use App\Models\Course;
use App\Notifications\StudentAnswerAllAssignmentQuestions;
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    public function show($course, $assignment)
    {
        $assignment = Assignment::with('sections.questions')->where('id', $assignment)->firstOrFail();
        if (now()->gte($assignment->start_time) && now()->lt($assignment->end_time)) {
            return view('website.courses.assignments.show', compact('course', 'assignment'));
        }
        return redirect()->route('home');
    }


    public function submit_single_question(Request $request, $course, Assignment $assignment, AssignmentQuestion $question)
    {
        $course = Course::where('slug', $course)->first();
        $attempt = AssignmentAttempt::where('student_id', auth()->user()->id)->where('assignment_id', $assignment->id)->first();
        $answer = [];
        $answers = $attempt ? $attempt->answers : [];
        $total_mark = $attempt ? $attempt->mark : 0;
        $is_final_mark = true;
        if ($question && $question->type == 'essay') {
            $images_names = [];
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    array_push($images_names, ImageService::storeAnswerImage($image, $course->id));
                }
            }
            $answer['id'] = $question->id;
            $answer['title'] = $question->title;
            $answer['answer'] = $request['answer'];
            $answer['images'] = $images_names;
            $answer['mark'] = 0;
            $is_final_mark = false;
            array_push($answers, $answer);
        } elseif ($question && $question->type == 'mcq') {
            $q_answers = $question->choices;
            if (!is_null($request["answer"])) {
                $q_answer = $q_answers[$request["answer"] - 1];
                $answer['answer'] = $q_answer->title;
                $answer['mark'] = $q_answer->correct ? $question->mark : 0;
                $total_mark = $q_answer->correct ? $total_mark + $question->mark : $total_mark;
            } else {
                $answer['answer'] = "";
                $answer['mark'] = 0;
            }
            $answer['id'] = $question->id;
            $answer['title'] = $question->title;
            array_push($answers, $answer);
        } elseif ($question && $question->type == 'true_false') {
            $q_answer = $question->choices;
            $answer['id'] = $question->id;
            $answer['title'] = $question->title;
            $answer['answer'] = $request["answer"];
            $answer['mark'] = $this->strbool($q_answer->correct_val) == $this->strbool($request["answer"]) ? (int)$question->mark : 0;
            $total_mark = $this->strbool($q_answer->correct_val) == $this->strbool($request["answer"]) ? $total_mark + (int)$question->mark : $total_mark;
            array_push($answers, $answer);
        }

        if (!$attempt) {
            $data['student_id'] = auth()->user()->id;
            $data['assignment_id'] = $assignment->id;
            $data['mark'] = $total_mark;
            $data['answers'] = json_encode($answers);
            $data['is_final_mark'] = $is_final_mark;
            AssignmentAttempt::create($data);
        } else {
            $attempt->update([
                'answers' => json_encode($answers),
                'mark' => $total_mark,
                'is_final_mark' => $is_final_mark
            ]);
        }

        if ($attempt && count($attempt->answers) == count($assignment->questions)) {
            $attempt->update([
                'student_answers_all_questions' => true
            ]);
            //notify teacher
            $course->instructor->notify(new StudentAnswerAllAssignmentQuestions($course->slug, $assignment, $attempt));

            session()->flash('success', __('site.question_submitted_successfully'));
            return redirect()->route('courses.study', $course->slug);
        } else {
            session()->flash('success', __('site.question_submitted_successfully'));
            return redirect()->route('courses.assignments.show', ['course' => $course->slug, 'assignment' => $assignment->id]);
        }
    }

    public function showResults($course, $assignment, AssignmentAttempt $assignment_attempt)
    {
        if ($assignment != $assignment_attempt->assignment_id || $assignment_attempt->student_id != auth()->user()->id) {
            return redirect()->route('home');
        }
        $assignment = Assignment::find($assignment);
        if ($assignment->duration == 0 || Carbon::now() >= $assignment->time->addHours($assignment->duration)) {
            return view('website.courses.assignments.results', compact('course', 'assignment', 'assignment_attempt'));
        }
        session()->flash('success', __('site.submitted'));
        return redirect()->route('courses.study', $course);
    }

    private function strbool($value)
    {
        if ($value || $value == "true") {
            return true;
        }
        return false;
    }
}
