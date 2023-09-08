<?php

namespace VarenykySlider\Support;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../migrations');
        $this->loadRoutesFrom(__DIR__.'/../../routes/slider.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'VarenykySlider');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'VarenykySlider');
    }
}
