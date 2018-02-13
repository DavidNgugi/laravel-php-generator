<?php

namespace DavidNgugi\LaravelPHPGenerator;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelPHPGeneratorServiceProvider
 *
 * @category PHP
 * @package  DavidNgugi\LaravelPHPGenerator
 * @author   David Ngugi <david@davidngugi.com>
*/
class LaravelPHPGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                DavidNgugi\LaravelPHPGenerator\Commands\GenerateClass::class,
                DavidNgugi\LaravelPHPGenerator\Commands\GenerateInterface::class,
                DavidNgugi\LaravelPHPGenerator\Commands\GenerateTrait::class
            ]);
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind our classes here
    }
}
