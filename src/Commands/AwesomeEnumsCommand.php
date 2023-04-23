<?php

namespace Frameck\AwesomeEnums\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class AwesomeEnumsCommand extends GeneratorCommand
{
    public $signature = 'make:enum {name}';

    public $description = 'Make an enum class';

    protected function getStub(): string
    {
        return base_path('vendor/frameck/awesome-enums/stubs/enum.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Enums';
    }

    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if it already exists'],
        ];
    }
}
