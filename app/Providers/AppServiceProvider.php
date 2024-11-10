<?php

namespace App\Providers;

use App\Services\RecaptchaService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function login(): void
    {
        $this->app->singleton(RecaptchaService::class, function ($app) {
            return new RecaptchaService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
