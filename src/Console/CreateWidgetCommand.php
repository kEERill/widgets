<?php
namespace Keerill\Widgets\Console;

class CreateWidgetCommand extends MakeWidgetCommand
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
    protected $signature = 'widget:create {name : The name widget}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a widget';

    /**
     * Get the stub file for the generator.
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/widget.stub';
    }
}