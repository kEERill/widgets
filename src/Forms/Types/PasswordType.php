<?php namespace Keerill\Widgets\Forms\Types;

      use Illuminate\Support\Facades\Hash;


class PasswordType extends InputType
{
    /**
     * @inheritdoc
     */
    protected $template = 'widgets::forms.fields.password';

    /**
     * @inheritdoc
     */
    public function getDefault()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function setValue($value)
    {
        $this->value = $value ? Hash::make($value) : null;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSaveValue()
    {
        return $this->getValue() ?: self::NOT_SAVE_DATA;
    }
}
