<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CourseData extends Component
{
    public $course;

    /**
     * Create a new component instance.
     *
     * @param $course
     */
    public function __construct($course)
    {
        $this->course = $course;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.course-data');
    }
}
