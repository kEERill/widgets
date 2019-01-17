<?php namespace Keerill\Widgets\Lists\Types;

use Keerill\Widgets\Lists\ListColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RelationType extends ListColumn
{
    /**
     * @var string Формат вывода даты
     */
    protected $select = 'id';

    /**
     * @inheritdoc
     */
    protected function initConfig() 
    {
        parent::initConfig();
        
        $this->fillConfig([
            'select'
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function getColumnValueByData(Model $record, array $data)
    {
        return $record->{$this->columnName}->{$this->select};
    }
    
    /**
     * @inheritdoc
     */
    public function extendQuery(Builder $query)
    {
        $query->with($this->columnName . ':id,'. $this->select);
    }
}
