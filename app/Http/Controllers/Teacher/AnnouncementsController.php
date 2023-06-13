<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAnnouncementRequest;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\User;
use App\Notifications\AnnouncementNotification;
use Illuminate\Support\Facades\Notification;

class AnnouncementsController extends Controller
{
    public function index(Course $course)
    {
        $announcements = Announcement::with('group')->where('course_id', $course->id)->paginate(25);
        $groups = $course->groups;
        return view('teacher.courses.announcements.index', compact('announcements', 'groups', 'course'));
    }

    public function store(CreateAnnouncementRequest $request, Course $course)
    {
        $data['body'] = $request->body;
        $data['group_id'] = $request->group_id != "null" ? (int)$request->group_id : null;
        $data['course_id'] = $course->id;
        $announcement = Announcement::create($data);
        //notify students here
        if ($data['group_id']) {
            $students = User::where('group_id', $data['group_id'])->get();
        } else {
            $students = $course->students;
        }
        Notification::send($students, new AnnouncementNotification($course->slug, auth()->user()->name, $announcement));
        session()->flash('success', __('site.announcement_added'));
        return redirect()->back();
    }
}
