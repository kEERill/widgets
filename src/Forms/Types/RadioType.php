<?php

namespace Keerill\Widgets\Forms\Types;

class RadioType extends InputType
{
    /**
     * @var array Возможные варианты для кнопок
     */
    public $options = [];
    
    /**
     * @inheritdoc
     */
    protected $template = 'widgets::forms.fields.radio';

    /**
     * @inheritdoc
     */
    protected $defaultCssClass = 'uk-radio';

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
}