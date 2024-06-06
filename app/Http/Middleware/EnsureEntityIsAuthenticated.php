<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        $adminData = session($entity."_data");
        if (!JWTAuth::setToken($adminData["jwtToken"])->authenticate()) {
            Session::flush();
            return redirect()->route($redirect);
        }

        return $next($request);
    }
}
