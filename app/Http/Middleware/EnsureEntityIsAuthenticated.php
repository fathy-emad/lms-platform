<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
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
        if ($this->isTokenInvalid($entity)) {
            $this->handleInvalidToken($entity);
            return redirect()->route($this->getRedirectRoute($entity));
        }

        return $next($request);
    }

    protected function isTokenInvalid($entity): bool
    {
        Auth::shouldUse($entity);
        $token = session($entity . '_data')['jwtToken'] ?? null;
        return !$token || !JWTAuth::setToken($token)->authenticate();
    }

    protected function handleInvalidToken($entity): void
    {
        Session::forget($entity . '_data'); // Specific data removal
        Session::regenerate();
    }

    protected function getRedirectRoute($entity): string
    {
        return match ($entity) {
            'admin' => 'admin.auth.login',
            'teacher' => 'teacher.auth.login',
            'student' => 'student.auth.login',
            default => 'login',
        };
    }
}
