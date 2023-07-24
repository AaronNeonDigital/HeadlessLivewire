<?php

namespace AaronNeonDigital\HeadlessLivewire;

use AaronNeonDigital\HeadlessLivewire\Livewire\Input;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class HeadlessLivewireServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'headless-livewire');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->registerLivewireComponents();
    }

    protected function registerLivewireComponents(): void
    {
        Livewire::component('input', Input::class);
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
    public function provides(): array
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
    }
}
