<?php

namespace Frameck\AwesomeEnums\Commands;

use Illuminate\Console\Command;

class AwesomeEnumsCommand extends Command
{
    public $signature = 'awesome-enums';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
