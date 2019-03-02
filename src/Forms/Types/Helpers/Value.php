<?php namespace Keerill\Widgets\Forms\Types\Helpers;

use Illuminate\Support\Arr;


trait Value
{
    /**
     * @var string $value Значение поля
     */
    protected $value = null;

    /**
     * @var mixed
     */
    protected $default = null;

    /**
     * Название полей для валидации
     * @return array
     */
    public function getValidationName()
    {
        return [$this->getName() => $this->getName()];
    }

    /**
     * Возвращает стандартное значение поля
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Задает стандартное значение поля
     * @param string Значение поля
     * @return self
     */
    public function setDefault($value)
    {
        $this->default = $value;
        return $this;
    }

    /**
     * Возвращает новое значение поля, по полученным данным
     *
     * @param string|array $data
     * @param null $default
     * @return mixed
     */
    public function getValueByData($data)
    {
        /**
         * Преобразуем название поля в массив, например: 
         * Properties[fieldName] => ['properties', 'fieldname']
         */
        $keyParts = $this->getNameToArray();
        $lastField = end($keyParts);
        $result = $data;
        $default = $this->getDefault();
        
        /**
         * С помощью цикла, будем искать значения поля, т.к.
         * многомерность данных может быть много
         */
        foreach ($keyParts as $key) {

            /**
             * Если вдруг данные это модель, то делаем проверку на
             * существование связи
             */
            if ($result instanceof Model && $this->hasModelRelation($result, $key)) {
                if ($key == $lastField) {
                    $result = $result->getRelationValue($key) ? : $default;
                } else {
                    $result = $result->{$key};
                }
            }

            /**
             * Если вдруг данные переданы в виде массива, то получаем
             * значение с данным ключем, полученного из названия поля.
             */
            elseif (is_array($result)) {
                if (!array_key_exists($key, $result)) {
                    return $default;
                }
                $result = $result[$key];
            }

            /**
             * Но тут уже понятно, сюда будут относиться модель или какой то объект
             * Модель в данном случае просто не имеет связи с данным именем, поэтому получаем
             * атрибут модели
             */
            else {
                if (!isset($result->{$key})) {
                    return $default;
                }
                $result = $result->{$key};
            }
        }

        return $result;
    }

    /**
     * Возвращает значение поля, для сохранения в модели и т.д. и т.п.
     * @return array
     */
    public function getSaveValue()
    {
        return $this->getValue();
    }

    /**
     * Добавляет, к массиву с данными для сохранения, своим значения поля
     * @param array
     * @return array
     */
    public function getSaveData($data)
    {
        Arr::set($data, $this->getName(), $this->getSaveValue());
        return $data;
    }

    /**
     * Возвращает значение поля для формы, в любом случае
     * @return mixed
     */
    public function getDataValue($data)
    {
        Arr::set($data, $this->getName(), $this->getValue());
        return $data;
    }

    /**
     * Возвращает занчение поля для формы, в любом случае
     * @return mixed
     */
    public function setDataValue($data) 
    {
        $this->setValue($this->getValueByData($data));
    }

    /**
     * Возвращает значение поля, если значение отсутствует, то возвращает
     * стандартное значение
     * @return string
     */
    public function getValue()
    {
        return $this->value ?: $this->getDefault();
    }

    /**
     * Задает значение поля
     * @param string Значение поля
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Проверяет модель на наличие связи с именем $relationName
     * @param Model $model
     * @param string $relationName Название связи
     * @return boolean
     */
    public function hasModelRelation(Model $model, string $relationName)
    {

        if ($model->relationLoaded($relationName)) {
            return true;
        }

        if (method_exists($model, $relationName) && $model->$relationName() instanceof Relation) {
            return true;
        }

        return false;
    }
}