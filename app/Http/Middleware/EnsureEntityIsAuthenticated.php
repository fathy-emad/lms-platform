<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
            default => 'login', // Adjust this default as necessary
        };

        $adminData = session($entity."_data", null);
        if (!$adminData) {
            Session::flush();
            $cookie = Cookie::forget('laravel_session');
            return redirect()->route($redirect)->withCookie($cookie);
        }

        return $next($request);
    }
}
