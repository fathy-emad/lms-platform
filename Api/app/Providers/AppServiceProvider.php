<?php

namespace App\Providers;

use App\Http\Concretes\ApiResponse;
use Illuminate\Support\ServiceProvider;
use App\Http\Interfaces\ApiResponseInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiResponseInterface::class, ApiResponse::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
