<?php

namespace Keerill\Widgets\Forms\Types;

class RadioType extends InputType
{
    /**
     * @var array Возможные варианты для кнопок
     */
    protected $selectOptions = [];
    
    /**
     * @inheritdoc
     */
    protected $template = 'widgets::forms.fields.radio';

    /**
     * @inheritdoc
     */
    public function initConfig()
    {
        parent::initConfig();
        
        $this->addConfigOptionsWithMethods([
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
     * Изменяет доступные варианты выбора для поля
     * @param array
     * @return self
     */
    public function setSelectOptions(array $options)
    {
        $this->selectOptions = $options;
        return $this;
    }
}