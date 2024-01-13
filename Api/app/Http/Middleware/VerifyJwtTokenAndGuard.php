<?php

namespace App\Http\Middleware;

use Closure;
use ApiResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
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
                return ApiResponse::sendError(["you not Authenticated please login"], "Authentication error",null);
            }

            // Check if guard is valid
            if (!Auth::check()) {
                return ApiResponse::sendError(["you not Authorized or allow to be here"], "Authorization error",null);
            }

        } catch (JWTException $e) {

            // Handle different types of JWT exceptions
            if ($e instanceof TokenExpiredException) {
                return ApiResponse::sendError([$e->getMessage()], "Token expired", null);

            } elseif ($e instanceof TokenInvalidException) {
                return ApiResponse::sendError([$e->getMessage()], "Token is invalid", null);

            } else {
                return ApiResponse::sendError(["Authorization Token not found please login"], "Token not found", null);
            }
        }

        return $next($request);
    }
}
