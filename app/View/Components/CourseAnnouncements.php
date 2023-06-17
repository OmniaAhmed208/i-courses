<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CourseAnnouncements extends Component
{
    public $announcements;
    public $course;

    /**
     * Create a new component instance.
     *
     * @param $course
     * @param $announcements
     */
    public function __construct($course, $announcements)
    {
        $this->course = $course;
        $this->announcements = $announcements->filter(function ($announcement) {
            return $announcement->group_id == auth()->user()->group_id || is_null($announcement->group_id);
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.course-announcements');
    }
}
