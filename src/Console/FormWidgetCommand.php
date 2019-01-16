<?php
namespace Keerill\Widgets\Console;

class FormWidgetCommand extends MakeWidgetCommand
{
    /**
     * @var string
     */
    protected $type = 'Widget';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'widget:form {name : The name widget} {--context=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a form widget';

    /**
     * Get the stub file for the generator.
     * @return string
     */
    protected function getStub()
    {
        switch ($this->option('context')) {
            case 'create':
                return __DIR__ . '/stubs/formwidget-create.stub';
                break;

            case 'update':
                return __DIR__ . '/stubs/formwidget-update.stub';
                break;
        }

        return __DIR__ . '/stubs/formwidget.stub';
    }
}