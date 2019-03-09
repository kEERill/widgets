<?php namespace Keerill\Widgets\Forms\Types;

use Carbon\Carbon;

class TimeType extends InputType
{
    /**
     * @inheritdoc
     */
    protected $template = 'forms.fields.input';

    /**
     * @inheritdoc
     */
    public function setValue($value)
    {
        $this->value = Carbon::createFromTimeString($value);
        return $this;
    }
}