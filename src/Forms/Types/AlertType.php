<?php namespace Keerill\Widgets\Forms\Types;

class AlertType extends \Keerill\Widgets\Forms\FormField
{
    /**
     * @var string Тип сообщения [danger, success, primary, warning]
     */
    public $alertType = 'danger';

    /**
     * @inheritdoc
     */
    protected $template = 'widgets::forms.fields.alert';

    /**
     * @inheritdoc
     */
    public function initConfig()
    {
        parent::initConfig();

        $this->fillConfig([
            'alertType'
        ]);
    }
}
