<?php namespace Keerill\Widgets\Forms;

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
     * @var string $value Значение поля
     */
    public $value = null;

    /**
     * @var string Название массива полей, например:
     * <input name="nameArray[fieldName]" />
     */
    public $arrayName;

    /**
     * @var string Заголовок поля
     */
    public $label = null;

    /**
     * @var string Описание поля
     */
    public $comment = null;

    /**
     * @var string Класс для DOM div поля
     */
    public $groupClass = false;

    /**
     * @var mixed
     */
    public $default = null;

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
     * Возвращает стандартное значение поля
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Задает стандартное значение поля
     * @param string Значение поля
     * @return self
     */
    public function setDefault($value)
    {
        $this->default = $value;
        return $this;
    }

    /**
     * Возвращает новое значение поля, по полученным данным
     *
     * @param string|array $data
     * @param null $default
     * @return mixed
     */
    public function getValueByData($data, $default = null)
    {
        /**
         * Преобразуем название поля в массив, например: 
         * Properties[fieldName] => ['properties', 'fieldname']
         */
        $keyParts = $this->getNameToArray();
        $lastField = end($keyParts);
        $result = $data;
        
        /**
         * С помощью цикла, будем искать значения поля, т.к.
         * многомерность данных может быть много
         */
        foreach ($keyParts as $key) {

            /**
             * Если вдруг данные это модель, то делаем проверку на
             * существование связи
             */
            if ($result instanceof Model && $this->hasModelRelation($result, $key)) {
                if ($key == $lastField) {
                    $result = $result->getRelationValue($key) ? : $default;
                } else {
                    $result = $result->{$key};
                }
            }

            /**
             * Если вдруг данные переданы в виде массива, то получаем
             * значение с данным ключем, полученного из названия поля.
             */
            elseif (is_array($result)) {
                if (!array_key_exists($key, $result)) {
                    return $default;
                }
                $result = $result[$key];
            }

            /**
             * Но тут уже понятно, сюда будут относиться модель или какой то объект
             * Модель в данном случае просто не имеет связи с данным именем, поэтому получаем
             * атрибут модели
             */
            else {
                if (!isset($result->{$key})) {
                    return $default;
                }
                $result = $result->{$key};
            }
        }

        return $result;
    }

    /**
     * Возвращает значение поля, для сохранения в модели и т.д. и т.п.
     * @param mixed Значение поля
     * @return mixed
     */
    public function getSaveValue($value)
    {
        return !$value && $this->getDefault() ? $this->getDefault() : self::NOT_SAVE_DATA;
    }

    /**
     * Возвращает значение поля, если значение отсутствует, то возвращает
     * стандартное значение
     * @return string
     */
    public function getValue()
    {
        return $this->value ?: $this->getDefault();
    }

    /**
     * Задает значение поля
     * @param string Значение поля
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Возвращает заголовок поля
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Задает новый заголовок полю
     *
     * @param string $label
     * @return FormField
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Возвращает комментарий для поля
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Задает комментарий для поля
     *
     * @param string $comment
     * @return FormField
     */
    public function setComment(string $comment = null)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Проверяет модель на наличие связи с именем $relationName
     * @param Model $model
     * @param string $relationName Название связи
     * @return boolean
     */
    public function hasModelRelation(Model $model, string $relationName)
    {

        if ($model->relationLoaded($relationName)) {
            return true;
        }

        if (method_exists($model, $relationName) && $model->$relationName() instanceof Relation) {
            return true;
        }

        return false;
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
        $cssClasses = array_wrap(config('widgets.attributes.group'));

        if (
            ($customAttributes = config("widgets.customAttributes.{$this->getType()}.group")) &&
            is_array($customAttributes)
        ) {
            $cssClasses = array_merge($cssClasses, $customAttributes);
        }

        return $cssClasses;
    }

    /**
     * Возвращает атрибуты для Заголовка поля
     * @return array
     */
    public function getLabelAttributes()
    {
        $cssClasses = array_wrap(config('widgets.attributes.label'));

        if (
            ($customAttributes = config("widgets.customAttributes.{$this->getType()}.label")) &&
            is_array($customAttributes)
        ) {
            $cssClasses = array_merge($cssClasses, $customAttributes);
        }

        return $cssClasses;
    }

    /**
     * Возвращает атрибуты для Заголовка поля
     * @return array
     */
    public function getCommentAttributes()
    {
        $cssClasses = array_wrap(config('widgets.attributes.comment'));

        if (
            ($customAttributes = config("widgets.customAttributes.{$this->getType()}.comment")) &&
            is_array($customAttributes)
        ) {
            $cssClasses = array_merge($cssClasses, $customAttributes);
        }

        return $cssClasses;
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
        $this->fillConfig([
            'label', 'labelClass', 'comment', 'commentClass', 'groupClass', 'default'
        ]);
    }
}