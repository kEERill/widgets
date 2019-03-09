<?php namespace Keerill\Widgets\Forms;

use Illuminate\Support\Arr;
use Keerill\Widgets\Traits\Events;
use Keerill\Widgets\Traits\ThemeTrait;
use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Traits\UsableOptions;
use Illuminate\Contracts\View\Factory as View;
use Illuminate\Database\Eloquent\Relations\Relation;

class FormField
{
    use UsableOptions, Events, ThemeTrait;

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
    protected $template = 'forms.fields.input';

    /**
     * @var string $templateField Название шаблона, в который вставляется поле
     */
    protected $templateField = 'forms.field';

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
     * @var string Название темы
     */
    protected $theme = null;

    /**
     * @var string
     */
    protected $state = null;
    
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
     * Возвращает ID поля в HTML
     * @param string $suffix
     * @return string
     */
    public function getId(string $suffix = null)
    {
        $id = 'formField-' . class_basename($this->form);

        if ($this->type) 
            $id .= '-' . $this->type;

        if ($this->name) 
            $id .= '-' . $this->name;

        if ($suffix !== null)
            $id .= '-' . $suffix;

        return $id;
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
     * Возвращает название шаблона
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
        return $this->getTemplateName($this->template);
    }

    /**
     * Возвращает название шаблона
     * @param string $templateField
     * @return Widget
     */
    public function setTemplateField(string $templateField)
    {
        $this->templateField = $templateField;
        return $this;
    }

    /**
     * Возвращает назнание шаблона
     * @return string
     */
    public function getTemplateField()
    {
        return $this->getTemplateName($this->templateField);
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

        return $this->view->make($this->getTemplateField())->with([
                'formField' => $this
            ])->render();
    }

    /**
     * Вызывыется перед тем, как начать рендер поля
     * @return void
     */
    protected function prepareRender() {}

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
            'groupClass', 'default', 'template', 'templateField'
        ]);
    }
}