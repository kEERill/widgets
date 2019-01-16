<?php namespace Keerill\Widgets\Forms;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Keerill\Widgets\Forms\Types\GroupType;
use Keerill\Widgets\Widget as WidgetBase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Validation\Validator;
use Keerill\Widgets\Exceptions\FormFieldException;

class FormWidget extends WidgetBase
{
    /**
     * @var string Метод формы [POST, GET, PUT, DELETE]
     */
    public $method = 'POST';

    /**
     * @var string Action URL
     */
    public $url = null;

    /**
     * @var string Css Styles формы
     */
    public $wrapperClass = null;

    /**
     * @var string Возвращает название роута
     */
    protected $routeName = null;

    /** 
     * @var string $template Название шаблона формы 
     */
    protected $template = 'widgets::forms.layouts.base';

    /**
     * @var Model Модель формы
     */
    protected $model = null;

    /**
     * @var string Класс модели
     */
    protected $modelClass = null;

    /**
     * @var Collection $formFields Поля данной формы
     */
    protected $fields = null;
    
    /** 
     * @var string $arrayName Все параметры будут начинаться на это название например: User[name]
     */
    protected $arrayName = null;

    /**
     * @var array Спец сообщения валидации
     */
    protected $validationMessages = [];

    /**
     * @var array $availableFiledTypes Массив доступных типов полей
     */
    protected $availableFieldTypes = null;

    /**
     * @inheritdoc
     */
    protected function boot(array $options)
    {
        parent::boot($options);

        /**
         * Регистрируем поля формы
         */
        $this->registerFields();
    }

    /**
     * Возвращает классы для основного контейнера
     * @return string
     */
    public function getWrapperClass()
    {
        return $this->wrapperClass;
    }

    /**
     * Возвращает метод отправки запроса фомой
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Вовзращает название роута
     * @return string
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * Присваивает новое название роута
     * @param string $routeName
     */
    public function setRouteName(string $routeName)
    {
        $this->routeName = $routeName;
    }

    /**
     * Возвращает ссылку формы
     * @return string
     */
    public function getUrl()
    {
        return !$this->url && $this->getRouteName() ? route($this->getRouteName(), $this->getUrlOptions()) : $this->url;
    }

    /**
     * Возвращает параметры для генерации ссылки роута
     * @return array
     */
    protected function getUrlOptions()
    {
        return [];
    }

    /**
     * Формируем правила для валидации
     * @return array
     */
    public function getValidationRules()
    {
        return [];
    }

    /**
     * Возвращает массив названий полей
     *
     * @return array
     */
    public function getValidationNames()
    {
        if (count($this->fields) > 0) {
            return $this->fields->mapWithKeys(function (FormField $field) {
                return [$field->getName() => $field->label];
            })->toArray();
        }

        /**
         * Если вдруг в форме нет полей, то возвращаем пустой массив, логично же?
         */
        return [];
    }

    /**
     * Создание нового экземпляра модели
     * @return Model
     */
    public function createModel()
    {
        $formClass = $this->getModelClass();

        return new $formClass ();
    }

    /**
     * Возвращает класс модели, которую можно привязать к данной форме
     * @return string
     */
    public function getModelClass()
    {
        return $this->modelClass;
    }

    /**
     * Привязывает модель к форме по ID модели
     *
     * @param integer $modelId ID Модели
     * @return self
     */
    public function setModelId(int $modelId)
    {
        return $this->setModel($this->getModelUsingId($modelId));
    }

    /**
     * Возвращает модель по ID
     * @param integer ID модели
     * @return Model
     */
    public function getModelUsingId(int $modelId)
    {
        /**
         * Создаем конструктор запросов
         */
        $query = $this->createFormModel()->where('id', $modelId);

        /**
         * Это делаем для того, чтобы запрос по поиску модели можно было унаследовать
         * т.е. добавить кастомные условия и т.д. к запросу.
         */
        $this->extendModel($query);

        /**
         * Возвращаем код ошибки 404 если вдруг модель не найдена
         */
        abort_if(!$formModel = $query->first(), 404);

        return $formModel;
    }

    /**
     * Задает модель формы, также заполняет поля
     * @param Model $model
     * @return self
     */
    public function setModel(Model $model)
    {
        $this->setData($this->model = $model);
        return $this;
    }

    /**
     * Возвращает экземпляр модели формы
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Применяет переданные значения полям
     *
     * @param array|Model
     * @return self
     */
    public function setData($data)
    {
        if (count($this->fields) > 0) {
            foreach ($this->fields as $field) {
                $field->setValue($field->getValueByData($data, $field->getDefault()));
            }
        }

        return $this;
    }

    /**
     * Возвращает данные формы
     * @return array
     */
    public function getData()
    {
        $data = [];

        if (count($this->fields) > 0) {
            foreach ($this->fields as $field) {
                array_set($data, $field->getName(), $field->getValue());
            }
        }

        return $data;
    }

