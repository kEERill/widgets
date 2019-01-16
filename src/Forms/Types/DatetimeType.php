<?php namespace Keerill\Widgets\Forms\Types;

use Carbon\Carbon;

class DatetimeType extends InputType
{
    /**
     * @inheritdoc
     */
    protected $template = 'widgets::forms.fields.datetime';

    /**
     * @inheritdoc
     */
    public function getSaveValue($value)
    {
        $value = parent::getSaveValue($value);
        return !$value || $value == self::NOT_SAVE_DATA ? self::NOT_SAVE_DATA : Carbon::parse($value);
    }
}