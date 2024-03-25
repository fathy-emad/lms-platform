<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebLocale
{
    /**
     * web locale
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     *
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! in_array(session("locale"), ['en', 'ar'])) {
            Session()->put('locale', app()->getLocale());
        } else {
            app()->setLocale(session("locale"));
        }
        return $next($request);
    }
}
