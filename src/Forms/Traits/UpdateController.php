<?php namespace Keerill\Widgets\Forms\Traits;

use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Forms\Context\UpdateForm;

/**
 * Трейт для управления формы редактирования модели
 * 
 * Для полноой работы в основной класс требуется добавить следующие свойства:
 *  - updateView (Отображаемая страница, в которую будет передана переменная form)
 *  - updateFormClass (Класс формы)
 */
trait UpdateController
{

    /**
     * @var UpdateForm Экземпляр формы редактирования
     */
    protected $updateForm = null;

    /**
     * Возвращает ссылку для перенаправления после успешного сохранения
     *
     * @param Model $model Редактируемая модель
     * @return mixed
     */
    public function getUpdateRedirect(Model $model)
    {
        return redirect()->back();
    }

    /**
     * Создание новой формы
     *
     * @param int $modelId ID редактируемой модели
     * @return UpdateForm
     */
    public function makeFormUpdate(int $modelId)
    {
        /**
         * Получаем параметры для формы и сразу же наследуем
         */
        $formOptions = $this->extendFormOptionsUpdate([]);

        /**
         * Создаем форму
         */
        $formWidget = $this->makeWidget($this->updateFormClass, $formOptions)->setModelId($modelId);
        $this->extendFormUpdateContext($formWidget);

        return $formWidget;
    }

    /**
     * Выводит страницу редактирование модели
     *
     * @param int $modelId
     * @return mixed
     */
    public function edit(int $modelId)
    {
        return $this->formEdit($modelId);
    }

    /**
     * Выполняет логику обновления, т.е. вывод формы
     *
     * @param integer $modelId ID редактируемой модели
     * @return mixed
     */
    public function formEdit(int $modelId)
    {
        /**
         * Создаем новый экземпляр формы и присваиваем форму к свойству updateForm
         */
        $this->updateForm = $this->makeFormUpdate($modelId);

        /**
         * Вот тут и происходит рендер
         */
        return view($this->updateView, [
            'formWidget' => $this->updateForm,
            'formModel' => $this->updateForm->getModel()
        ]);
    }

    /**
     * Выполняет обновление
     *
     * @param int $modelId
     * @return mixed
     *
     * @throws \Exception
     */
    public function update(int $modelId)
    {
        return $this->formUpdate($modelId);
    }

    /**
     * Выполняет сохранение модели
     *
     * @param integer $modelId ID Модели
     * @return mixed
     *
     * @throws \Exception
     */
    public function formUpdate(int $modelId)
    {
        return $this->getUpdateRedirect($this->makeFormUpdate($modelId)->handleUpdate());
    }

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
}
