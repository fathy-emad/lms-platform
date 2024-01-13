<?php

namespace App\Providers;

use App\Concretes\ApiResponse;
use App\Interfaces\ApiResponseInterface;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ApiResponseInterface::class, ApiResponse::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
