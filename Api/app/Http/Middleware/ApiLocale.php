<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use App\Models\Locale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class ApiLocale
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
        if ($request->hasHeader('locale'))
        {
            $locale = $request->header('locale');
            $exists_locale = Language::where('locale', $locale)->first();

            if ($exists_locale) App::setLocale($locale);
        }

        return $next($request);
    }
}
