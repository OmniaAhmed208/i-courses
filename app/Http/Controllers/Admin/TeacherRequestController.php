<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherRequest;
use App\Models\User;
use App\Notifications\BecomeTeacherRequestApproved;
use Illuminate\Support\Facades\DB;

class TeacherRequestController extends Controller
{
    public function index()
    {
        $requests = TeacherRequest::with('user')->latest()->paginate(50);
        return view('admin.become_teacher_requests.index', compact('requests'));
    }

    public function approve(TeacherRequest $request, User $user)
    {
        $request_data = $request->toArray();
        unset($request_data['id'], $request_data['created_at'], $request_data['updated_at']);
        DB::transaction(function () use ($request_data, $user, $request) {
            $request->delete();
            Teacher::create($request_data);
            $user->detachRole('student');
            $user->attachRole('teacher');
        });

        $user->notify(new BecomeTeacherRequestApproved());
        session()->flash('success', __('site.request_approved'));
        return redirect()->route('admin.become_teacher_requests.index');
    }

    public function reject(TeacherRequest $request, User $user)
    {
        $request->delete();
        //send notification here
        session()->flash('success', __('site.request_rejected'));
        return redirect()->route('admin.become_teacher_requests.index');
    }
}
