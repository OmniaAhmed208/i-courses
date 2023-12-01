<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Notifications\StudentSubmittedQuiz;
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{
    public function show($course, $quiz)
    {
        $quiz = Quiz::with('sections.questions')->where('id', $quiz)->firstOrFail();
        $attempt = QuizAttempt::where('student_id', auth()->user()->id)->where('quiz_id', $quiz->id)->first();
        if (Carbon::now() >= $quiz->start_time && Carbon::now() < $quiz->end_time && is_null($attempt)) {
            if (now()->addMinute($quiz->duration_in_minutes)->gt($quiz->end_time)) {
                $remaining_time = now()->addMinutes($quiz->end_time->addMinutes(1)->diffInMinutes(now()))->diffInRealMilliseconds(now());
            } else {
                $remaining_time = now()->addMinutes($quiz->duration_in_minutes + 1)->diffInRealMilliseconds(now());
            }
            return view('website.courses.quizzes.show', compact('course', 'quiz', 'remaining_time'));
        } elseif ($attempt) {
            return redirect()->route('courses.quizzes.showResults', ['course' => $course, 'quiz' => $quiz, 'quiz_attempt' => $attempt->id]);
        }

        return redirect()->route('home');
    }

    public function attempt(Request $request, $course, Quiz $quiz)
    {
        $course = Course::where('slug', $course)->first();
        $data = [];
        $data['is_final_mark'] = true;
        $answers = [];
        $total_mark = 0;
        try {
            foreach ($request->all() as $index => $answer) {
                if ($index == '_token' || strpos($index, '_images') !== false)
                    continue;
                $q = QuizQuestion::find($index);
                $answer = [];
                if ($q->type == 'essay') {
                    $images_names = [];
                    if ($request->hasFile($q->id . '_images')) {
                        $images = $request->file($q->id . '_images');
                        foreach ($images as $image) {
                            array_push($images_names, ImageService::storeAnswerImage($image, $course->id));
                        }
                    }
                    $answer['id'] = $q->id;
                    $answer['title'] = $q->title;
                    $answer['answer'] = $request[$q->id];
                    $answer['images'] = $images_names;
                    $answer['mark'] = 0;
                    array_push($answers, $answer);
                    if (count($answer) > 0) {
                        $data['is_final_mark'] = false;
                    }
                } elseif ($q->type == 'mcq') {
                    $q_answers = $q->choices;
                    $q_answer = $q_answers[$request[$q->id] - 1];
                    $answer['id'] = $q->id;
                    $answer['title'] = $q->title;
                    $answer['answer'] = $q_answer->title;
                    $answer['mark'] = $q_answer->correct ? $q->mark : 0;
                    $total_mark += $q_answer->correct ? (int)$q->mark : 0;
                    array_push($answers, $answer);

                } elseif ($q->type == 'true_false') {
                    $q_answer = $q->choices;
                    $answer['id'] = $q->id;
                    $answer['title'] = $q->title;
                    $answer['answer'] = $request[$index];
                    $answer['mark'] = $q_answer->correct_val == $request[$index] ? (int)$q->mark : 0;
                    $total_mark += $q_answer->correct_val == $request[$index] ? (int)$q->mark : 0;
                    array_push($answers, $answer);
                }
            }
        } catch (\Exception $e) {
            throw $e;
            session()->flash('error', "Something went wrong!");
            return redirect()->back();
        }
        $data['student_id'] = auth()->user()->id;
        $data['quiz_id'] = $quiz->id;
        $data['mark'] = $total_mark;
        $data['answers'] = json_encode($answers);
        $attempt = QuizAttempt::where('quiz_id', $quiz->id)->where('student_id', auth()->user()->id)->first();
        if ($attempt) {
            $attempt->update($data);
        } else {
            $attempt = QuizAttempt::create($data);
        }
        //notify instructor
        $course->instructor->notify(new StudentSubmittedQuiz($course->slug, $quiz, $attempt));
        if ($quiz->end_time->lte(now())) {
            return redirect()->route('courses.quizzes.showResults', ['course' => $course->slug, 'quiz' => $quiz->id, 'quiz_attempt' => $attempt->id]);
        } else {
            session()->flash('success', __('site.submitted'));
            return redirect()->route('courses.study', $course->slug);
        }
    }

    public function showResults($course, $quiz, QuizAttempt $quiz_attempt)
    {
        $quiz = Quiz::find($quiz);
        if ((now() >= $quiz->start_time && now() < $quiz->end_time && auth()->user()->studentTakeQuiz($quiz)) || $quiz->id != $quiz_attempt->quiz_id || $quiz_attempt->student_id != auth()->user()->id) {
            session()->flash('success', __('site.submitted'));
            return redirect()->route('courses.study', $course);
        }
        return view('website.courses.quizzes.results', compact('course', 'quiz', 'quiz_attempt'));
    }

}
