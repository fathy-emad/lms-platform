<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureEntityIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, $entity = null): Response
    {
        $redirect = match ($entity) {
            'admin' => 'admin.auth.login',
            default => 'login',
        };

        if (!isset(session($entity."_data")["jwtToken"]) || !JWTAuth::setToken(session($entity."_data")["jwtToken"])->authenticate()) {
            Session::flush();
            return redirect()->route($redirect);
        }

        return $next($request);
    }
}
