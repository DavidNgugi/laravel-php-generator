<?php


namespace LaravelPHPGenerator\Core;

use Illuminate\Support\ServiceProvider;

/**
 * Class McashServiceProvider
 *
 * @category PHP
 * @package  LaravelPHPGenerator\Core
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
                Commands\GenerateClass::class,
                Commands\GenerateInterface::class,
                Commands\GenerateTrait::class,
                Commands\TestCommand::class
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
