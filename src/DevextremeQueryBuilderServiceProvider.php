<?php

namespace ShaileshMatariya\DevextremeQueryBuilder;

use Illuminate\Support\ServiceProvider;

class DevextremeQueryBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'devextreme-laravel-query-builder');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'devextreme-laravel-query-builder');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('devextreme.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/devextreme-laravel-query-builder'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/devextreme-laravel-query-builder'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/devextreme-laravel-query-builder'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'devextreme');

        // Register the main class to use with the facade
        $this->app->singleton('devextreme-query-builder', function () {
            return new DevextremeQueryBuilder;
        });
    }
}
