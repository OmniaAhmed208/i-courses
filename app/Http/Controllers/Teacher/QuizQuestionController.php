<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionsRequest;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizQuestionController extends Controller
{
    public function store_question(StoreQuestionsRequest $request, $course, Quiz $quiz)
    {
        if ($quiz->start_time->gt(now())) {
            $data = [];
            $type = $request->type;
            $data['quiz_section_id'] = $request->section_id;
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
            DB::transaction(function () use ($data, $quiz) {
                $question = QuizQuestion::create($data);
                $quiz->update([
                    'total_mark' => ((int)$quiz->total_mark + (int)$question->mark),
                    'start_time' => $quiz->start_time,
                    'end_time' => $quiz->end_time,
                ]);
            });
            session()->flash('success', __('site.question_added'));
        } else {
            session()->flash('error', __('site.cant_add_question'));
        }
        return redirect()->back();
    }

    public function edit_question(Course $course, $quiz, QuizQuestion $question)
    {
        $quiz = Quiz::with('sections')->where('id', $quiz)->first();
        if ($quiz->start_time->gt(now())) {
            $sections = $quiz->sections;
            return view('teacher.courses.quizzes.questions.edit_question', compact('course', 'quiz', 'question', 'sections'));
        }
        session()->flash('error', __('site.cant_edit_question'));
        return redirect()->back();
    }

    public function update_question(StoreQuestionsRequest $request, $course, Quiz $quiz, QuizQuestion $question)
    {
        if ($quiz->start_time->gt(now())) {
            $data = [];
            $data['type'] = $request->type;
            $data['title'] = $request->title;
            $data['mark'] = $request->mark;
            $data['quiz_section_id'] = $request->section_id;
            DB::transaction(function () use ($question, $quiz, $request, $data) {
                if ($request->mark > $question->mark) {
                    $difference_between_values = ((int)$request->mark - (int)$question->mark);
                    $total_mark = ((int)$quiz->total_mark + (int)$difference_between_values) < 0 ? 0 : ((int)$quiz->total_mark + (int)$difference_between_values);
                    $quiz->update([
                        'total_mark' => $total_mark,
                        'start_time' => $quiz->start_time,
                        'end_time' => $quiz->end_time,
                    ]);
                } elseif ($request->mark < $question->mark) {
                    $difference_between_values = (int)$question->mark - (int)$request->mark;
                    $total_mark = ((int)$quiz->total_mark - (int)$difference_between_values) < 0 ? 0 : ((int)$quiz->total_mark - (int)$difference_between_values);
                    $quiz->update([
                        'total_mark' => $total_mark,
                        'start_time' => $quiz->start_time,
                        'end_time' => $quiz->end_time,
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
            return redirect()->route('teacher.courses.quizzes.create_questions', ['course' => $course, 'quiz' => $quiz->id]);
        }
        session()->flash('error', __('site.cant_edit_question'));
        return redirect()->back();
    }

    public function delete_question($course, Quiz $quiz, QuizQuestion $question)
    {
        if ($quiz->start_time->gt(now())) {
            DB::transaction(function () use ($quiz, $question) {
                if (ImageService::deleteQuestionImage($question->picture)) {
                    $quiz->update([
                        'total_mark' => ((int)$quiz->total_mark - (int)$question->mark),
                        'start_time' => $quiz->start_time,
                        'end_time' => $quiz->end_time,
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
