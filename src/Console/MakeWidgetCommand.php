<?php
namespace Keerill\Widgets\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand as GeneratorCommandAlias;

class MakeWidgetCommand extends GeneratorCommandAlias
{
    /**
     * @var string
     */
    protected $type = 'Widget';

    /**
     * Get the stub file for the generator.
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/widget.stub';
    }

    /**
     * Get the destination class path.
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'].'/Widgets/'.str_replace('\\', '/', $name).'.php';
    }

    /**
     * Get the root namespace for the class.
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->laravel->getNamespace() . 'Widgets';
    }
}