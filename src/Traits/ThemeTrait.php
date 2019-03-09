<?php

namespace Keerill\Widgets\Traits;

/**
 * Управление темой
 */
trait ThemeTrait
{
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
     * Возвращает текущую тему
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
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
     * @return string
     */
    public function setState(string $state)
    {
        return $this->state = $state;
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
