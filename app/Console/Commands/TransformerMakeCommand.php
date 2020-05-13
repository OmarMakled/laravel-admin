<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class TransformerMakeCommand extends GeneratorCommand
{
    use BaseCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'app:transformer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new tranformer class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Transformer';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/transformer.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models\Transformers';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The model'],
        ];
    }
}
