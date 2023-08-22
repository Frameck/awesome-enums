<?php

namespace Frameck\AwesomeEnums\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

use function Laravel\Prompts\select;

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
        $type = $this->option('type')
            ?? select(
                label: 'Should be a backed enum?',
                options: [
                    'no' => 'No',
                    'int' => 'Int',
                    'string' => 'String',
                ]
            );

        return str_replace(
            ['{{ type }}'],
            match ($type) {
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
