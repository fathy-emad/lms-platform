<?php
namespace App\Http\Middleware;

use Closure;
use ApiResponse;
use Illuminate\Routing\Middleware\ThrottleRequests;

class ApiThrottleMiddleware extends ThrottleRequests
{
    protected function resolveRequestSignature($request)
    {
        return $request->user() ? $request->user()->getKey() : $request->ip();
    }

    public function handle($request, Closure $next, $maxAttempts = 60, $decayMinutes = 1, $prefix = '')
    {
        $key = $this->resolveRequestSignature($request);

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            return $this->buildResponse($key);
        }

        $this->limiter->hit($key, $decayMinutes * 60);

        return $next($request);

    }

    protected function buildResponse($key)
    {
        $available = $this->limiter->availableIn($key);
        return ApiResponse::sendError(
            ["Too many attempts, please try again after ($available) second"],
            'Throttle Error',
            null
        );
    }
}

