<?php namespace Keerill\Widgets;

use Illuminate\Contracts\Container\Container;
use Keerill\Widgets\Exceptions\WidgetException;

class Builder
{
    /** 
     * @var View $view
     */
    protected $view = null;

    /**
     *  @var Container $container
     */
    protected $container = null;

    /**
     * Создание нового экземпляра
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Создание нового экземпляра виджета
     *
     * @param string $widgetClass Класс виджета, которое наследуется от \App\Support\Widgets\Widget
     * @param array $options Начальные параметры виджета
     * @return Widget
     *
     * @throws WidgetException
     */
    public function make($widgetClass, array $options = null)
    {
        /**
         * Делаем проверку на то, что полученный класс существует
         */
        if (!class_exists($widgetClass)) {
            throw new WidgetException (
                    sprintf('Виджет с классом "%s" не найден', $widgetClass)
                );
        }

        /**
         * Создание нового экземпляра, через контейнер
         * чтобы контейнер при создании виджета подключил все зависимости
         */
        $widget =  $this->container->make($widgetClass, ['options' => $options ?: []]);

        /**
         * Проверяем, тот ли мы объект создали, если вдруг это не виджет вызываем ошибку
         */
        if (!$widget instanceof Widget) {
            throw new WidgetException(sprintf(
                    'Объект [%s] не является виджетом и не может быть создан'
                ));
        }

        return $widget;
    }
}
