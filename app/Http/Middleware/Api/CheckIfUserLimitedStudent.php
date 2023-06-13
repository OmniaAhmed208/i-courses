<?php

namespace App\Http\Middleware\Api;

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
        if (auth()->user() && auth()->user()->hasRole('limited_student')) {
            return response()->json(["success" => false, "message" => "Forbidden access"], 403);
        }
        return $next($request);
    }
}
