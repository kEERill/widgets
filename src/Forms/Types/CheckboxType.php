<?php namespace Keerill\Widgets\Forms\Types;

class CheckboxType extends InputType
{
    /**
     * @inheritdoc
     */
    protected $template = 'forms.fields.checkbox';

    /**
     * @var string $template Название шаблона для данного поля
     */
    protected $templateField = 'forms.empty';
}
