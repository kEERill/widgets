<?php

return [
    /**
     * Массив доступных типов полей для форм
     */
    'fieldTypes' => [
        /**
         * Текстовое поле
         */
        'text' => \Keerill\Widgets\Forms\Types\InputType::class,

        /**
         * Поле, для ввода электронной почты
         */
        'email' => \Keerill\Widgets\Forms\Types\InputType::class,

        /**
         * Мультистрокое поле
         */
        'textarea' => \Keerill\Widgets\Forms\Types\TextareaType::class,

        /**
         * Выпадающий список
         */
        'select' => \Keerill\Widgets\Forms\Types\SelectType::class,

        /**
         * Поле с выпадающим меню с возможностью выбора нескольких опций
         */
        'multiselect' => \Keerill\Widgets\Forms\Types\MultiSelectType::class,

        /**
         * Блок с сообщением
         */
        'alert' => \Keerill\Widgets\Forms\Types\AlertType::class,

        /**
         * Флажок [Да/Нет]
         */
        'checkbox' => \Keerill\Widgets\Forms\Types\CheckboxType::class,

        /**
         * Поле для паролей, данное поле автоматически шифрует данные
         */
        'password' => \Keerill\Widgets\Forms\Types\PasswordType::class,

        /**
         * Поле выбора даты
         */
        'date' => \Keerill\Widgets\Forms\Types\DateType::class,

        /**
         * Поле выбора времени
         */
        'time' => \Keerill\Widgets\Forms\Types\TimeType::class,

        /**
         * Поле выбора даты и времени
         */
        'datetime' => \Keerill\Widgets\Forms\Types\DatetimeType::class,

        /**
         * Блок выбора одного элемента
         */
        'radio' => \Keerill\Widgets\Forms\Types\RadioType::class,

        /**
         * Скрытое поле
         */
        'hidden' => \Keerill\Widgets\Forms\Types\HiddenType::class,

        /**
         * Шаблон
         */
        'template' => \Keerill\Widgets\Forms\Types\TemplateType::class,

        /**
         * Кнопка
         */
        'button' => \Keerill\Widgets\Forms\Types\ButtonType::class,
    ],

    /**
     * Массив доступных типов столбцов
     */
    'columnTypes' => [
        /**
         * Стандартный столбец
         */
        'default' => \App\Widgets\Lists\ListColumn::class,

        /**
         * Управление связями
         */
        'relation' => \Keerill\Widgets\Lists\Types\RelationType::class,

        /**
         * Вывод дат
         */
        'datetime' => \Keerill\Widgets\Lists\Types\DateTimeType::class,
        
        /**
         * Вывод значения
         */
        'value' => \Keerill\Widgets\Lists\Types\ValueType::class,
    ],

    /**
     * Тема для оформления виджетов по умолчанию
     */
    'theme' => 'default',

    /**
     * Некоторые стили для работы виджетов
     * Например: стиль поля при невалидности
     */
    'cssStyles' => [
        /**
         * Стандартные стили стандартной темы
         */
        'default' => [
            /**
             * Стиль будет применяться к полю, в том случае
             * если оно не прошло валидацию
             */
            'input-danger' => 'is-invalid'
        ]
    ]
];