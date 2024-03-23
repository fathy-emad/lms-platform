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

                //api admin routes
                Route::prefix('/admin')->group(function (){

                    Route::prefix('/auth')
                        ->group(base_path('routes/admin_auth.php'));

                    Route::prefix('/employee')
                        ->group(base_path('routes/admin_employee.php'));

                    Route::prefix('/setting')
                        ->group(base_path('routes/admin_setting.php'));

                    Route::prefix('/setting-education')
                        ->group(base_path('routes/admin_setting_education.php'));

                    Route::prefix('/teacher')
                        ->group(base_path('routes/admin_teacher.php'));

                    Route::prefix('/course')
                        ->group(base_path('routes/admin_course.php'));
                });


                //api teacher routes
                Route::prefix('/teacher')->group(function (){
                    //some routes
                });

                //Web services routes
                Route::prefix('/web-services')->group(base_path('routes/web_services.php'));

            });


            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
