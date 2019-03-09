<?php namespace Keerill\Widgets\Forms\Types;

use Carbon\Carbon;

class DatetimeType extends InputType
{
    /**
     * @inheritdoc
     */
    protected $template = 'forms.fields.datetime';

    /**
     * @inheritdoc
     */
    public function setValue($value)
    {
        if ($value instanceof Carbon) {
            $this->value = $value;
            return $this;
        }

        $this->value = Carbon::parse($value);
        return $this;
    }
}