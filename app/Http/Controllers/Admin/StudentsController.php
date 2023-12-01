<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudentsGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function edit(Course $course, User $student)
    {
        $groups = $course->groups;
        return view('admin.courses.edit_student', compact('student', 'groups', 'course'));
    }

    public function update(Request $request, $course, User $student)
    {
        $this->validate($request, [
            'first_name' => 'required|string|min:1',
            'last_name' => 'required|string|min:1',
            'login_type' => 'required|string|in:website,mobile'
        ]);
        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'login_type' => $request->login_type,
            'group_id' => $request->group_id
        ]);

        session()->flash('success', __('site.student_updated'));
        return redirect()->back();
    }

    public function block(User $student)
    {
        $student->update([
            'is_banned' => true
        ]);
        session()->flash('success', __('site.student_blocked'));
        return redirect()->back();
    }

    public function unblock(User $student)
    {
        $student->update([
            'is_banned' => false,
            'last_login_ip' => null,
            'unique_token' => null,
        ]);
        session()->flash('success', __('site.student_unblocked'));
        return redirect()->back();
    }

    public function destroy(User $student)
    {
        $student->delete();
        session()->flash('success', __('site.student_deleted'));
        return redirect()->back();
    }

    public function edit_bulk($course)
    {
        $course = Course::where('slug', $course)->first();
        $groups = StudentsGroup::where('course_id', $course->id)->get();
        $generated_students = User::with('group')->where('course_id', $course->id)->get();
        return view('admin.courses.datatable_students', compact('generated_students', 'course', 'groups'));
    }

    public function update_group_bulk(Request $request, $course)
    {
        $student_ids = explode(',', $request->student_ids);
        DB::table('users')->whereIn('id', $student_ids)->update([
            'group_id' => $request->group_id
        ]);

        return response()->json(['message' => 'updated successfully'], 200);
    }

    public function delete_bulk(Request $request, $course)
    {
        $student_ids = explode(',', $request->student_ids);
        DB::table('users')->whereIn('id', $student_ids)->delete();

        return response()->json(['message' => 'updated successfully'], 200);

    }

    public function block_bulk(Request $request, $course)
    {
        $student_ids = explode(',', $request->student_ids);
        DB::table('users')->whereIn('id', $student_ids)->update([
            'is_banned' => true
        ]);

        return response()->json(['message' => 'updated successfully'], 200);

    }

    public function unblock_bulk(Request $request, $course)
    {
        $student_ids = explode(',', $request->student_ids);
        DB::table('users')->whereIn('id', $student_ids)->update([
            'is_banned' => false,
            'last_login_ip' => null,
            'unique_token' => null,
        ]);

        return response()->json(['message' => 'updated successfully'], 200);
    }
}
