<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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

        $redirect = match ($entity) {
            'admin' => 'admin.dashboard',
            'teacher' => 'teacher.dashboard',
            default => 'website',
        };

        if ($entity == "admin" && isset(session($entity . '_data')["jwtToken"]) && JWTAuth::setToken(session($entity . '_data')["jwtToken"])->authenticate())
            return redirect()->route($redirect);

        elseif ($entity == "teacher" && isset(session($entity . '_data')["jwtToken"]) && JWTAuth::setToken(session($entity . '_data')["jwtToken"])->authenticate())
            return redirect()->route($redirect);


        return $next($request);
    }
}