    /**
     * Вызывается перед проверкой полей
     *
     * @param Validator $validator
     * @return void
     */
    protected function beforeValidation(Validator $validator) {}

    /**
     * Вызывается после проверки полей
     *
     * @param Validator $validator
     * @return void
     */
    protected function afterValidation(Validator $validator) {}

    /**
     * Возвращает массив доступных типов полей
     * @return array
     */
    public function getAvailableFieldTypes()
    {
        if ($this->availableFieldTypes === null) {
            return $this->availableFieldTypes = config('widgets.fieldTypes', []);
        }

        return $this->availableFieldTypes;
    }

    /**
     * Добавляет к форме новое поле, по его типу
     *
     * @param string $fieldName Название поля
     * @param string $fieldType Тип поля
     * @return FormField
     *
     * @throws FormFieldException
     */
    public function add(string $fieldName, string $fieldType)
    {
        /**
         * Получаем все типы полей
         */
        $availableFieldTypes = $this->getAvailableFieldTypes();

        /**
         * Делаем проверку, что данный тип поля существует в системе
         */
        if (!isset($availableFieldTypes[$fieldType])) {
            throw new FormFieldException(
                sprintf('Тип поля [%s] не существует', $fieldType)
            );
        }

        /**
         * Получаем класс поля по типу
         */
        $fieldClass = $availableFieldTypes[$fieldType];

        return $this->addField($fieldName, new $fieldClass ($this->view, $this, $fieldName, $fieldType));
    }

    /**
     * Добавляет новое поле к форме, передавая класс поля
     *
     * @param string $fieldName Название поля
     * @param FormField $formField Экземпляр формы
     * @return FormField
     */
    public function addField(string $fieldName, FormField $formField)
    {
        /**
         * Добавляем данное поле в массив полей данной формы
         */
        if ($this->fields == null) {
            $this->fields = collect([]);
        }

        $this->fields->put($fieldName, $formField);

        /**
         * Если у формы есть начальное название полей, то
         * добавляем его к каждому полю, т.е. name => User[name]
         */
        if ($this->arrayName) {
            $formField->arrayName = $this->arrayName;
        }

        return $formField;
    }

    /**
     * Возвращает коллекцию полей, подключенных к данной форме
     * @return Collection
     */
    public function getFields()
    {
        return $this->fields;
    }


    /**
     * Возвращает объект поля по его названию
     *
     * @param string $fieldName
     * @return FormField
     *
     * @throws FormFieldException
     */
    public function getField(string $fieldName)
    {
        if (!$this->fields->has($fieldName)) {
            throw new FormFieldException(sprintf(
                'Поле с именем [%s] не найдено', $fieldName
            ));
        }

        return $this->fields->get($fieldName);
    }

    /**
     * Получить исходное значение поля
     *
     * @param string $fieldName Название поля
     * @return string
     *
     * @throws FormFieldException
     */
    public function getFieldValue(string $fieldName)
    {
        return $this->getField($fieldName)->getValue();
    }

    /**
     * Проверка полей формы
     * @return void
     */
    public function validated()
    {
        /**
         * Получаем данные для валидатора
         */
        $validationData = $this->getSaveData();
        $validationRules = $this->getValidationRules();
        $validationNames = $this->getValidationNames();
        
        /**
         * Создаём экземпляр валидатора для проведения валидации полей
         * В валидатор передём данные формы, правила валидации, спец сообщения и название полей
         */
        $validator = validator($validationData, $validationRules, $this->validationMessages, $validationNames);

        $this->beforeValidation($validator);

        /**
         * Производим валидацию полей
         */
        $validator->validate();

        $this->afterValidation($validator);
    }

    /**
     * Инициализация конфигурации формы. Данные метод предназначен для управления
     * конфигурации формы
     *
     * @return void
     */
    protected function initConfig()
    {
        $this->fillConfig([
            'method', 'url', 'wrapperClass', 'modelId', 'routeName'
        ]);
    }

    /**
     * Регистрация полей данной формы
     *
     * @return void
     */
    public function registerFields() {}

    /**
     * Возвращает данные формы из запроса
     *
     * @param mixed Исходные данные, если данные не переданы, то они будут взяты из запроса
     * @return array
     */
    public function getSaveData($data = null)
    {
        if ($data === null) {
            $data = request()->all();
        }

        if ($this->arrayName) {
            $data = array_get($data, $this->arrayName, []);
        }

        /**
         * Задаем значения всем полям
         */
        $this->setData($data);

        $result = [];

        if (count($this->fields) > 0) {
            foreach ($this->fields as $field) {
                if ($field->getSaveValue($field->getValue()) != FormField::NOT_SAVE_DATA) {
                    array_set($result, $field->getName(), $field->getSaveValue($field->getValue()));
                }
            }
        }

        return $result;
    }

    /**
     * Наследование запроса
     *
     * @param Builder $query
     * @return void
     */
    protected function extendModel(Builder $query) {}
}