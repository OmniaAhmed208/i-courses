<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CourseResources extends Component
{
    public $resources;
    public $slug;

    /**
     * Create a new component instance.
     *
     * @param $resources
     * @param $slug
     */
    public function __construct($resources, $slug)
    {
        $this->resources = $resources;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.course-resources');
    }
}
