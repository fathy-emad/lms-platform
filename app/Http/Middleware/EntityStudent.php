<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EntityStudent
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, $entity = null): Response
    {
        Auth::shouldUse("student");

        $token = session('student_data') !== null ? session('student_data')['jwtToken'] : '';

        try {
            JWTAuth::setToken($token)->authenticate();
        } catch (\Exception $e) {
            Session::forget('student_data');
            Session::regenerate();
        }

        return $next($request);
    }
}
