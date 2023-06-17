<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Quiz;


class CourseQuizzes extends Component
{
    public $quizzes;
    public $course;

    /**
     * Create a new component instance.
     *
     * @param $course
     * @param $quizzes
     */
    public function __construct($course, $quizzes)
    {
        $this->course = $course;
        $this->quizzes = $quizzes->filter(function ($quiz) {
            return (($quiz->student_group_id == auth()->user()->group_id || is_null($quiz->student_group_id)) && count($quiz->questions) > 0 && $quiz->step == Quiz::STEP_THREE);
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.course-quizzes');
    }
}
