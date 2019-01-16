<?php namespace Keerill\Widgets\Forms\Traits\Controllers;

use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Forms\Context\CreateForm;
use Keerill\Widgets\Builder as WidgetBuilder;

trait CreateController
{
    /**
     * @var CreateForm Экземпляр формы создания
     */
    protected $createForm = null;

    /**
     * Возвращает ссылку для перенаправления после успешного создания
     * @param Model $model Созданая модель
     * @return mixed
     */
    protected function getCreateRedirect(Model $model)
    {
        return redirect()->back();
    }

    /**
     * Создание новой формы
     *
     * @param WidgetBuilder
     * @return CreateForm
     */
    public function makeFormCreate()
    {
        /**
         * Получаем параметры для формы и сразу же наследуем
         */
        $formOptions = $this->extendFormOptionsCreate([]);

        /**
         * Создаем новый экземпляр формы и присваиваем форму к свойству createForm
         */
        $formWidget = $this->makeWidget($this->createFormClass, $formOptions);
        $this->extendFormCreateContext($formWidget);

        return $formWidget;
    }

    /**
     * Выводит страницу создания с формой
     * @param WidgetBuilder
     * @return mixed
     */
    public function create()
    {
        return $this->formCreate();
    }

    /**
     * Осуществляет создание формы и вывод её на экран
     * @param WidgetBuilder
     * @return mixed
     */
    public function formCreate()
    {
        $this->createForm = $this->makeFormCreate();

        /**
         * Вот тут и происходит рендер
         */
        return view($this->createView, [
            'formWidget' => $this->createForm
        ]);
    }

    /**
     * Обработывает запрос на создание модели
     *
     * @param WidgetBuilder
     * @return mixed
     *
     * @throws \Exception
     */
    public function store()
    {
        return $this->formStore();
    }

    /**
     * Создаёт новую модель, т.е. выполняем операцию создания новой модели
     *
     * @param WidgetBuilder
     * @return mixed
     *
     * @throws \Exception
     */
    public function formStore()
    {
        return $this->getCreateRedirect($this->makeFormCreate()->handleCreate());
    }

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
}
