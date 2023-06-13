<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Contracts\Support\Renderable;
use CyrildeWit\EloquentViewable\Support\Period;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $trending_courses = Course::orderByUniqueViews('desc', Period::pastDays(7))->withCount('rates', 'lessons')->limit(6)->get();
        $most_popular_courses = Course::orderByUniqueViews()->withCount('rates', 'lessons')->limit(6)->get();
        $most_recent_courses = Course::where('status', Course::STATUS_PUBLISHED)->with('instructor')->withCount('rates', 'lessons')->latest()->limit(6)->get();
        $instructors_count = Teacher::count();
        $students_enrolled = DB::table('student_course')->count(DB::raw('DISTINCT student_id'));
        return view('website.home', compact('trending_courses', 'most_popular_courses', 'most_recent_courses', 'instructors_count', 'students_enrolled'));
    }
}
