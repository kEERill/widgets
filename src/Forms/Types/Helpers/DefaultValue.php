<?php

namespace Keerill\Widgets\Forms\Types\Helpers;

/**
 * Добавляет значение поля по умолчанию
 */
trait DefaultValue
{
    /**
     * @var mixed Стандартное значение поля
     */
    protected $default = null;

    /**
     * Возвращает стандартное значение поля
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Задает стандартное значение поля
     * @param string Значение поля
     * @return self
     */
    public function setDefault($value)
    {
        $this->default = $value;
        return $this;
    }
}
