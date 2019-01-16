<?php namespace Keerill\Widgets\Forms\Context;

use Keerill\Widgets\Forms\FormWidget;
use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Forms\Traits\ModelSaver;
use Keerill\Widgets\Exceptions\FormModelException;

class UpdateForm extends FormWidget
{
    use ModelSaver;
    
    /**
     * @inheritdoc
     */
    public $method = 'PUT';

    /**
     * Осуществляет логику обновления модели
     *
     * @param int $modelId ID модели
     * @return Model
     *
     * @throws \Exception
     */
    public function handleUpdate(int $modelId = null)
    {
        /**
         * Проверяем, на то что был передан ID модели которую надо обновить
         */
        if ($modelId) {
            $this->setModelId($modelId);
        }
    
        /**
         * Создаём новую модель
         */
        $formModel = $this->getModel();
        $saveData = $this->getSaveData();

        /**
         * Валидация полей
         */
        $this->validated();

        /**
         * Наследуем модель
         */
        $this->extendBeforeFormModel($formModel, $saveData);
        $this->fireEvent('widget.form.beforeUpdate', [$this, $formModel, $saveData]);

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
        $this->fireEvent('widget.form.afterUpdate', [$this, $formModel]);

        return $formModel;
    }

    /**
     * @inheritdoc
     * @throws FormModelException
     */
    protected function prepareRender()
    {
        /**
         * Проверяем, что модель была подключена к форме
         */
        if (!$this->getModel() instanceof $this->modelClass) {
            throw new FormModelException(sprintf(
                'Модель не подключена к форме или подключена другая модель [Допустимая модель %s]', $this->modelClass
            ));
        }
    }

    /**
     * Наследуем создаваемую модель, чтобы при создании модели уже была связь с родительской моделью
     *
     * @param Model $formModel
     * @param array $saveData
     * @return void
     */
    protected function extendBeforeFormModel(Model $formModel, array &$saveData) {}

    /**
     * Наследуем уже созданую модель
     * @param Model $formModel
     * @return void
     */
    protected function extendAfterFormModel(Model $formModel) {} 
}
