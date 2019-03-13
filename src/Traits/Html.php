<?php

namespace Keerill\Widgets\Traits;

/**
 * Работа с HTML
 */
trait Html
{
    /**
     * Возвращает ID виджета в HTML
     * @param string $suffix
     * @return string
     */
    public function getId(string $suffix = null) 
    {
        $id = class_basename(get_called_class());

        if ($this->alias) 
            $id .= '-' . $this->alias;

        if ($suffix !== null)
            $id .= '-' . $suffix;

        return $id;
    }
}
