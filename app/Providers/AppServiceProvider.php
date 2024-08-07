<?php

namespace App\Providers;

use App\Concretes\CheckoutManual;
use App\Services\ApiResponse;
use App\Services\CheckoutService;
use App\Services\PaymobService;
use App\Services\UploadFileService;
use App\Services\TranslationService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\ApiResponseInterface;

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

        $this->app->singleton(CheckoutService::class, function ($app){
            return new CheckoutService();
        });

        $this->app->singleton(NotificationService::class, function ($app){
            return new NotificationService();
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
