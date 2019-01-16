<?php namespace Keerill\Widgets\Forms\Types;

class InputType extends \Keerill\Widgets\Forms\FormField
{
    /**
     * @var string Класс для DOM input поля
     */
    public $cssClass = false;

    /**
     * @var boolean Если true, то поле будет недоступно для редактирования
     */
    public $disabled = false;

    /**
     * @var string Заглушка для пустого поля
     */
    public $placeholder = null;

    /**
     * @var string
     */
    protected $template = 'widgets::forms.fields.input';

    /**
     * Инифиализация поля
     * @return void
     */
    public function boot()
    {
        $this->fillConfig([
            'cssClass', 'disabled', 'placeholder'
        ]);
    }

    /**
     * Возвращает атрибуты для input
     * @return array
     */
    public function getInputAttributes()
    {
        $cssClasses = array_wrap(config('widgets.attributes.input'));

        if (
            ($customAttributes = config("widgets.customAttributes.{$this->getType()}.input")) &&
            is_array($customAttributes)
        ) {
            $cssClasses = array_merge($cssClasses, $customAttributes);
        }

        if ($this->getPlaceholder()) {
            $cssClasses['placeholder'] = $this->getPlaceholder();
        }

        $errors = request()->session()->get('errors');

        if ($errors && $errors->hasBag('default') && $errors->getBag('default')->has($this->getName())) {
            $cssClasses['class'][] = config("widgets.customCssStyles.{$this->getType()}.input-danger") ?: config('widgets.cssStyles.input-danger');
        }
        
        return $cssClasses;
    }

    /**
     * Проверка на то, что поле выключено
     * @return bool
     */
    public function hasDisabled()
    {
        return (bool) $this->disabled;
    }

    /**
     * Отключает поле
     * @return InputType
     */
    public function disabled()
    {
        $this->disabled = true;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSaveValue($value)
    {
        if ($this->disabled) {
            return self::NOT_SAVE_DATA;
        }

        return !$value && $this->getDefault() ? $this->getDefault() : $value;
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
}
