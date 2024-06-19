<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {

            //api routes
            Route::prefix('api')->middleware('api')->group(function (){

                //Admin routes
                Route::prefix('admin')->group(base_path('routes/admin.php'));

                //Teacher routes
                Route::prefix('teacher')->group(base_path('routes/teacher.php'));

                //Student routes
                Route::prefix('student')->group(base_path('routes/student.php'));

                //Web services routes
                Route::prefix('web-services')->group(base_path('routes/web_services.php'));

            });

            Route::middleware('web')->group(base_path('routes/web.php'));
        });
    }
}
