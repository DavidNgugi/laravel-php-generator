<?php

namespace LaravelPHPGenerator\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class LaravelPHPGenerator
 *
 * @category PHP
 * @package  LaravelPHPGenerator\Core\Facades
 * @author   David Ngugi <david@davidngugi.com>
*/
class LaravelPHPGenerator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Generator';
    }
}
