<?php

namespace App\Providers;

use App\Interfaces\ApiResponseInterface;
use App\Services\ApiResponse;
use App\Services\PaymobService;
use App\Services\TranslationService;
use App\Services\UploadFileService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ApiResponseInterface::class, ApiResponse::class);

        $this->app->singleton(TranslationService::class, function ($app){
            return new TranslationService();
        });

        $this->app->singleton(UploadFileService::class, function ($app){
            return new UploadFileService();
        });

        $this->app->singleton(PaymobService::class, function ($app){
            return new PaymobService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
