<?php

namespace Keerill\Widgets\Forms\Types\Helpers;

trait Placeholder
{
    /**
     * @var string Заглушка для пустого поля
     */
    protected $placeholder = null;

    /**
     * Возвращает placeholder поля
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Задает placeholder для поля
     * @param string $placeholder
     * @return InputType
     */
    public function setPlaceholder(string $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }
}
