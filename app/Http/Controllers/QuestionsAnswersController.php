<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Qa;
use App\Notifications\StudentAddQuestionToCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class QuestionsAnswersController extends Controller
{
    public function ask(Request $request, $course)
    {
        $course = Course::where('slug', $course)->first();
        $this->validate($request, [
            'question' => 'required|string'
        ]);
        $data['course_id'] = $course->id;
        $data['student_id'] = auth()->user()->id;
        $data['question'] = $request->question;
        $qa = Qa::create($data);

        //notify instructor
        $course->instructor->notify(new StudentAddQuestionToCourse($course, auth()->user()->name, $qa));

        session()->flash('success', __('site.question_added'));
        return redirect()->back();
    }
}
