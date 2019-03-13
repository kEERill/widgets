<?php namespace Keerill\Widgets\Traits\Controllers;

use Keerill\Widgets\Widget as WidgetBase;
use Keerill\Widgets\Builder as WidgetBuilder;

/**
 * Методы для контроллера использующий виджеты
 */
trait WidgetController
{
    /**
     * @var WidgetBuilder $widgetBuilder Экземпляр создания виджета
     */
    protected $widgetBuilder = null;

    /**
     * Возвращает класс создания виджета
     *
     * @return WidgetBuilder
     */
    protected function getWidgetBuilder()
    {
        return $this->widgetBuilder === null 
            ? $this->widgetBuilder = \App::make('keerill-widget-builder')
            : $this->widgetBuilder;
    }

    /**
     * Создание нового виджета
     *
     * @param string $widgetClass Класс виджета
     * @param array $options Опции для виджета
     * @return WidgetBase
     *
     * @throws \Keerill\Widgets\Exceptions\WidgetException
     */
    protected function makeWidget(string $widgetClass, array $options = null)
    {
        $widget = $this->getWidgetBuilder()->make($widgetClass, $options ?: []);
        $this->extendWidgetCreate($widget);

        return $widget;
    }

    /**
     * Вызывается когда виджет был создан
     *
     * @param WidgetBase $widget
     * @return void
     */
    protected function extendWidgetCreate(WidgetBase $widget) {}
}
