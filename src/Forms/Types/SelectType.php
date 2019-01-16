<?php namespace Keerill\Widgets\Forms\Types;

class SelectType extends InputType
{
    /**
     * @var array Варианты для селекта
     */
    public $options = [];

    /**
     * @inheritdoc
     */
    protected $template = 'widgets::forms.fields.select';

    /**
     * @inheritdoc
     */
    public function initConfig()
    {
        parent::initConfig();
        
        $this->fillConfig([
            'options'
        ]);
    }

    /**
     * Возвращает список возможных вариантов для выбора
     * @return array
     */
    public function getSelectOptions()
    {
        return $this->options;
    }

    /**
     * Задает параметры для выпадающего меню
     * @param array $options
     * @return $this
     */
    public function setSelectOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }
}
