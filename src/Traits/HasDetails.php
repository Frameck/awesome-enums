<?php

namespace Frameck\AwesomeEnums\Traits;

use Illuminate\Support\Collection;

trait HasDetails
{
    public function details(): array
    {
        $caseFunction = str($this->name)
            ->lower()
            ->camel()
            ->toString();

        if (!method_exists(static::class, $caseFunction)) {
            return [
                'name' => str($this->name)->replace('_', ' ')->title()->toString(),
                'value' => $this->value,
            ];
        }

        $details = $this->$caseFunction();

        return array_merge(
            $details,
            [
                'value' => $this->value,
            ]
        );
    }

    public static function all(): Collection
    {
        return collect(self::class::cases())
            ->map(fn (self $code) => $code->details());
    }
}
