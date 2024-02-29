<?php

namespace App\Http\Middleware;

use Closure;
use ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {

//        dd(auth()->user()->permission->permissions);

//        ApiResponse::sendError(
//            ["Too many attempts, please try again after second"],
//            'Throttle Error',
//            null
//        );

        return $next($request);
    }
}
