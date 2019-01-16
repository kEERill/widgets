<?php namespace Keerill\Widgets\Forms\Types;

use Carbon\Carbon;

class TimeType extends InputType
{
    /**
     * @inheritdoc
     */
    protected $template = 'widgets::forms.fields.input';

    /**
     * @inheritdoc
     */
    public function getSaveValue($value)
    {
        $value = parent::getSaveValue($value);

        return !$value || $value == self::NOT_SAVE_DATA ? self::NOT_SAVE_DATA : Carbon::createFromTimeString($value);
    }
}