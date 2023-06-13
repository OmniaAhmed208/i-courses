<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['success' => false, 'message' => 'Invalid Token'], 401);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json(['success' => false, 'message' => 'Expired Token'], 401);
            } else {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }
        }
        return $next($request);
    }
}
