<?php namespace Keerill\Widgets\Lists\Traits\Controllers;

use Keerill\Widgets\Lists\ListWidget;
use Illuminate\Database\Eloquent\Builder;

trait ListController
{
    /**
     * @var ListWidget Виджет
     */
    protected $listWidget = null;

    /**
     * Возвращает параметры для виджета листа
     * @return array
     */
    protected function getListOptions()
    {
        return [];
    }

    /**
     * Страница с таблицей
     * @return mixed
     */
    public function index()
    {
        return $this->listIndex();
    }

    /**
     * Создает ListWidget
     * @return mixed
     */
    protected function makeListWidget()
    {
        /**
         * Получаем параметры для виджета
         */
        $listOptions = $this->extendListOptions([]);

        /**
         * Создаем таблицу
         */
        $listWidget = $this->makeWidget($this->listClass, $listOptions);
        $this->extendListCreate($listWidget);

        /**
         * Вызывается, когда происходит выборка моделей из базы
         */
        $listWidget->bindEvent('widget.list.extendQuery', function (ListWidget $widget, $query) {
            $this->extendListQuery($widget, $query);
        });

        return $listWidget;
    }

    /**
     * Возвращает view с переданной переменной listWidget
     * @return mixed
     */
    protected function listIndex()
    {
        return view($this->listView)->with('listWidget', $this->listWidget = $this->makeListWidget());
    }

    /**
     * Вызывается перед созданием виджета для получения параметров
     * @param array $options
     * @return array
     */
    protected function extendListOptions(array $options = []) 
    {
        return $options;
    }

    /**
     * Вызывается когда был создан ListWidget
     * @param ListWidget $listWidget
     */
    protected function extendListCreate(ListWidget $listWidget) {}

    /**
     * Вызывается, когда происходит выборка моделей из базы
     * @param ListWidget $listWidget
     * @param Builder $query
     */
    protected function extendListQuery(ListWidget $listWidget, Builder $query) {}
}
