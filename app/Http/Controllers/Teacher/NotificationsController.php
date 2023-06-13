<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $notifications = auth()->user()->notifications;
        return view('teacher.notifications', compact('notifications'));
    }

    public function mark_as_read()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true], 200);
    }
}
