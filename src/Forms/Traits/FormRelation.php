<?php namespace Keerill\Widgets\Forms\Traits;

use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Traits\Controllers\Relation;

/**
 * Добавляет методы для работы с родительской моделью
 * @author kEERill
 */
trait FormRelation
{
    use Relation;

    /**
     * @inheritdoc
     */
    protected function extendFormModel($query)
    {
        parent::extendFormModel($query);

        $this->traitExtendModelFormParent($query);
    }

    /**
     * @inheritdoc
     */
    protected function extendBeforeFormModel(Model $formModel, array &$saveData)
    {
        $this->traitExtendBeforeFormModel($formModel, $saveData);
    }

    /**
     * @param $query
     */
    protected function traitExtendModelFormParent($query)
    {
        /**
         * Возвращает страницу 404, если родительская модель не найдена
         */
        abort_if(!$this->getParentModel(), 404);

        /**
         * Добавляем условие к запросу по 
         */
        $query->where($this->getParentColumn(), $this->parentModel->getKey());
    }

    /**
     * Добавляем ID родительской модели в основную модель
     * @param Model $formModel Основная модель
     * @param array $saveData Параметры сохранения
     * @return void
     */
    protected function traitExtendBeforeFormModel(Model $formModel, array &$saveData)
    {
        /**
         * Подключаем родительскую модель к форме
         */
        abort_if (!$this->getParentModel(), 404);

        /**
         * Наследуем созданную модель, т.е. создаём связь с родительской моделью
         */
        $formModel->{$this->getParentColumn()} = $this->parentModel->getKey();
    }
}
