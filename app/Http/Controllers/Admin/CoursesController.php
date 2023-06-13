<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadExcelRequest;
use App\Imports\UsersImport;
use App\Models\Course;
use App\Models\RejectNote;
use App\Models\StudentsGroup;
use App\Models\User;
use App\Notifications\CourseApproved;
use App\Notifications\CourseDestroyed;
use App\Notifications\CourseRejected;
use App\Services\RandomUserCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Excel;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $courses = Course::where('status', '!=', Course::STATUS_DRAFT)->with('instructor')->withCount('rates')->when($request->status, function ($q) use ($request) {
            $q->where('status', $request->status);
        })->latest()->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    public function show($course)
    {
        $course = Course::with('sections', 'sections.lessons')->withCount('lessons')->where('slug', $course)->first();
        return view('admin.courses.show', compact('course'));
    }

    public function approve(Course $course)
    {
        Cache::forget('pending_courses_count');
        $course->approve();

        $course->instructor->notify(new CourseApproved($course));
        session()->flash('success', __('site.course_approved'));
        return redirect()->back();
    }

    public function reject(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required|integer',
            'note' => 'required|string'
        ]);
        $reject_note = RejectNote::create([
            'rejected_by' => auth()->user()->id,
            'course_id' => $request->course_id,
            'note' => $request->note
        ]);
        Cache::forget('pending_courses_count');
        $course = Course::find($request->course_id);
        $course->reject();

        $course->instructor->notify(new CourseRejected($course, $reject_note));
        session()->flash('success', __('site.course_rejected'));
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required|integer'
        ]);
        $course = Course::find($request->course_id);
        $course->instructor->notify(new CourseDestroyed($course->title));
        $course->delete();
        Cache::forget('pending_courses_count');

        session()->flash('success', __('site.course_deleted'));
        return redirect()->route('admin.courses.index');
    }

    public function generate_students_page($course)
    {
        $course = Course::where('slug', $course)->first();
        return view('admin.courses.students_management', compact('course'));
    }

    public function generated_students(Request $request, $course)
    {
        $course = Course::where('slug', $course)->first();
        $generated_students = User::with('group')->where('course_id', $course->id)->when($request->search, function ($q) use ($request) {
            $q->where('email', $request->search)->orWhere('code', $request->search)->orWhere('mobile', 'LIKE', '%' . $request->search . '%');
        })->paginate(25);
        return view('admin.courses.course_students', compact('generated_students', 'course'));
    }

    public function generate_students(Request $request, Course $course)
    {
        $this->validate($request, [
            'students_number' => 'required|integer|min:1|max:1000',
        ]);
        $group = null;
        if ($request->group_name) {
            $group = StudentsGroup::create([
                'name' => $request->group_name,
                'course_id' => $course->id
            ]);
        }
        $uniqueCodeService = new RandomUserCode();
        for ($i = 0; $i < $request->students_number; $i++) {
            try {
                $rand = uniqid();
                $code = $uniqueCodeService->generate_unique_code();
                $email = substr($rand, strlen($rand) - 4, 4) . substr($code, 0, 2);
                $password = $code . substr($rand, strlen($rand) - 3, 3);
                DB::transaction(function () use ($email, $password, $code, $course, $group) {
                    $user = User::create([
                        'email' => $email . '@sun.com',
                        'password' => bcrypt($password),
                        'code' => $code,
                        'course_id' => $course->id,
                        'email_verified_at' => now(),
                        'group_id' => $group ? $group->id : null
                    ]);
                    $user->attachRole('limited_student');
                    $course->students()->attach($user->id, ['progress' => 0, 'expired' => false]);
                });

            } catch (\PDOException $e) {
                Log::error($e);
                continue;
            }
        }
        session()->flash('success', __('site.students_generated'));
        return redirect()->route('admin.courses.generate_students_page', $course->slug);
    }

    public function delete_all_generated_students($course)
    {
        $course = Course::where('slug', $course)->first();
        $course->generated_students()->delete();

        session()->flash('success', __('site.all_students_deleted_successfully'));
        return redirect()->back();
    }

    public function block_all_generated_students($course)
    {
        $course = Course::where('slug', $course)->first();
        $course->generated_students()->update([
            'is_banned' => true
        ]);

        session()->flash('success', __('site.all_students_blocked_successfully'));
        return redirect()->back();
    }

    public function unblock_all_generated_students($course)
    {
        $course = Course::where('slug', $course)->first();
        $course->generated_students()->update([
            'is_banned' => false,
            'last_login_ip' => null,
            'unique_token' => null,
        ]);

        session()->flash('success', __('site.all_students_unblocked_successfully'));
        return redirect()->back();
    }

    public function download_students(Course $course)
    {
        return (new UsersExport($course))->download($course->slug . '.xlsx');
    }

    public function upload_students(UploadExcelRequest $request)
    {
        Excel::import(new UsersImport, $request->file('file'));

        session()->flash('success', __('site.students_data_updated_successfully'));
        return redirect()->back();
    }
}
