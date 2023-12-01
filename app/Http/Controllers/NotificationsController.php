<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $notifications = auth()->user()->notifications;
        return view('website.notifications', compact('notifications'));
    }

    public function mark_as_read()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true], 200);
    }
}
