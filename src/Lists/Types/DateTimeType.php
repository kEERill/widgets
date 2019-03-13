<?php namespace Keerill\Widgets\Lists\Types;

use Carbon\Carbon;
use Keerill\Widgets\Lists\ListColumn;
use Illuminate\Database\Eloquent\Model;

class DateTimeType extends ListColumn
{
    /**
     * @var string Формат вывода даты
     */
    protected $format = '%d %h %G, %R';

    /**
     * @inheritdoc
     */
    protected function initConfig() 
    {
        parent::initConfig();
        
        $this->addConfigOptions([
            'format'
        ]);
    }

    /**
     * Возвращает формат дат в данном столбце
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Задает новый формат столбцу
     * @param string $format
     * @return self
     */
    public function setFormat(string $format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function getColumnValueByData(Model $record, array $data)
    {
        return Carbon::parse(parent::getColumnValueByData($record, $data))->formatLocalized($this->getFormat());
    }
}
