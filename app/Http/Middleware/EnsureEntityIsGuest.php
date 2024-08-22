<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class EnsureEntityIsGuest
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, $entity = null): Response
    {

        Auth::shouldUse($entity);

        $redirect = match ($entity) {
            'admin' => 'admin.dashboard',
            'teacher' => 'teacher.dashboard',
            'student' => 'student.home',
            default => 'website',
        };

        if ($entity == "admin" && isset(session($entity . '_data')["jwtToken"]) && JWTAuth::setToken(session($entity . '_data')["jwtToken"])->authenticate())
            return redirect()->route($redirect);

        elseif ($entity == "teacher" && isset(session($entity . '_data')["jwtToken"]) && JWTAuth::setToken(session($entity . '_data')["jwtToken"])->authenticate())
            return redirect()->route($redirect);

        elseif ($entity == "student" && isset(session($entity . '_data')["jwtToken"]) && JWTAuth::setToken(session($entity . '_data')["jwtToken"])->authenticate())
            return redirect()->route($redirect);


        return $next($request);
    }
}
