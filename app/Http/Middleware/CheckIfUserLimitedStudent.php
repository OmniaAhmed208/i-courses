<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfUserLimitedStudent
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
        if (auth()->user() && auth()->user()->hasRole('limited_student') && auth()->user()->course) {
            return redirect()->route('courses.study', auth()->user()->course->slug);
        }
        return $next($request);
    }
}
