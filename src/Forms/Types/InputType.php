<?php namespace Keerill\Widgets\Forms\Types;

use Keerill\Widgets\Forms\Types\Interfaces\{
    Value as ValueInterface, Validation as ValidationInterface};
use Keerill\Widgets\Forms\Types\Helpers\{
    Label, Value as ValueField, Comment, Placeholder, Validation };

class InputType extends \Keerill\Widgets\Forms\FormField implements ValueInterface, ValidationInterface
{
    use Label, Comment, ValueField, Placeholder, Validation;

    /**
     * @var string Класс для DOM input поля
     */
    protected $inputClass = null;

    /**
     * @var string
     */
    protected $template = 'forms.fields.input';

    /**
     * Инифиализация поля
     * @return void
     */
    public function initConfig()
    {
        parent::initConfig();
        
        $this->addConfigOptionsWithMethods([
            'label', 
            'labelClass', 
            'comment', 
            'commentClass', 
            'inputClass', 
            'disabled', 
            'placeholder', 
            'value', 
            'default'
        ]);
    }

    /**
     * Название полей для валидации
     * @return array
     */
    public function getValidationName()
    {
        return [
                $this->getName() => $this->getLabel()
            ];
    }

    /**
     * Возвращает классы для поля
     * @return string
     */
    public function getInputClass()
    {
        $errors = request()->session()->get('errors');
        $errorBag = $this->form->getErrorBag();

        if ($errors && $errors->hasBag($errorBag) && $errors->getBag($errorBag)->has($this->getName()))
            $this->inputClass .= ' ' . $this->getThemeStyle('input-danger');

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
