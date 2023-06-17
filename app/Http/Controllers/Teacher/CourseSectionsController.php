<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSection;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CourseSectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Course $course
     * @return Application|Factory|Response|View
     */
    public function index(Course $course)
    {
        $sections = CourseSection::with('children')->where('parent_id', null)->where('course_id', $course->id)->paginate(50);
        return view('teacher.courses.create.sections.index', compact('course', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Course $course
     * @return Application|Factory|View|void
     */
    public function create(Course $course)
    {
        $sections = CourseSection::where('course_id', $course->id)->get();
        return view('teacher.courses.create.sections.create', compact('course', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $course
     * @return RedirectResponse|Response
     * @throws ValidationException
     */
    public function store(Request $request, Course $course)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $data = $request->all();
        $data['course_id'] = $course->id;
        CourseSection::create($data);
        session()->flash('success', '');
        return redirect()->route('teacher.courses.sections.index', ['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $course
     * @param CourseSection $section
     * @return Application|Factory|View|void
     */
    public function edit(Course $course, CourseSection $section)
    {
        $sections = CourseSection::where('course_id', $course->id)->get();
        return view('teacher.courses.create.sections.edit', compact('course', 'sections', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $course
     * @param CourseSection $section
     * @return RedirectResponse|void
     * @throws ValidationException
     */
    public function update(Request $request, $course, CourseSection $section)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $section->update($request->all());
        session()->flash('success', '');
        return redirect()->route('teacher.courses.sections.index', ['course' => $course]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $course
     * @param CourseSection $section
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy($course, CourseSection $section)
    {
        $section->delete();
        session()->flash('success', '');
        return redirect()->route('teacher.courses.sections.index', ['course' => $course]);
    }
}
