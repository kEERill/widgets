<?php namespace Keerill\Widgets\Forms\Context;

use Keerill\Widgets\Forms\FormWidget;
use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Forms\Traits\ModelSaver;

class CreateForm extends FormWidget
{
    use ModelSaver;

    /**
     * @inheritdoc
     */
    public $method = 'POST';

    /**
     * Осуществляет логику создания новой модели
     * @return Model
     * @throws \Exception
     */
    public function handleCreate()
    {
        /**
         * Валидация полей
         */
        $this->validated();

        /**
         * Создаём новую модель
         */
        $formModel = $this->createModel();
        $saveData = $this->getSaveData();

        /**
         * Наследуем модель
         */
        $this->extendBeforeFormModel($formModel, $saveData);
        $this->fireEvent('widget.form.beforeCreate', [$this, $formModel, $saveData]);

        /**
         * Заполняем модель данными полученными в форме
         */
        $formModel = $this->setModelAttributes($formModel, $saveData);

        /**
         * Сохраняем
         */
        $formModel->save();

        /**
         * Наследуем модель
         */
        $this->extendAfterFormModel($formModel);
        $this->fireEvent('widget.form.afterCreate', [$this, $formModel]);

        return $formModel;
    }

    /**
     * Наследуем создаваемую модель, чтобы при создании модели уже была связь с родительской моделью
     *
     * @param Model $model
     * @param array $saveData
     * @return void
     */
    protected function extendBeforeFormModel(Model $model, array &$saveData) {}

    /**
     * Наследуем уже созданую модель
     * @param Model $model
     * @return void
     */
    protected function extendAfterFormModel(Model $model) {} 
}
