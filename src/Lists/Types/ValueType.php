<?php namespace Keerill\Widgets\Lists\Types;

use Keerill\Widgets\Lists\ListColumn;
use Illuminate\Database\Eloquent\Model;

class ValueType extends ListColumn
{
    /**
     * @var Closure Функция, которая возвращает значение столбца
     */
    protected $callback = null;

    /**
     * @param Closure
     * @return self
     */
    public function value(\Closure $callback)
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getColumnValue(Model $record)
    {
        return $this->callback !== null ? call_user_func($this->callback, $record) : null;
    }
}
