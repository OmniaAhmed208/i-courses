<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class WebviewController extends Controller
{
    /**
     * @param null $user
     * @param Lesson $lesson
     * @return Application|Factory|View
     */
    public function index(Lesson $lesson, $user = null)
    {
        $code = null;
        if ($user) {
            $user = User::find($user);
            if (!$lesson->is_free && !$user->is_enrolled($lesson->section->course)) {
                abort(403);
            } elseif ($lesson->is_free || $user->is_enrolled($lesson->section->course)) {
                $code = $user->code;
                return view('website.webviews.index', compact('lesson', 'code', 'user'));
            }
        } else {
            if ($lesson->is_free) {
                return view('website.webviews.index', compact('lesson', 'code', 'user'));
            }
        }
        abort(403);
    }
}
