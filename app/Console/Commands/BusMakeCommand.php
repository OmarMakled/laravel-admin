<?php

namespace App\Console\Commands;

use App\Console\Commands\BaseCommand;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class BusMakeCommand extends GeneratorCommand
{
    use BaseCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'app:bus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new bus command class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Command';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $type = $this->option('type') ?? 'create';

        return __DIR__ . '/stubs/' . $type . '.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Bus\Commands';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The model.'],
            ['type', 't', InputOption::VALUE_OPTIONAL, 'The type.'],
        ];
    }
}
