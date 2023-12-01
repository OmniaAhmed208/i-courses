<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionsRequest;
use App\Models\Assignment;
use App\Models\AssignmentQuestion;
use App\Models\Course;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class AssignmentsQuestionController extends Controller
{
    public function store_question(StoreQuestionsRequest $request, $course, Assignment $assignment)
    {
        $data = [];
        $type = $request->type;
        $data['assignment_section_id'] = $request->section_id;
        $data['type'] = $request->type;
        $data['title'] = $request->title;
        $data['mark'] = $request->mark;
        if ($type == 'mcq') {
            $choices = [];
            foreach ($request['answers'] as $key => $answer) {
                if ($request->correct_answer == $key + 1) {
                    array_push($choices, ['title' => $answer, 'correct' => true]);
                } else {
                    array_push($choices, ['title' => $answer, 'correct' => false]);
                }
            }
            $data['choices'] = json_encode($choices);
        } elseif ($type == 'true_false') {
            $data['choices'] = json_encode(['correct_val' => $request->correct_answer]);
        }
        if ($request->hasFile('image')) {
            $data['picture'] = ImageService::storeQuestionImage($request->image);
        }
        DB::transaction(function () use ($data, $assignment) {
            $question = AssignmentQuestion::create($data);
            $assignment->update([
                'total_mark' => ((int)$assignment->total_mark + (int)$question->mark),
                'start_time' => $assignment->start_time,
                'end_time' => $assignment->end_time,
            ]);
        });
        session()->flash('success', __('site.question_added'));
        return redirect()->back();
    }

    public function edit_question(Course $course, $assignment, AssignmentQuestion $question)
    {
        $assignment = Assignment::with('sections')->where('id', $assignment)->first();
        if ($assignment->start_time->gt(now())) {
            $sections = $assignment->sections;
            return view('teacher.courses.assignments.questions.edit_question', compact('course', 'assignment', 'question', 'sections'));
        }
        session()->flash('error', __('site.cant_edit_question'));
        return redirect()->back();
    }

    public function update_question(StoreQuestionsRequest $request, $course, Assignment $assignment, AssignmentQuestion $question)
    {
        if ($assignment->start_time->gt(now())) {
            $data = [];
            $data['type'] = $request->type;
            $data['title'] = $request->title;
            $data['mark'] = $request->mark;
            $data['assignment_section_id'] = $request->section_id;
            DB::transaction(function () use ($question, $assignment, $request, $data) {
                if ($request->mark > $question->mark) {
                    $difference_between_values = ((int)$request->mark - (int)$question->mark);
                    $total_mark = ((int)$assignment->total_mark + (int)$difference_between_values) < 0 ? 0 : ((int)$assignment->total_mark + (int)$difference_between_values);
                    $assignment->update([
                        'total_mark' => $total_mark,
                        'start_time' => $assignment->start_time,
                        'end_time' => $assignment->end_time,
                    ]);
                } elseif ($request->mark < $question->mark) {
                    $difference_between_values = (int)$question->mark - (int)$request->mark;
                    $total_mark = ((int)$assignment->total_mark - (int)$difference_between_values) < 0 ? 0 : ((int)$assignment->total_mark - (int)$difference_between_values);
                    $assignment->update([
                        'total_mark' => $total_mark,
                        'start_time' => $assignment->start_time,
                        'end_time' => $assignment->end_time,
                    ]);
                }
                if ($request->type == 'mcq') {
                    $choices = [];
                    foreach ($request['answers'] as $key => $answer) {
                        if ($request->correct_answer == ($key + 1)) {
                            array_push($choices, ['title' => $answer, 'correct' => true]);
                        } else {
                            array_push($choices, ['title' => $answer, 'correct' => false]);
                        }
                    }
                    $data['choices'] = json_encode($choices);
                } elseif ($request->type == 'true_false') {
                    $data['choices'] = json_encode(['correct_val' => $request->correct_answer]);
                } else {
                    $data['choices'] = null;
                }
                if ($request->hasFile('image')) {
                    if ($question->picture && ImageService::deleteQuestionImage($question->picture)) {
                        $data['picture'] = ImageService::storeQuestionImage($request->image);
                    }
                }
                $question->update($data);
            });
            session()->flash('success', __('site.question_updated'));
            return redirect()->route('teacher.courses.assignments.create_questions', ['course' => $course, 'assignment' => $assignment->id]);
        }
        session()->flash('error', __('site.cant_edit_question'));
        return redirect()->back();
    }

    public function delete_question($course, Assignment $assignment, AssignmentQuestion $question)
    {
        if ($assignment->start_time->gt(now())) {
            DB::transaction(function () use ($assignment, $question) {
                if (ImageService::deleteQuestionImage($question->picture)) {
                    $assignment->update([
                        'total_mark' => ((int)$assignment->total_mark - (int)$question->mark),
                        'start_time' => $assignment->start_time,
                        'end_time' => $assignment->end_time,
                    ]);
                    $question->delete();
                    session()->flash('success', __('site.question_deleted'));
                } else {
                    session()->flash('error', __('site.bank_question_delete_error'));
                }
            });
        } else {
            session()->flash('error', __('site.cant_delete_question'));
        }
        return redirect()->back();
    }
}
