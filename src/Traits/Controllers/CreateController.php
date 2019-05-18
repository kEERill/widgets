<?php namespace Keerill\Widgets\Traits\Controllers;

use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Forms\Context\CreateForm;
use Keerill\Widgets\Builder as WidgetBuilder;
use Keerill\Widgets\Exceptions\WidgetException;

trait CreateController
{
    /**
     * @var CreateForm Экземпляр формы создания
     */
    protected $createForm = null;

    /**
     * Возвращает название шаблона для страницы создания
     * @return string
     */
    public function getCreateView()
    {
        throw_if(!property_exists($this, 'createView'), WidgetException::class, 'Свойство [createView] с названием шаблона не найдено');
        return $this->createView;
    }

    /**
     * Возвращает название шаблона для страницы создания
     * @return string
     */
    public function getCreateFormClass()
    {
        throw_if(!property_exists($this, 'createFormClass'), WidgetException::class, 'Свойство [createFormClass] с названием с классом виджета не найдено');
        return $this->createFormClass;
    }

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
        $formWidget = $this->makeWidget($this->getCreateFormClass(), $formOptions);
        $this->extendFormCreateContext($formWidget);

        return $formWidget;
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
        return view($this->getCreateView(), [
            'formWidget' => $this->createForm
        ]);
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
