<?php namespace Keerill\Widgets\Forms\Types;

class MultiSelectType extends SelectType
{
    /**
     * @var integer Максимальное число элементов, которые можно выбрать
     */
    public $maxSelect = 10;

    /**
     * @inheritdoc
     */
    protected $template = 'forms.fields.multiselect';

    /**
     * @inheritdoc
     */
    public function initConfig()
    {
        parent::initConfig();
        
        $this->addConfigOptions([
            'maxSelect'
        ]);
    }

    /**
     * Возвращает атрибуты для input
     * @return array
     */
    public function getInputAttributes()
    {
        $baseClasses = parent::getInputAttributes();
        $baseClasses[] = 'multiple';

        return $baseClasses;
    }

    /**
     * Возвращает true если элемент key выбран
     * @param mixed $key
     * @return bool
     */
    public function isSelect($key)
    {
        if (is_array($value = request()->old($this->getName(), $this->getValue())))
            return in_array($key, $value);

        return false;
    }
}
