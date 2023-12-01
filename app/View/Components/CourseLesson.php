<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CourseLesson extends Component
{
    public $lesson;

    /**
     * Create a new component instance.
     *
     * @param $lesson
     */
    public function __construct($lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.course-lesson');
    }
}
