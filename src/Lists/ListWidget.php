<?php namespace Keerill\Widgets\Lists;

use Keerill\Widgets\Widget;
use Keerill\Widgets\Traits\Theme;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Exceptions\ListException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListWidget extends Widget
{
    use Theme;

    /**
     * @var Collection $allColumns Коллекция столбцов
     */
    protected $allColumns = null;

    /**
     * @var LengthAwarePaginator $records Коллекция найденных моделей
     */
    protected $records = null;

    /**
     * @var integer $recordsToPage Количество записей на страницу
     */
    protected $recordsToPage = 15;

    /**
     * @var boolean $usePagination Показывает пагинацию
     */
    protected $usePagination = true;

    /**
     * @var string $tableClass Стили таблицы
     */
    protected $tableClass = null;

    /**
     * @var Model $modelClass Класс модели, которые будем выводить в таблице
     */
    protected $modelClass = null;

    /** 
     * @var string $template Название шаблона таблицы 
     */
    protected $template = 'lists.layouts.default';

    /**
     * @var string $defaultType Стандартное название типа колонки
     */
    protected $defaultType = 'default';

    /**
     * @var string $defaultSort Стандартная сортировка
     */
    protected $defaultSort = 'created_at desc';

    /**
     * @var string
     */
    protected $alias = 'listWidget';

    /**
     * @var string Название используемой темы, null - тема по умолчанию
     */
    protected $theme = null;

    /**
     * @var string
     */
    protected $state = null;

    /**
     * @inheritdoc
     */
    protected function boot(array $options)
    { 
        /**
         * Регистрация столбцов виджета
         */
        $this->registerListColumn();

        parent::boot($options);
    }

    /**
     * @inheritdoc
     */
    protected function initConfig()
    {
        $this->addConfigOptions([
                'recordsToPage', 'usePagination', 'defaultSort', 'tableClass'
            ]);
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->getTemplateName($this->template);
    }

    /**
     * Возвращает класс данного типа столбца
     *
     * @param string $columnType название типа столбца
     * @return string Класс столбца
     */
    public function getColumnTypeClass(string $columnType)
    {
        $availableColumnTypes = config('widgets.columnTypes', []);
        /**
         * Делаем проверку, что данный тип поля существует в системе
         */
        if (!in_array($columnType, array_keys($availableColumnTypes))) {
            throw new ListException(
                sprintf('Тип столбца [%s] не существует', $columnType)
            );
        }

        return $availableColumnTypes[$columnType];
    }

    /**
     * Возвращает стили для таблицы
     * @return array
     */
    public function getTableClass()
    {
        return $this->tableClass;
    }

   /**
     * @param string $tableClass
     * @return self
     */
    public function setTableClass(string $tableClass)
    {
        $this->tableClass = $tableClass;
        return $this;
    }

    /**
     * Возвращает колонки таблицы
     * @return Collection
     */
    public function getColumns()
    {
        return $this->allColumns;
    }

    /**
     * Возвращает коллекцию моделей
     *
     * @return LengthAwarePaginator
     */
    public function getRecords()
    {
        return $this->records;
    }

    /**
     * Добавляет столбец к данной талбице
     *
     * @param string $columnName Название столбца
     * @param string $columnType Тип столбца
     * @return ListColumn
     */
    public function add(string $columnName, ?string $columnType = null)
    {
        /**
         * Получаем класс поля по типу
         */
        $columnType = $columnType ?: $this->defaultType;
        $columnClass = $this->getColumnTypeClass($columnType);

        return $this->addColumn($columnName, new $columnClass ($this, $columnName, $columnType));
    }

    /**
     * Прикрепляет данное поле к данной талбице
     *
     * @param string $columnName Название столбца
     * @param ListColumn $column Экземпляр форстолбцамы
     * @return ListColumn
     */
    public function addColumn(string $columnName, ListColumn $column)
    {
        /**
         * Добавляем данный столбец в массив столбцов данной талбицы
         */
        if ($this->allColumns == null) {
            $this->allColumns = collect([]);
        }

        $this->allColumns->put($columnName, $column);

        return $column;
    }

    /**
     * Регистрация столбцов для таблицы
     * @return void
     */
    protected function registerListColumn() {}

    /**
     * Создание модели
     * @return Model
     */
    protected function createModel()
    {
        $className = $this->modelClass;
        return new $className ();
    }

    /**
     * @return mixed
     */
    protected function getQuery()
    {
        return $this->createModel()->newQuery();
    }

    /**
     * @inheritdoc
     */
    protected function prepareRender()
    {
        /**
         * Получение моделей для таблицы
         */
        $this->prepareModel();
    }

    /**
     * Выборка моделей из базы данных
     * @return void
     */
    protected function prepareModel()
    {
        /**
         * Создаем новый запрос
         */
        $query = $this->getQuery();

        /**
         * Делаем наследование столбцов, что бы столбца добавили в запрос, все что требуется
         */
        foreach ($this->allColumns as $columnName => $column) {
            $column->extendQuery($query);
        }

        /**
         * Вызываем событие для наследования запроса
         */
        $this->fireEvent('widget.list.extendQuery', [$this, $query]);

        $this->extendQuery($query);

        /**
         * Сортировка столбцов
         */
        if ($this->defaultSort != null) {
            list($orderColumn, $orderType) = explode(' ', $this->defaultSort);
            $query->orderBy($orderColumn, $orderType);
        }

        /**
         * Полученный результат сохраняем
         */
        $this->records = $this->usePagination ? 
            $query->paginate($this->recordsToPage) : 
            $query->simplePaginate($this->recordsToPage);
    }

    /**
     * Наследуем запрос
     *
     * @param $query
     * @return void
     */
    protected function extendQuery($query) {}

    /**
     * Здесь можно задавать кастомные стили для таблицы
     *
     * @param Model $record
     * @return void|string
     */
    public function extendRowClass(Model $record) {}
}
