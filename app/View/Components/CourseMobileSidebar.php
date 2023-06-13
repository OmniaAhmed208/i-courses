<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CourseMobileSidebar extends Component
{
    public $sections;

    /**
     * Create a new component instance.
     *
     * @param $sections
     */
    public function __construct($sections)
    {
        $this->sections = $sections;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.course-mobile-sidebar');
    }
}
