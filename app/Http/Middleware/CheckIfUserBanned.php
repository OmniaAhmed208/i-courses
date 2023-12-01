<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfUserBanned
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
        if (auth()->user()->is_banned) {
            return redirect()->route('banned');
        }
        return $next($request);
    }
}
