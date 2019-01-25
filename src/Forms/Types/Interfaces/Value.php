<?php namespace Keerill\Widgets\Forms\Types\Interfaces;

interface Value 
{
    public function getValue();
    public function setValue($value);

    public function getDefault();
    public function setDefault($default);

    public function getDataValue($data);
    public function setDataValue($data);

    public function getValueByData($data);

    public function getSaveValue();
    public function getSaveData($data);

    public function getValidationName();
}