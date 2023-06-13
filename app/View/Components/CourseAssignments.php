<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CourseAssignments extends Component
{

    public $assignments;
    public $course;

    /**
     * Create a new component instance.
     *
     * @param $assignments
     * @param $course
     */
    public function __construct($assignments, $course)
    {
        $this->assignments = $assignments->filter(function ($assignment) {
            return $assignment->student_group_id == auth()->user()->group_id || is_null($assignment->student_group_id);
        });
        $this->course = $course;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.course-assignments');
    }
}
