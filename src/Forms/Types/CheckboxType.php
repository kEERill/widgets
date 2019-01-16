<?php namespace Keerill\Widgets\Forms\Types;

class CheckboxType extends InputType
{
    /**
     * @inheritdoc
     */
    protected $template = 'widgets::forms.fields.checkbox';

    /**
     * @inheritdoc
     */
    public function getSaveValue($value)
    {
        return (bool) $value;
    }
}
