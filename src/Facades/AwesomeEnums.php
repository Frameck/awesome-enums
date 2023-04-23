<?php

namespace Frameck\AwesomeEnums\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Frameck\AwesomeEnums\AwesomeEnums
 */
class AwesomeEnums extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Frameck\AwesomeEnums\AwesomeEnums::class;
    }
}
