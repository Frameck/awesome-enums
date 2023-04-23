<?php

namespace Frameck\AwesomeEnums\Traits;

trait FromString
{
    public static function fromString(string $name): ?self
    {
        $name = str($name)
            ->replace(' ', '_')
            ->upper()
            ->toString();

        $matchedCase = collect(self::cases())
            ->filter(fn (self $case) => (
                $case->name === $name
            ))
            ->first();

        if (!$matchedCase) {
            return null;
        }

        return $matchedCase;
    }
}
