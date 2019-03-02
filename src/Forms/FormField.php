<?php namespace Keerill\Widgets\Forms;

use Illuminate\Support\Arr;
use Keerill\Widgets\Traits\Events;
use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Traits\UsableOptions;
use Illuminate\Contracts\View\Factory as View;
use Illuminate\Database\Eloquent\Relations\Relation;

class FormField
{
    use UsableOptions, Events;

    /**
     * Поле, возвращает данную константу, если поле не предусматривает сохранение поля
     */
    const NOT_SAVE_DATA = -1;

    /**
     * @var string Название массива полей, например:
     * <input name="nameArray[fieldName]" />
     */
    public $arrayName;

    /**
     * @var string Класс для DOM div поля
     */
    protected $groupClass = false;

    /**
     * @var string $template Название шаблона для данного поля
     */
    protected $template = 'forms::fields.input';

    /** 
     * @var View $view Шаблонизатор
     */
    protected $view = null;

    /** 
     * @var string $name Название поля
     */
    protected $name = null;

    /**
     * @var string Тип поля
     */
    protected $type = null;

    /**
     * @var FormWidget Форма, к которой принадлежит это поле
     */
    protected $form = null;

    /**
     * Создание нового экземпляра
     *
     * @param View $view
     * @param FormWidget $form
     * @param string $name
     * @param string $type
     */
    public function __construct(View $view, FormWidget $form, string $name, string $type)
    {
        $this->view = $view;
        $this->form = $form;
        $this->name = $name;
        $this->type = $type;

        $this->init();
    }

    /**
     * Возвращает название поля
     * @param string Префикс названий полей
     * @return string
     */
    public function getName(string $arrayName = null)
    {
        return $arrayName ? $arrayName . '.' . $this->name : $this->name;
    }

    /**
     * Возвращает название поля в виде массива
     * @param string $arrayName
     * @return array
     */
    public function getNameToArray(string $arrayName = null)
    {
        return explode('.', $this->getName($arrayName));
    }

    /**
     * Возвращает название поля в формате HTML, т.е. если поле называется property.name => property[name]
     * @return string
     */
    public function getNameToHtml()
    {
        $nameToArray = $this->getNameToArray($this->arrayName);

        if (count($nameToArray) == 1) {
            return $nameToArray[0];
        }

        $firstElement = array_shift($nameToArray);

        return $firstElement . '[' . implode('][', $nameToArray) .']';
    }


    /**
     * Взвращает тип поля
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Инифиализация поля
     *
     * @return void
     */
    public function boot() {}

    /**
     * Возвращает представление данного поля со всеми параметрами
     *
     * @return string
     */
    public function render()
    {
        $this->prepareRender();

        return $this->view->make($this->template)->with([
            'formField' => $this
        ])->render();
    }

    /**
     * Вызывыется перед тем, как начать рендер поля
     * @return void
     */
    protected function prepareRender() {}


    /**
     * Возвращает атрибуты для div блока
     * @return array
     */
    public function getGroupAttributes()
    {
        $attributes = Arr::wrap(config('widgets.attributes.group'));

        if (
            ($customAttributes = config("widgets.customAttributes.{$this->getType()}.group")) &&
            is_array($customAttributes)
        ) {
            $attributes = array_merge($attributes, $customAttributes);
        }

        if ($this->getGroupClass() !== null) {
            $attributes['class'][] = $this->getGroupClass();
        }

        return $attributes;
    }

    /**
     * @return string
     */
    public function getGroupClass()
    {
        return $this->groupClass;
    }

    /**
     * @param string
     * @return self
     */
    public function setGroupClass(string $groupClass)
    {
        $this->groupClass = $groupClass;
        return $this;
    }

    /**
     * Инициализация поля
     * @return void
     */
    protected function init()
    {
        $this->initConfig();

        $this->boot();
    }

    /**
     * Инициализация конфигурации формы. Данные метод предназначен для управления
     * конфигурации формы
     *
     * @return void
     */
    protected function initConfig()
    {
        $this->addConfigOptionsWithMethods([
            'groupClass', 'default'
        ]);
    }
}