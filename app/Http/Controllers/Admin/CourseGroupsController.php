<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudentsGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseGroupsController extends Controller
{
    public function index($course)
    {
        $course = Course::where('slug', $course)->first();
        $groups = StudentsGroup::withCount('students')->where('course_id', $course->id)->get();
        return view('admin.courses.groups', compact('course', 'groups'));
    }

    public function students(Request $request, $course, StudentsGroup $group)
    {
        $course = Course::where('slug', $course)->first();
        $generated_students = User::where('course_id', $course->id)->where('group_id', $group->id)->when($request->search, function ($q) use ($request) {
            $q->where('email', $request->search)->orWhere('code', $request->search)->orWhere('mobile', 'LIKE', '%' . $request->search . '%');
        })->paginate(25);
        return view('admin.courses.group_students', compact('generated_students', 'course', 'group'));
    }

    public function delete_all_students($course, StudentsGroup $group)
    {
        $group->students()->delete();

        session()->flash('success', __('site.all_students_deleted_successfully'));
        return redirect()->back();
    }

    public function block_all_students($course, StudentsGroup $group)
    {
        $group->students()->update([
            'is_banned' => true
        ]);

        session()->flash('success', __('site.all_students_blocked_successfully'));
        return redirect()->back();
    }

    public function unblock_all_students($course, StudentsGroup $group)
    {
        $group->students()->update([
            'is_banned' => false,
            'last_login_ip' => null,
            'unique_token' => null,
        ]);

        session()->flash('success', __('site.all_students_unblocked_successfully'));
        return redirect()->back();
    }

    public function destroy($course, StudentsGroup $group)
    {
        DB::transaction(function () use ($group) {
            $group->students()->update([
                'group_id' => null,
            ]);

            $group->delete();
        });

        session()->flash('success', __('site.bank_group_deleted'));
        return redirect()->back();
    }
}
