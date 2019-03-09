<?php namespace Keerill\Widgets\Forms\Types;

use Illuminate\Support\Collection;

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
     * Возвращает true если элемент key выбран
     * @param mixed $key
     * @return bool
     */
    public function isSelect($key)
    {
        if ($value = request()->old($this->getName(), $this->getValue())) {
            if (is_array($value))
                return in_array($key, $value);

            if ($value instanceof Collection)
                return $value->contains($key);

            return false;
        }

        return false;
    }
}
