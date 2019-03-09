<?php

namespace Keerill\Widgets\Forms\Types\Helpers;

trait Disabled
{
    /**
     * @var boolean Управляет состоянием поля
     */
    protected $disabled = false;

    /**
     * Проверка на то, что поле выключено
     * @return bool
     */
    public function getDisabled()
    {
        return (bool) $this->disabled;
    }

    /**
     * Отключает поле
     * @return InputType
     */
    public function setDisabled(bool $disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }
}
