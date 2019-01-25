<?php namespace Keerill\Widgets\Forms\Types;

class AlertType extends \Keerill\Widgets\Forms\FormField
{
    /**
     * @var string Тип сообщения [danger, success, primary, warning]
     */
    protected $alertType = 'danger';

    /**
     * @var string Заголовок сообщения
     */
    protected $title = null;

    /**
     * @var string Текст сообщения
     */
    protected $message = null;

    /**
     * @inheritdoc
     */
    protected $template = 'widgets::forms.fields.alert';

    /**
     * Изменяет тип сообщения
     * @param string
     * @return self
     */
    public function setAlertType(string $alertType)
    {
        $this->alertType = $alertType;
        return $this;
    }

    /**
     * Возвращает тип сообщения
     * @return string
     */
    public function getAlertType()
    {
        return $this->alertType;
    }

    /**
     * Задает заголовок сообщения
     * @param string
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Возвращает заголовок сообщения
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Задает текст сообщения
     * @param string
     * @return self
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Возвращает текст сообщения
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @inheritdoc
     */
    public function initConfig()
    {
        parent::initConfig();

        $this->addConfigOptionsWithMethods([
            'alertType', 'title', 'message'
        ]);
    }
}
