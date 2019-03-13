<?php namespace Keerill\Widgets\Traits\Controllers;

use Keerill\Widgets\Lists\ListWidget;
use Keerill\Widgets\Exceptions\WidgetException;

trait ListController
{
    /**
     * @var ListWidget Виджет
     */
    protected $listWidget = null;

    /**
     * Возвращает название шаблона для страницы создания
     * @return string
     */
    public function getListView()
    {
        throw_if(!property_exists($this, 'listView'), WidgetException::class, 'Свойство [listView] с названием шаблона не найдено');
        return $this->listView;
    }

    /**
     * Возвращает название шаблона для страницы создания
     * @return string
     */
    public function getListClass()
    {
        throw_if(!property_exists($this, 'listClass'), WidgetException::class, 'Свойство [listClass] с названием с классом виджета не найдено');
        return $this->listClass;
    }

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
        $listWidget = $this->makeWidget($this->getListClass(), $listOptions);
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
        return view($this->getListView())->with('listWidget', $this->listWidget = $this->makeListWidget());
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
     * @param $query
     */
    protected function extendListQuery(ListWidget $listWidget, $query) {}
}
