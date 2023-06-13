<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CourseQa extends Component
{
    public $qas;
    public $course;

    /**
     * Create a new component instance.
     *
     * @param $course
     * @param $qas
     */
    public function __construct($course, $qas)
    {
        $this->course = $course;
        $this->qas = $qas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.course-qa');
    }
}
