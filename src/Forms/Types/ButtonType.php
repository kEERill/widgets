<?php namespace Keerill\Widgets\Forms\Types;

use Keerill\Widgets\Forms\Types\Helpers\Disabled;

class ButtonType extends \App\Widgets\Forms\FormField
{
    use Disabled;

    /**
     * @var string Текст кнопки
     */
    protected $text = null;

    /**
     * @var string Классы для кнопки
     */
    protected $buttonClass = null;

    /**
     * @inheritdoc
     */
    protected $template = 'forms.fields.button';

    /**
     * @var string $template Название шаблона для данного поля
     */
    protected $templateField = 'forms.empty';


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
     * @param string
     */
    public function setButtonClass(string $buttonClass)
    {
        $this->buttonClass = $buttonClass;
        return $this;
    }

    /**
     * Возвращает стили для кнопки
     * @return string
     */
    public function getButtonClass()
    {
        return $this->buttonClass;
    }

    /**
     * @inheritdoc
     */
    public function initConfig()
    {
        parent::initConfig();

        $this->addConfigOptions([
            'text', 'buttonClass', 'disabled'
        ]);
    }
}
