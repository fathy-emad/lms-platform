<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEntityIsGuest
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, $entity = null): Response
    {
        // Define the redirection routes for each entity
        $redirects = [
            'admin' => 'admin.dashboard',
            // Add more entities and their respective dashboard routes here
        ];

        $entityData = session($entity . '_data', null);

        // If session data exists for the entity, redirect to their "dashboard"
        if ($entityData) {
            $redirectRoute = $redirects[$entity] ?? null;
            if ($redirectRoute) {
                return redirect()->route($redirectRoute);
            }
        }
        return $next($request);
    }
}
