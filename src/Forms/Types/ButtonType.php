<?php namespace Keerill\Widgets\Forms\Types;

class ButtonType extends \Keerill\Widgets\Forms\FormField
{
    /**
     * @var string Текст кнопки
     */
    protected $text = null;

    /**
     * @var string Классы для кнопки
     */
    protected $cssClasses = null;

    /**
     * @inheritdoc
     */
    protected $template = 'widgets::forms.fields.button';

    /**
     * Изменяет текст кнопки
     * @param string
     * @return self
     */
    public function setText(string $text) 
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Возвращает текст кнопки
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Изменяет css классы кнопки
     */
    public function setCssClasses(string $cssClasses)
    {
        $this->cssClasses = $cssClasses;
        return $this;
    }

    /**
     * Возвращает стили для кнопки
     * @return string
     */
    public function getCssClasses()
    {
        return $this->cssClasses;
    }

    /**
     * Возвращает атрибуты для кнопки
     * @return array
     */
    public function getButtonAttributes()
    {
        $cssClasses = config('widgets.customAttributes.button.input', []);

        if ($this->getCssClasses() !== null) {
            $cssClasses['class'][] = $this->getCssClasses();
        }

        return $cssClasses;
    }

    /**
     * @inheritdoc
     */
    public function initConfig()
    {
        parent::initConfig();

        $this->addConfigOptionsWithMethods([
            'text', 'cssClasses'
        ]);
    }
}
