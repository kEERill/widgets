<?php 

namespace Keerill\Widgets\Forms\Types\Interfaces;

interface Validation 
{
    /**
     * Название поля или полей
     * @return array
     */
    public function getValidationName();

    /**
     * Измененные сообщения валидации
     * @return array
     */
    public function getValidationMessages();
}