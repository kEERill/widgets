<?php namespace Keerill\Widgets\Forms\Types;

class SelectType extends InputType
{
    /**
     * @var array Варианты для селекта
     */
    public $selectOptions = [];

    /**
     * @inheritdoc
     */
    protected $template = 'forms.fields.select';

    /**
     * @inheritdoc
     */
    public function initConfig()
    {
        parent::initConfig();
        
        $this->addConfigOptions([
            'selectOptions'
        ]);
    }

    /**
     * Возвращает список возможных вариантов для выбора
     * @return array
     */
    public function getSelectOptions()
    {
        return $this->selectOptions;
    }

    /**
     * Задает параметры для выпадающего меню
     * @param array $options
     * @return $this
     */
    public function setSelectOptions(array $options)
    {
        $this->selectOptions = $options;
        return $this;
    }

    /**
     * Возвращает true если элемент key выбран
     * @param mixed $key
     * @return bool
     */
    public function isSelect($key)
    {
        return $key == request()->old($this->getName(), $this->getValue());
    }
}
