<?php

namespace Keerill\Widgets\Forms\Types;

class RadioType extends InputType
{
    /**
     * @var array Возможные варианты для кнопок
     */
    protected $radioOptions = [];
    
    /**
     * @inheritdoc
     */
    protected $template = 'forms.fields.radio';

    /**
     * @var string $template Название шаблона для данного поля
     */
    protected $templateField = 'forms.field';

    /**
     * @inheritdoc
     */
    public function initConfig()
    {
        parent::initConfig();
        
        $this->addConfigOptionsWithMethods([
            'radioOptions'
        ]);
    }

    /**
     * Возвращает список возможных вариантов для выбора
     * @return array
     */
    public function getRadioOptions()
    {
        return $this->radioOptions;
    }


    /**
     * Изменяет доступные варианты выбора для поля
     * @param array
     * @return self
     */
    public function setRadioOptions(array $options)
    {
        $this->radioOptions = $options;
        return $this;
    }
}