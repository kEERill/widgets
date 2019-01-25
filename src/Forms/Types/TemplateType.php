<?php namespace Keerill\Widgets\Forms\Types;


use Keerill\Widgets\Exceptions\FormFieldException;

class TemplateType extends \Keerill\Widgets\Forms\FormField
{
    /**
     * @inheritdoc
     */
    protected $template = null;

    /**
     * @inheritdoc
     */
    protected function initConfig()
    {
        parent::initConfig();

        $this->addConfigOptionsWithMethods([
            'template'
        ]);
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