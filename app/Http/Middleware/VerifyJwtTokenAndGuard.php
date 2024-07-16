<?php

namespace App\Http\Middleware;

use Closure;
use ApiResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
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
        try {
            $auth = JWTAuth::parseToken();
            // Authenticate user based on token and set guard
            if (!$auth->authenticate()) {
                return ApiResponse::sendError(["You are not authenticated, please login"], "Authentication error", null);
            }

            if ($auth->getPayload()->get('guard') !== $guard) {
                return ApiResponse::sendError(["You are not Authorized to be here, please login"], "Authorization error", null);
            }

            $request->attributes->set('guard', $guard);

        } catch (JWTException $e) {

            // Handling different types of JWT exceptions
            if ($e instanceof TokenExpiredException) {
                return ApiResponse::sendError([$e->getMessage()], "Token expired", null);

            } elseif ($e instanceof TokenInvalidException) {
                return ApiResponse::sendError([$e->getMessage()], "Token is invalid", null);

            } else {
                return ApiResponse::sendError(["Authorization token not found, please login"], "Token not found", null);
            }
        }

        return $next($request);
    }
}
