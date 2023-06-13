<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $course_ids = Course::select('id')->where('status', Course::STATUS_PUBLISHED)->where('instructor_id', auth()->user()->id)->get()->pluck('id');
        $course_count = count($course_ids);
        $students_count = DB::table('student_course')->whereIn('course_id', $course_ids)->select(DB::raw('DISTINCT student_id'))->count();
        $balance = auth()->user()->available_balance;
        return view('teacher.home', compact('course_count', 'students_count', 'balance'));
    }
}
