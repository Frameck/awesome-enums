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

        $name = str($this->name)->replace('_', ' ')->title()->toString();
        $value = $this->value;

        if (!method_exists(static::class, $caseFunction)) {
            return [
                'name' => $name,
                'value' => $value,
            ];
        }

        $details = $this->$caseFunction();

        return collect($details)
            ->when(
                !isset($details['name']),
                fn (Collection $details) => $details->put('name', $name),
            )
            ->when(
                !isset($details['value']),
                fn (Collection $details) => $details->put('value', $value),
            )
            ->toArray();
    }

    public static function all(): Collection
    {
        return collect(self::class::cases())
            ->map(fn (self $code) => $code->details());
    }
}
