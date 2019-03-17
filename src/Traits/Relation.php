<?php namespace Keerill\Widgets\Traits\Controllers;

use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Exceptions\WidgetException;

/**
 * Добавляет методы для работы с родительской моделью
 * @author kEERill
 */
trait Relation
{
    /**
     * @var Model Родительская модель
     */
    protected $relationModel = null;

    /**
     * Возвращает название столбца, в кторое будет вставлен ID родительском модели
     * @return string
     */
    public function getRelationName()
    {
        throw_if(!property_exists($this, 'relationName'), WidgetException::class, 'Свойство [relationName] с названием связи не найдено');
        return $this->relationName;
    }

    /**
     * Возвращает класс родительской модели
     * @return string
     */
    public function getRelationModelClass()
    {
        throw_if(!property_exists($this, 'relationModelClass'), WidgetException::class, 'Свойство [relationModelClass] с классом родительской модели не найдено');
        return $this->relationModelClass;
    }

    /**
     * Возвращает экземпляр родительской модели
     * @return Model
     */
    public function getRelationModel()
    {
        return $this->parentModel;
    }

    /**
     * Подключает родительскую модель к форме используя родительскую модель
     * @param Model $parentModel
     * @return void
     */
    public function setParentModel(Model $parentModel)
    {
        $this->parentModel = $parentModel;
        return $this;
    }

    /**
     * Инициализация конфигурации формы. Данные метод предназначен для управления
     * конфигурации формы
     *
     * @return void
     */
    protected function initConfig()
    {
        parent::initConfig();

        $this->relationInitConfig();
    }

    /**
     * Добавляет новые параметры к форме
     * @return void
     */
    protected function relationInitConfig()
    {
        $this->addConfigOptions([
            'parentModel'
        ]);
    }
}
