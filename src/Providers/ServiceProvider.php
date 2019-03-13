<?php

namespace Keerill\Widgets\Providers;

use Illuminate\Support\Facades\Route;
use Keerill\Widgets\Builder as Builder;
use Illuminate\Support\ServiceProvider as ServiceProviderBase;

class ServiceProvider extends ServiceProviderBase
{
    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        $this->commands(\Keerill\Widgets\Console\CreateWidgetCommand::class);
        $this->commands(\Keerill\Widgets\Console\FormWidgetCommand::class);
        $this->commands(\Keerill\Widgets\Console\ListWidgetCommand::class);

        /**
         * Создаем новый hint, т.е. теперь доступ к шаблонам будет начинаться с forms::
         * Сделано для того, что бы стандартные шаблоны полей и форм были отдельно
         */
        $this->loadViewsFrom(__DIR__ . '/../../views', 'widgets');

        $this->publishes([
            __DIR__ . '/../../views' => base_path('resources/views/vendor/widgets')
        ], 'widgets-view');

        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('widgets.php')
        ], 'widgets-config');
    }

    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'widgets'
        );

        $this->app->singleton('keerill-widget-builder', function ($app) {
            return new Builder($app);
        });

        $this->app->alias('WidgetBuilder', \Keeril\Widgets\Facades\WidgetBuilder::class);
    }
}
