<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Qa;
use App\Notifications\InstructorAnswerQuestion;
use App\Notifications\InstructorEditAnswer;
use Illuminate\Http\Request;

class QuestionsAnswersController extends Controller
{
    public function index(Course $course)
    {
        $qas = $course->qas()->paginate(50);
        return view('teacher.courses.qas.index', compact('course', 'qas'));
    }

    public function answer_page(Course $course, Qa $qa)
    {
        return view('teacher.courses.qas.answer', compact('course', 'qa'));
    }

    public function answer(Request $request, $course, Qa $qa)
    {
        $course = Course::with('instructor')->where('slug', $course)->first();
        $this->validate($request, [
            'answer' => 'required|string'
        ]);
        $qa->update([
            'answer' => $request->answer
        ]);
        //notify student
        $qa->student->notify(new InstructorAnswerQuestion($course->slug, $course->instructor->name));
        session()->flash('success', __('site.question_answered'));
        return redirect()->route('teacher.courses.qas.index', $course);
    }

    public function edit(Course $course, Qa $qa)
    {
        return view('teacher.courses.qas.edit', compact('course', 'qa'));
    }

    public function update(Request $request, $course, Qa $qa)
    {
        $course = Course::with('instructor')->where('slug', $course)->first();
        $this->validate($request, [
            'answer' => 'required|string'
        ]);
        $qa->update([
            'answer' => $request->answer
        ]);

        //notify student
        $qa->student->notify(new InstructorEditAnswer($course->slug, $course->instructor->name));

        session()->flash('success', __('site.question_edited'));
        return redirect()->route('teacher.courses.qas.index', $course);
    }
}
