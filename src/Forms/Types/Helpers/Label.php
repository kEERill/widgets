<?php namespace Keerill\Widgets\Forms\Types\Helpers;

use Illuminate\Support\Arr;

trait Label {
    /**
     * @var string Классы для заголовка поля
     */
    protected $labelClass = null;

    /**
     * @var string Текст заголовка
     */
    protected $label = null;

    /**
     * Возвращает текст заголовка
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Задает новый заголовок поля
     * @param string
     * @return self
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Возвращает классы заголовка
     * @return string
     */
    public function getLabelClass()
    {
        return $this->labelClass;
    }

    /**
     * Изменяет классы для заголовка
     * @param string
     * @return self
     */
    public function setLabelClass(string $labelClass)
    {
        $this->labelClass = $labelClass;
        return $this;
    }
}