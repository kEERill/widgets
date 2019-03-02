<?php namespace Keerill\Widgets\Forms\Types;

use Keerill\Widgets\Forms\Types\Helpers\Label;
use Keerill\Widgets\Forms\Types\Helpers\Value;
use Keerill\Widgets\Forms\Types\Helpers\Comment;
use Keerill\Widgets\Forms\Types\Interfaces\Value as ValueInterface;
use Illuminate\Support\Arr;


class InputType extends \Keerill\Widgets\Forms\FormField implements ValueInterface
{
    use Label, Comment, Value;

    /**
     * @var string Класс для DOM input поля
     */
    protected $inputClass = null;

    /**
     * @var boolean Если true, то поле будет недоступно для редактирования
     */
    protected $disabled = false;

    /**
     * @var string Заглушка для пустого поля
     */
    protected $placeholder = null;

    /**
     * @var string
     */
    protected $template = 'widgets::forms.fields.input';

    /**
     * Инифиализация поля
     * @return void
     */
    public function initConfig()
    {
        parent::initConfig();
        
        $this->addConfigOptionsWithMethods([
            'label', 'labelClass', 'comment', 'commentClass', 'inputClass', 'disabled', 'placeholder', 'value', 'default'
        ]);
    }

    /**
     * Название полей для валидации
     * @return array
     */
    public function getValidationName()
    {
        return [$this->getName() => $this->getLabel()];
    }

    /**
     * Возвращает значение поля, если значение отсутствует, то возвращает
     * стандартное значение
     * @return string
     */
    public function getValue()
    {
        return ($this->getDisabled()) ? null : $this->value ?: $this->getDefault();
    }

    /**
     * Возвращает атрибуты для input
     * @return array
     */
    public function getInputAttributes()
    {
        $attributes = Arr::wrap(config('widgets.attributes.input'));

        if (
            ($customAttributes = config("widgets.customAttributes.{$this->getType()}.input")) &&
            is_array($customAttributes)
        ) {
            $attributes = array_merge($attributes, $customAttributes);
        }

        if ($this->getPlaceholder()) {
            $attributes['placeholder'] = $this->getPlaceholder();
        }

        if ($this->getInputClass() !== null) {
            $attributes['class'][] = $this->getInputClass();
        }

        $errors = request()->session()->get('errors');

        if ($errors && $errors->hasBag('default') && $errors->getBag('default')->has($this->getName())) {
            $attributes['class'][] = config("widgets.customCssStyles.{$this->getType()}.input-danger") ?: config('widgets.cssStyles.input-danger');
        }

        if ($this->getDisabled()) {
            $attributes[] = 'disabled';
        }
        
        return $attributes;
    }

    /**
     * Проверка на то, что поле выключено
     * @return bool
     */
    public function getDisabled()
    {
        return (bool) $this->disabled;
    }

    /**
     * Отключает поле
     * @return InputType
     */
    public function setDisabled(bool $disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * Возвращает placeholder поля
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Задает placeholder для поля
     * @param string $placeholder
     * @return InputType
     */
    public function setPlaceholder(string $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * Возвращает классы для поля
     * @return string
     */
    public function getInputClass()
    {
        return $this->inputClass;
    }

    /**
     * Изменяет классы для поля
     * @param string
     * @return self
     */
    public function setInputClass(string $inputClass)
    {
        $this->inputClass = $inputClass;
        return $this;
    }
}
