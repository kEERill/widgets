<?php

namespace Keerill\Widgets\Forms\Types\Helpers;

/**
 * Validation
 */
trait Validation
{
    /**
     * Название полей для валидации
     * @return array
     */
    public function getValidationName()
    {
        return [];
    }

    /**
     * Сообщения об ошибках
     * @return array
     */
    public function getValidationMessages()
    {
        return [];
    }
}
