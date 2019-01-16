<?php namespace Keeril\Widgets\Facades;

use Illuminate\Support\Facades\Facade as Facade;

class WidgetBuilder extends Facade
{

    /**
     * Get the registered name of the component.
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'keerill-widget-builder';
    }
}