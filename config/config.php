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
        'password' => \Keerill\Widgets\Forms\Types\InputType::class,

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
        'template' => \Keerill\Widgets\Forms\Types\TemplateType::class
    ],

    /**
     * Массив доступных типов столбцов
     */
    'columnTypes' => [
        /**
         * Стандартный столбец
         */
        'default' => \Keerill\Widgets\Lists\ListColumn::class,

        /**
         * Управление связями
         */
        'relation' => \Keerill\Widgets\Lists\Types\RelationType::class,

        /**
         * Вывод дат
         */
        'datetime' => \Keerill\Widgets\Lists\Types\DateTimeType::class
    ],

    /**
     * Стили статуса поля, например:
     * невалидное поле или отключенное
     */
    'cssStyles' => [
        /**
         * Класс для невалидного поля
         */
        'input-danger' => 'is-invalid',

        /**
         * Класс для поля, когда поле отключено
         */
        'input-disabled' => 'form-disabled',

        /**
         * Класс для текста ошибок под полями
         */
        'errors' => 'invalid-feedback'
    ],

    /**
     * Стили статуса для определенных полей
     */
    'customCssStyles' => [

    ],

    /**
     * Атрибуты, которые будут присвоиваться всем полям
     */
    'attributes' => [

        /**
         * Атрибуты для заголовка
         */
        'label' => [
            'class' => 'form-label'
        ],

        /**
         * Атрибуты для поля
         */
        'input' => [
            'class' => ['form-control']
        ],

        /**
         * Атрибуты для блока, в ктором находяться заголовок и поле
         */
        'group' => [
            'class' => 'form-group'
        ]
    ],

    /**
     * Нестандартные аттрибуты для определенных полей
     */
    'customAttributes' => [

        /**
         * Атрибудты для checkbox
         */
        'checkbox' => [
            'label' => [
                'class' => 'form-check-label'
            ],
            'input' => [
                'class' => 'form-check-input'
            ],
            'group' => [
                'class' => 'form-check'
            ]
        ],

        /**
         * Атрибудты для radio
         */
        'radio' => [
            'label' => [
                /**
                 * Название класса для заголовка
                 */
                'class' => 'form-check-label'
            ],
            'input' => [
                /**
                 * Название класса для инпута, т.е. флажка
                 */
                'class' => 'form-check-input'
            ],
            'group' => [
                /**
                 * Название класса для div блока, в котором находиться данный инпут и заголовок
                 */
                'class' => 'form-check'
            ]
        ]
    ]
];