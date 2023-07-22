<?php

namespace Frameck\AwesomeEnums\Traits;

use Illuminate\Support\Collection;

trait HasDetails
{
    public function details(?string $key = null): mixed
    {
        $caseFunction = str($this->name)
            ->lower()
            ->camel()
            ->append('Details')
            ->toString();

        $name = str($this->name)->replace('_', ' ')->title()->toString();
        $value = $this->value;

        if (!method_exists(static::class, $caseFunction)) {
            return [
                'name' => $name,
                'value' => $value,
            ];
        }

        $details = collect($this->$caseFunction())
            ->when(
                !isset($details['name']),
                fn (Collection $details) => $details->put('name', $name),
            )
            ->when(
                !isset($details['value']),
                fn (Collection $details) => $details->put('value', $value),
            )
            ->when(
                $key,
                fn (Collection $details) => $details->value($key),
            );

        return $key
            ? $details->get($key)
            : $details->toArray();
    }

    public static function all(): Collection
    {
        return collect(self::class::cases())
            ->map(fn (self $code) => $code->details());
    }

    public static function toArray(): array
    {
        return self::all()->toArray();
    }

    public static function names(): Collection
    {
        return self::all()->pluck('name');
    }

    public static function values(): Collection
    {
        return self::all()->pluck('value');
    }
}
