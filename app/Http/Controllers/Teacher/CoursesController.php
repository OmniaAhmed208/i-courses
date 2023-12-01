<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\AttendanceExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\FirstStepCreateCourseRequest;
use App\Http\Requests\SecondStepCreateCourseRequest;
use App\Http\Requests\UpdateCourseBasicInfoRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\User;
use App\Notifications\CourseAdded;
use App\Services\ImageService;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::where('instructor_id', auth()->user()->id)->withCount('rates')->when($request->status, function ($q) use ($request) {
            $q->where('status', $request->status);
        })->latest()->paginate(10);

        return view('teacher.courses.index', compact('courses'));
    }

    public function show($course)
    {
        $course = Course::with('sections', 'sections.lessons')->withCount('lessons')->where('slug', $course)->first();
        return view('teacher.courses.show', compact('course'));
    }

    public function create()
    {
        $categories = Category::with('childrens')->get()->filter(function ($cat) {
            return count($cat->childrens) == 0;
        });
        return view('teacher.courses.create.first_step', compact('categories'));
    }

    public function first_step(FirstStepCreateCourseRequest $request)
    {

        $data = $request->validated();
        $data['status'] = Course::STATUS_DRAFT;
        $data['instructor_id'] = auth()->user()->id;
        $data['step'] = Course::STEP_ONE;
        $course = Course::create($data);

        $images = ImageService::storeCourseImage($request->image, $course->id);
        $course->update([
            'image' => $images['normal'],
            'small_image' => $images['small']
        ]);
        return redirect()->route('teacher.courses.create_second', $course->slug);
    }

    public function create_second($course)
    {
        $course = Course::with('sections')->where('slug', $course)->first();
        if ($course->step == Course::STEP_ONE) {
            $sections = CourseSection::with('children')->where('parent_id', null)->where('course_id', $course->id)->paginate(50);
            return view('teacher.courses.create.sections.index', compact('course', 'sections'));
        }
        session()->flash('error', __('site.cant_go_to_page'));
        return redirect()->route('teacher.courses.index');
    }

    public function second_step(Course $course)
    {
        if ($course->step == Course::STEP_ONE) {
            $course->update([
                'step' => Course::STEP_TWO
            ]);
            return redirect()->route('teacher.courses.create_third', $course->slug);
        }
        session()->flash('error', __('site.cant_go_to_page'));
        return redirect()->route('teacher.courses.index');
    }

    public function create_third($course)
    {
        $course = Course::where('slug', $course)->first();
        $sections = CourseSection::where('course_id', $course->id)->get()->filter(function ($section) {
            return $section->isLastLevelChild();
        });

        if ($course->step == Course::STEP_TWO) {
            return view('teacher.courses.create.third_step', compact('course', 'sections'));
        }
        session()->flash('error', __('site.cant_go_to_page'));
        return redirect()->route('teacher.courses.index');
    }

    public function third_step(Request $request, Course $course)
    {
        if ($request->lessons_added == 1 || $course->lessons()->count() > 0) {
            $course->update([
                'step' => Course::STEP_THREE,
                'status' => Course::STATUS_PENDING
            ]);
            Cache::forget('pending_courses_count');

            $admins = User::whereRoleIs('admin')->orWhereRoleIs('moderator')->get();
            Notification::send($admins, new CourseAdded($course->instructor->name));

            return redirect()->route('teacher.courses.index');
        }
        session()->flash('error', __('site.atlease_one_lesson'));
        return redirect()->back();
    }

    public function complete_data(Course $course)
    {
        if ($course->step == Course::STEP_ONE) {
            return redirect()->route('teacher.courses.create_second', $course->slug);
        } elseif ($course->step == Course::STEP_TWO) {
            return redirect()->route('teacher.courses.create_third', $course->slug);
        }
    }

    public function edit_basic_info(Course $course)
    {
        $categories = Category::with('childrens')->get()->filter(function ($cat) {
            return count($cat->childrens) == 0;
        });
        return view('teacher.courses.edit.basic_data', compact('course', 'categories'));
    }

    public function update_basic_info(UpdateCourseBasicInfoRequest $request, Course $course)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $images = ImageService::updateCourseImage($request->image, $course);
            $data['image'] = $images['normal'];
            $data['small_image'] = $images['small'];
        }
        $course->update($data);
        session()->flash('success', __('site.course_info_updated'));
        return redirect()->route('teacher.courses.index');
    }

    public function edit_sections($course)
    {
        $course = Course::with('sections.lessons')->where('slug', $course)->first();
        return view('teacher.courses.edit.sections', compact('course'));
    }

    public function add_sections(SecondStepCreateCourseRequest $request, Course $course)
    {
        foreach ($request->validated()['sections'] as $section) {
            CourseSection::create([
                'course_id' => $course->id,
                'name' => $section
            ]);
        }
        session()->flash('success', __('site.section_added'));
        return redirect()->back();
    }

    public function destroy_section($course, CourseSection $section)
    {
        $section->delete();
        session()->flash('success', __('site.section_deleted'));
        return redirect()->back();
    }

    public function update_section(Request $request, $course)
    {
        $section = CourseSection::find($request->section_id);
        $section->update(['name' => $request->name]);
        session()->flash('success', __('site.section_updated'));
        return redirect()->back();
    }

    public function add_lessons($course)
    {
        $course = Course::with('sections')->where('slug', $course)->first();
        $sections = CourseSection::where('course_id', $course->id)->get()->filter(function ($section) {
            return $section->isLastLevelChild();
        });
        return view('teacher.courses.edit.lessons', compact('course', 'sections'));
    }

    public function attendance_report($course)
    {
        $data = [];
        $course = Course::with('lessons.attendance')->where('slug', $course)->first();
        if (!$course->lessons->isEmpty()) {
            foreach ($course->lessons as $lesson) {
                $data[$lesson->name] = [];
                foreach ($lesson->attendance as $attendee) {
                    array_push($data[$lesson->name], [
                        'name' => $attendee->name ?? '--',
                        'mobile' => $attendee->mobile ?? '--',
                        'parent_mobile' => $attendee->parent_mobile ?? '--',
                        'email' => $attendee->email,
                        'code' => strtoupper($attendee->code),
                        'attended_at' => $attendee->pivot->created_at->format('d/m/Y  h:i A'),
                        'complete_lesson' => $attendee->pivot->number_of_views > 0 ? "Yes" : "No"
                    ]);
                }
            }
            return Excel::download(new AttendanceExport($data), $course->slug . '.xlsx');
        }
        session()->flash('error', 'لا يمكنك تحميل تقرير الحضور لدورة بدون دروس');
        return redirect()->back();
    }
}
