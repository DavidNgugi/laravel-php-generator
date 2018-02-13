<?php

namespace LaravelPHPGenerator;

use Illuminate\Support\ServiceProvider;

use LaravelPHPGenerator\Commands\GenerateClass;
use LaravelPHPGenerator\Commands\GenerateInterface;
use LaravelPHPGenerator\Commands\GenerateTrait;

/**
 * Class LaravelPHPGeneratorServiceProvider
 *
 * @category PHP
 * @package  LaravelPHPGenerator
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
                GenerateClass::class,
                GenerateInterface::class,
                GenerateTrait::class
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
