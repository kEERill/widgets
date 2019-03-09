<?php namespace Keerill\Widgets;

use Keerill\Widgets\Traits\Events;
use Illuminate\View\Factory as View;
use Keerill\Widgets\Traits\HtmlTrait;
use Keerill\Widgets\Traits\UsableOptions;

class Widget
{
    use UsableOptions, Events, HtmlTrait;

    /**
     * @var array $addedJs Подключенные JS скрипты данной формы
     */
    protected $addedJs = [];

    /**
     * @var array $addedCss Подключенные CSS данной формы
     */
    protected $addedCss = [];
    
    /** 
     * @var View $view Шаблонизатор
     */
    protected $view = null;

    /** 
     * @var string $template Название шаблона формы 
     */
    protected $template = 'widgets::layouts.base';

    /**
     * @var string Уникальное имя виджета
     */
    protected $alias = null;

    /**
     * Создание нового экземпляра
     *
     * @param View $view
     * @param array $options
     * @return void
     */
    public function __construct(View $view, array $options = [])
    {
        $this->view = $view;

        /**
         * Инициализация виджета
         */
        $this->init($options);
    }

    /**
     * Инициализация формы
     *
     * @param array $options Начальные параметры для формы
     * @return void
     */
    protected function init(array $options)
    {
        /**
         * Инициализация конфигурации формы
         */
        $this->initConfig();

        /**
         * Заполнение формы начальными нужными данными
         */
        $this->setOptions($options);

        /**
         * После того, как все подготовки формы выполнены начинаем инициализацию остальных компонентов
         * формы
         */
        $this->boot($options);
    }

    /**
     * Инициализация конфигурации формы. Данные метод предназначен для управления
     * конфигурации формы
     *
     * @return void
     */
    protected function initConfig() {}

    /**
     * Вызывается после инициализации основных элементов формы
     *
     * @param array $options
     * @return void
     */
    protected function boot(array $options) {}

    /**
     * Задает новый шаблон представления виджета
     *
     * @param string $template
     * @return Widget
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * Возвращает назнание шаблона
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Подключение CSS к форме
     *
     * @param string $url Путь до CSS файла
     * @return void
     */
    public function addCss($url)
    {
        if (!in_array($url, $this->addedCss)) {
            $this->addedCss[] = $url;
        }
    }

    /**
     * Подключение JS к форме
     *
     * @param string $url Путь до JS файла
     * @return void
     */
    public function addJs($url)
    {
        if (!in_array($url, $this->addedJs)) {
            $this->addedJs[] = $url;
        }
    }

    /**
     * Возвращает HTML сущность подключения стилей
     *
     * @return mixed
     * @throws \Throwable
     */
    public function styles()
    {
        return view('widgets::styles')->with([
            'styles' => $this->addedCss
        ])->render();   
    }

    /**
     * Возвращает HTML сущность подключения скриптов
     *
     * @return mixed
     * @throws \Throwable
     */
    public function scripts()
    {
        return view('widgets::scripts')->with([
                'scripts' => $this->addedJs
            ])->render();
    }

    /**
     * Вызывается перед тем, как виджет начинается рендериться
     *
     * @throws \Throwable
     * @return void
     */
    protected function prepareRender() {}

    /**
     * Возвращает скомпилированную шаблонизатором форму
     * @return string
     * @throws \Throwable
     */
    public function render()
    {
        /**
         * Делаем некоторые подготовления формы к рендеру
         */
        $this->prepareRender();

        $options = $this->extendRenderOptions([
                'widget' => $this
            ]);

        $this->fireEvent('widget.prepareRender', [$this, $options]);

        /**
         * Начинаем рендер формы
         */
        return $this->view->make($this->getTemplate())->with($options);
    }

    /**
     * Наследуем параметры, которые будут передоваться в view
     *
     * @param array $options
     * @return array
     */
    protected function extendRenderOptions(array $options)
    {
        return $options;
    }
}
