<?php

namespace AaronNeonDigital\HeadlessLivewire;

use Illuminate\Support\ServiceProvider;

class HeadlessLivewireServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'aaronneondigital');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'aaronneondigital');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/headlesslivewire.php', 'headlesslivewire');

        // Register the service the package provides.
        $this->app->singleton('headlesslivewire', function ($app) {
            return new HeadlessLivewire;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['headlesslivewire'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/headlesslivewire.php' => config_path('headlesslivewire.php'),
        ], 'headlesslivewire.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/aaronneondigital'),
        ], 'headlesslivewire.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/aaronneondigital'),
        ], 'headlesslivewire.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/aaronneondigital'),
        ], 'headlesslivewire.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
