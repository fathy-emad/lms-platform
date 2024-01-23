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

            Route::middleware('api')
                ->prefix('/api/admin/auth')
                ->group(base_path('routes/auth_admin.php'));

            Route::middleware('api')
                ->prefix('api/employee')
                ->group(base_path('routes/employee.php'));

            Route::middleware('api')
                ->prefix('api/setting')
                ->group(base_path('routes/setting.php'));

            Route::middleware('api')
                ->prefix('api/setting-education')
                ->group(base_path('routes/setting_education.php'));

            Route::middleware('api')
                ->prefix('api/teacher')
                ->group(base_path('routes/teacher.php'));

            Route::middleware('api')
                ->prefix('api/course')
                ->group(base_path('routes/course.php'));

            Route::middleware('api')
                ->prefix('/api/teacher/auth')
                ->group(base_path('routes/auth_teacher.php'));


//            Route::middleware('api')
//                ->group(base_path('routes/student.php'));
//
//            Route::middleware('api')
//                ->prefix('teacher')
//                ->group(base_path('routes/teacher.php'));
//
//            Route::middleware('api')
//                ->prefix('parent')
//                ->group(base_path('routes/parent.php'));

//            Route::middleware('web')
//                ->group(base_path('routes/web.php'));
        });
    }
}
