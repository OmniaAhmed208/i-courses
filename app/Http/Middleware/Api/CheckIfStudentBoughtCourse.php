<?php

namespace App\Http\Middleware\Api;

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
        if ($course && auth()->user()) {
            $boughtCourse = auth()->user()->courses()->where('course_id', $course->id)->first();
            if (!$boughtCourse || $boughtCourse->pivot->expired) {
                return response()->json(['success' => false, "message" => 'Can\'t Access this Course, Please Buy it first']);
            }
        } else {
            return response()->json(['success' => false, "message" => 'Not Found'], 404);
        }
        return $next($request);
    }
}
