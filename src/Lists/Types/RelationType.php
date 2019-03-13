<?php namespace Keerill\Widgets\Lists\Types;

use Keerill\Widgets\Lists\ListColumn;
use Illuminate\Database\Eloquent\Model;

class RelationType extends ListColumn
{
    /**
     * @var string Столбец, который требуется взять из бд
     */
    protected $select = 'id';

    /**
     * @inheritdoc
     */
    protected function initConfig() 
    {
        parent::initConfig();
        
        $this->addConfigOptions([
            'select'
        ]);
    }

    /**
     * Возвращает столбец, который требуется взять из бд
     * @return string
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * Задает параметр select
     * @param string
     * @return sef
     */
    public function setSelect(string $select)
    {
        $this->select = $select;
        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function getColumnValueByData(Model $record, array $data)
    {
        return $record->{$this->getColumnName()}->{$this->getSelect()};
    }
    
    /**
     * @inheritdoc
     */
    public function extendQuery($query)
    {
        $query->with($this->getColumnName() . ':id,'. $this->getSelect());
    }
}
