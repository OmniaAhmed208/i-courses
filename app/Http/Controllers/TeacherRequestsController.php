<?php

namespace App\Http\Controllers;

use App\Http\Requests\BecomeTeacherRequest;
use App\Models\TeacherRequest;
use App\Models\User;
use App\Notifications\RechargeRequestCreated;
use App\Notifications\TeacherRequestCreated;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class TeacherRequestsController extends Controller
{
    public function index()
    {
        return view('website.become-teacher');
    }

    public function store(BecomeTeacherRequest $request)
    {
        auth()->user()->update([
            'mobile' => $request->mobile
        ]);
        TeacherRequest::create($request->validated());

        //notify admins
        $admins = User::whereRoleIs('admin')->orWhereRoleIs('moderator')->get();
        Notification::send($admins, new TeacherRequestCreated(auth()->user()));

        session()->flash('success', __('site.become_teacher_request_sent'));
        return redirect()->route('home');
    }
}
