<?php namespace Keerill\Widgets\Forms\Types;

class HiddenType extends \Keerill\Widgets\Forms\FormField
{
    /**
     * @var string $template Название шаблона для данного поля
     */
    protected $template = 'widgets::forms.fields.hidden';

    /**
     * @inheritdoc
     */
    public function boot()
    {
        $this->fillConfig([
            'value'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getSaveValue($value)
    {
        return self::NOT_SAVE_DATA;
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }
}
