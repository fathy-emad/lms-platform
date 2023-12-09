<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class VerifyJwtTokenAndGuard
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @param $guard
     * @return Response
     */
    public function handle(Request $request, Closure $next, $guard): Response
    {
        Auth::shouldUse($guard);

        try {
            // Check if the token is present
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Check if guard is valid
            if (!Auth::check()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            // Handle different types of JWT exceptions
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error' => 'Token expired'], $e->getStatusCode());
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error' => 'Token invalid'], $e->getStatusCode());
            } else {
                return response()->json(['error' => 'Authorization Token not found'], 401);
            }
        }

        return $next($request);
    }
}
