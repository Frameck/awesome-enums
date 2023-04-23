<?php

namespace Frameck\AwesomeEnums\Traits;

trait ToJson
{
    public static function toJson(): string
    {
        return collect(static::class::toSelect())
            ->toJson();
    }
}
