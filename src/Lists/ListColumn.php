<?php namespace Keerill\Widgets\Lists;

use Keerill\Widgets\Traits\Events;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Keerill\Widgets\Traits\UsableOptions;

class ListColumn
{
    use UsableOptions, Events;

    /**
     * @var string Название столбца
     */
    protected $columnName = null;

    /**
     * @var string Заголовок столбца
     */
    protected $title = null;

    /**
     * @var string Значение по умолчанию
     */
    protected $default = null;

    /**
     * @var integer|null Ширина столбца
     */
    protected $width = null;

    /**
     * @var integer|null Стили для данного столбца
     */
    protected $cssClass = null;

    /**
     * @var string Тип столбца
     */
    protected $columnType = null;

    /**
     * @var ListWidget Виджет, которому принадлежит данная колонка
     */
    protected $listWidget = null;

    /**
     * Создание нового экземпляра
     * @param ListWidget $listWidget
     * @param string $columnName
     * @param string $columnType
     */
    public function __construct(ListWidget $listWidget, string $columnName, string $columnType)
    {
        $this->listWidget = $listWidget;
        $this->columnName = $columnName;
        $this->columnType = $columnType;

        $this->init();
    }

    /**
     * Инициализация столбца
     * @return void
     */
    protected function init()
    {
        /**
         * Инициализация конфигурации столбца
         */
        $this->initConfig();

        /**
         * После того, как все подготовки столбца выполнены начинаем инициализацию остальных компонентов
         * столбца
         */
        $this->boot();
    }

    /**
     * Инициализация конфигурации столбца. Данные метод предназначен для управления
     * конфигурации столбца
     * @return void
     */
    protected function initConfig() 
    {
        $this->addConfigOptionsWithMethods([
            'title', 'default', 'cssClass', 'width'
        ]);
    }

    /**
     * Вызывается после инициализации основных элементов столбца
     * @return void
     */
    protected function boot() {}

    /**
     * Возвращает тип столбца
     * @return string
     */
    public function getColumnType()
    {
        return $this->columnType;
    }

    /**
     * Возвращает ширину столбца
     * @return int|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Задает новую ширину столбца
     * @param int
     * @return self
     */
    public function setWidth(int $width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Возвращает стандартное значение столбца
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Задает новое стандартное значение столбца
     * @param string
     * @return self
     */
    public function setDefault(string $default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * Возвращает заголовок столбца
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Присваивает новый заголовок столбцу
     * @param string
     * @return self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Возвращает класс для столбца
     * @return string
     */
    public function getCssClass()
    {
        return $this->cssClass;
    }

    /**
     * Задает класс для столбца
     * @param string
     * @return self
     */
    public function setCssClass(string $cssClass)
    {
        $this->cssClass = $cssClass;
        return $this;
    }

    /**
     * Возвращает виджет таблицы
     * @return string
     */
    public function getListWidget()
    {
        return $this->listWidget;
    }

    /**
     * Возвращает исходное название столбца
     * @return string
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * Возвращает название столбца в виде массива:
     * column.value => ['column', 'value']
     * @return array
     */
    public function getColumnNameArray()
    {
        return explode('.', $this->getColumnName());
    }

    /**
     * Возвращает значение столбца
     * @param Model $record
     * @return string
     */
    public function getColumnValue(Model $record)
    {
        return $this->getColumnValueByData($record, $this->getColumnNameArray()) ?: $this->getDefault();
    }

    /**
     * Возвращает значение столбца
     * @param Model $record
     * @param array $data
     * @return string
     */
    protected function getColumnValueByData(Model $record, array $data)
    {
        $result = $record;

        foreach ($data as $attribute) {
            if (isset($result->{$attribute})) {
                $result = $result->{$attribute};
            }
        }

        return $result;
    }

    /**
     * Вызвается когда происходит создания запроса к базе
     * @param Builder $query
     * @return void
     */
    public function extendQuery(Builder $query) {}
}
