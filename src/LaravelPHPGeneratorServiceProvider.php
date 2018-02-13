<?php

namespace DavidNgugi\Generator;

use Illuminate\Support\ServiceProvider;

use DavidNgugi\Generator\Commands\GenerateClass;
use DavidNgugi\Generator\Commands\GenerateInterface;
use DavidNgugi\Generator\Commands\GenerateTrait;

/**
 * Class McashServiceProvider
 *
 * @category PHP
 * @package  DavidNgugi\Generator
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
