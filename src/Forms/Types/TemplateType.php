<?php namespace Keerill\Widgets\Forms\Types;


use Keerill\Widgets\Exceptions\FormFieldException;

class TemplateType extends \Keerill\Widgets\Forms\FormField
{
    /**
     * @inheritdoc
     */
    protected $template = null;

    /**
     * @var string $template Название шаблона для данного поля
     */
    protected $templateField = 'forms.empty';

    /**
     * @inheritdoc
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @inheritdoc
     */
    protected function prepareRender()
    {
        parent::prepareRender();

        if ($this->template === null) {
            throw new FormFieldException(sprintf(
               'Название шаблона в поле [%s] не задано', $this->getName()
            ));
        }
    }
}