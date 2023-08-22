<?php

namespace Frameck\AwesomeEnums\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeEnumCommand extends GeneratorCommand
{
    public $signature = 'make:enum {name} {--type=} {--force}';

    public $description = 'Make an enum class';

    protected $type = 'enum';

    protected function getStub(): string
    {
        return base_path('vendor/frameck/awesome-enums/stubs/enum.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Enums';
    }

    protected function buildClass($name)
    {
        return str_replace(
            ['{{ type }}'],
            match ($this->option('type')) {
                'string' => ': string',
                'int', 'integer' => ': int',
                default => ''
            },
            parent::buildClass($name)
        );
    }

    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if it already exists'],
            ['type', 't', InputOption::VALUE_OPTIONAL, 'Indicates that enum data type'],
        ];
    }
}
