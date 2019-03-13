<?php

namespace Keerill\Widgets\Controllers;

use App\Http\Controllers\Controller;
use Keerill\Widgets\Lists\ListWidget;
use Keerill\Widgets\Forms\Context\CreateForm;
use Keerill\Widgets\Forms\Context\UpdateForm;
use Keerill\Widgets\Traits\Controllers\ {
    WidgetController, CreateController, UpdateController, ListController
};

class FormController extends Controller
{
    use WidgetController, CreateController, UpdateController, ListController;

    /**
     * @var string Название шаблона для страницы создания
     */
    protected $createView = 'create';

    /**
     * @var string Класс виджета для страницы создания
     */
    protected $createFormClass = \Keerill\Widgets\Forms\Context\CreateForm::class;

    /**
     * @var string Назание шаблона для страницы редактирования
     */
    protected $updateView = 'update';

    /**
     * @var string Класс виджета для страницы редактирования
     */
    protected $updateFormClass = \Keerill\Widgets\Forms\Context\UpdateForm::class;

    /**
     * @var string Название шаблона для страницы просмотра моделей
     */
    protected $listView = 'index';

    /**
     * @var string Класс виджета ListWidget для страницы просмотра моделей
     */
    protected $listClass = \Keerill\Widgets\Lists\ListWidget::class;

    /**
     * Наследуем параметры формы создания
     * @param array
     * @return array
     */
    protected function extendFormOptionsCreate(array $formOptions) 
    {
        return $formOptions;
    }

    /**
     * Наследуем форму после создания формы
     *
     * @param CreateForm $formWidget
     * @return void
     */
    protected function extendFormCreateContext(CreateForm $formWidget) {}
        
    /**
     * Наследуем параметры формы создания
     *
     * @param array $formOptions
     * @return array
     */
    protected function extendFormOptionsUpdate(array $formOptions) 
    {
        return $formOptions;
    }

    /**
     * Наследуем форму после создания формы
     *
     * @param UpdateForm $formWidget
     * @return void
     */
    protected function extendFormUpdateContext(UpdateForm $formWidget) {}

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
