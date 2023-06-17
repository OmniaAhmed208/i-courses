<?php

namespace App\Http\Middleware;

use App\Models\Course;
use Closure;
use Illuminate\Http\Request;

class CheckIfStudentBoughtCourse
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $slug = $request->route()->parameter('course');
        $course = Course::where('slug', $slug)->first();
        if ($course) {
            $boughtCourse = auth()->user()->courses()->where('course_id', $course->id)->first();
            if (!$boughtCourse || $boughtCourse->pivot->expired) {
                session()->flash('error', 'Can\'t Access this Course, Please Buy it first');
                return redirect()->route('courses.show', $course->slug);
            }
        } else {
            return response()->view('errors.404', [], 404);
        }
        return $next($request);
    }
}
