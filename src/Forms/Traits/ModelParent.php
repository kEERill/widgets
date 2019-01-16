<?php namespace Keerill\Widgets\Forms\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Keerill\Widgets\Exceptions\FormModelException;

/**
 * Добавляет методы для работы с родительской моделью
 * @author kEERill
 */
trait ModelParent
{
    /**
     * @var Model Родительская модель
     */
    protected $parentModel = null;

    /**
     * Возвращает название столбца, в кторое будет вставлен ID родительском модели
     * @return string
     */
    protected function getParentColumn()
    {
        return 'parent_id';
    }

    /**
     * Возвращает класс родительской модели
     * @return string
     */
    protected function getParentClass()
    {
        return null;
    }

    /**
     * Возвращает экземпляр родительской модели
     * @return Model
     */
    public function getParentModel()
    {
        return $this->parentModel;
    }

    /**
     * Возвращает название полей с ID родительской модели
     * @return string
     */
    public function getParentFieldName()
    {
        return '_' . $this->getParentColumn();
    }

    /**
     * Подключает родительскую модель к форме используя родительскую модель
     * @param Model $parentModel
     * @return self
     */
    public function setParent(Model $parentModel)
    {
        $this->parentModel = $parentModel;
        return $this;
    }

    /**
     * Подключает родительскую модель к форме используя родительскую модель
     * @param Model $parentModel
     * @return void
     */
    protected function setParentModelOption(Model $parentModel)
    {
        $this->parentModel = $parentModel;
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

        $this->traitInitConfig();
    }

    /**
     * @inheritdoc
     * @throws FormModelException
     */
    protected function prepareRender()
    {
        parent::prepareRender();

        /**
         * Подключаем родительскую модель к форме
         */
        abort_if (!$this->getParentModel(), 404);

        $this->traitPrepareRender();
    }

    /**
     * @inheritdoc
     */
    protected function extendFormModel(Builder $query)
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
     * @param Builder $query
     */
    protected function traitExtendModelFormParent(Builder $query)
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

    /**
     * Подготовка к рендеру
     * @return void
     *
     * @throws FormModelException
     */
    protected function traitPrepareRender()
    {
        /**
         * Делаем проверку на то, что модель является родительской моделью
         */
        $parentClass = $this->getParentClass();

        if ($parentClass === null) {
            throw new FormModelException(
                    'Не задан класс родительской модели. Пожалуйста, добавьте метод с название `getParentClass`, который будет возвращает класс родительской модели'
                );
        }

        if (!$this->parentModel instanceof $parentClass) {
            throw new FormModelException(sprintf(
                    'Переданая модель %s не наследуется от %s', get_class($this->parentModel), $parentClass
                ));
        }
    }

    /**
     * Добавляет новые параметры к форме
     * @return void
     */
    protected function traitInitConfig()
    {
        $this->fillConfig([
            'parentModel'
        ]);
    }
}
