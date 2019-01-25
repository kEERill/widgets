<?php namespace Keerill\Widgets\Forms\Types;

use Keerill\Widgets\Forms\Types\Helpers\Value;
use Keerill\Widgets\Forms\Types\Interfaces\Value as ValueInterface;


class HiddenType extends \Keerill\Widgets\Forms\FormField implements ValueInterface
{
    use Value;

    /**
     * @var string $template Название шаблона для данного поля
     */
    protected $template = 'widgets::forms.fields.hidden';

    /**
     * @inheritdoc
     */
    public function boot()
    {
        $this->addConfigOptionsWithMethods([
            'value', 'default'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getSaveValue()
    {
        return self::NOT_SAVE_DATA;
    }
}
