<?php namespace Keerill\Widgets\Forms\Types;

use Keerill\Widgets\Forms\Types\Helpers\Value;
use Keerill\Widgets\Forms\Types\Interfaces\Value as ValueInterface;


class HiddenType extends \App\Widgets\Forms\FormField implements ValueInterface
{
    use Value;

    /**
     * @var string $template Название шаблона для данного поля
     */
    protected $template = 'forms.fields.hidden';

    /**
     * @inheritdoc
     */
    public function boot()
    {
        $this->addConfigOptions([
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
