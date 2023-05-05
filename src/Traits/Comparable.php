<?php

namespace Frameck\AwesomeEnums\Traits;

trait Comparable
{
    public function is(self $enum): bool
    {
        return $this === $enum;
    }

    public function isNot(self $enum): bool
    {
        return $this !== $enum;
    }
}
