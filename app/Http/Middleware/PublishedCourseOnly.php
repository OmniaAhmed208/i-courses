<?php

namespace App\Http\Middleware;

use App\Models\Course;
use Closure;

class PublishedCourseOnly
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $course = Course::where('slug', $request->course)->orWhere('id', $request->course)->first();
        if (!$course || $course->status != Course::STATUS_PUBLISHED) {
            abort(403);
        }
        return $next($request);
    }
}
