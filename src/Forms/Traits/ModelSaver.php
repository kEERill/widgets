<?php namespace Keerill\Widgets\Forms\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

trait ModelSaver
{
    /**
     * Обновляет атрибуты модели, а так же дополнительные поля
     *
     * @param Model $model Модель для обновления.
     * @param array $saveData Данные для обновления.
     * @return Model
     *
     * @throws \Exception
     */
    protected function setModelAttributes(Model $model, array $saveData)
    {
        if (!is_array($saveData)) {
            return $model;
        }

        foreach ($saveData as $attribute => $value) {
            if (method_exists($model, $attribute) &&
                $model->{$attribute}() instanceof Relation) {
                /**
                 * Обновляем связь
                 */
                $this->setModelRelation($model, $attribute, $value);
            } else {
                /**
                 * Обновляем атрибут
                 */
                $model->{$attribute} = $value;
            }
        }

        return $model;
    }

    /**
     * Обновляет текущую связь модели
     *
     * @param Model $model Модель для записи
     * @param string $relation Название связи
     * @param mixed $value Значение для для записи
     * @return void
     *
     * @throws \Exception
     */
    private function setModelRelation(Model $model, string $relation, $value)
    {
        /**
         * Получаем тип связи, это очень важно. Дальше будем определять какие методы
         * использовать для обновления
         */
        $relationType = class_basename($model->{$relation}());

        /**
         * Вот тут мы и определим какой метод использовать
         */
        switch ($relationType) {
            case "BelongsTo":
                $model->{$relation}()->associate(intval($value));
                break;

            /**
             * Связь многие ко многим. Для обновления нам нужен массив с ID записей, которые
             * нам надо обновить. Так же он удалит связи с записями, с которыми нет в массиве
             */
            case "BelongsToMany":
                $model->{$relation}()->sync($value);
                break;

            default:
                /**
                 * А вот тут беда
                 */
                throw new \Exception(sprintf(
                    'Данный [%s] вид связи не поддерживается. Доступные связи: %s',
                    $relationType,
                    'BelongsTo, BelongsToMany'
                ));
        }
    }
}
