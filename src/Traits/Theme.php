<?php

namespace Keerill\Widgets\Traits;

/**
 * Управление темой
 */
trait Theme
{
    /**
     * Возвращает текущую тему
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Назначает новую тему
     * @param string $theme
     * @return self
     */
    public function setTheme(string $theme)
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string
     * @return self
     */
    public function setState(string $state)
    {
       $this->state = $state;
       return $this;
    }

    /**
     * Возвращает название шаблона в зависимости от темы
     * @param string $template
     * @return mixed
     */
    protected function getTemplateName(string $template)
    {
        $defaultTheme = config('widgets.theme');

        return $this->getTheme() ? "widgets::{$this->getTheme()}.{$template}" : "widgets::{$defaultTheme}.{$template}";
    }

    /**
     * Возвращает значение стилей в зависимости от темы
     * @param string $string Название стиля
     * @param string $default
     * @return string
     */
    protected function getThemeStyle(string $style, string $default = null)
    {
        $defaultTheme = config('widgets.theme');

        return $this->getTheme() ? 
            config("widgets.cssStyles.{$this->getTheme()}.{$style}", $default) :
            config("widgets.cssStyles.{$defaultTheme}.{$style}", $default);
    }
}
