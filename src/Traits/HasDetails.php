<?php

namespace Frameck\AwesomeEnums\Traits;

use Illuminate\Support\Collection;

trait HasDetails
{
    public function getDetails(?string $key = null): mixed
    {
        $caseFunction = str($this->name)
            ->lower()
            ->camel()
            ->append('Details')
            ->toString();

        $name = str($this->name)->replace('_', ' ')->title()->toString();
        $value = $this->value;

        $details = [
            'name' => $name,
            'value' => $value,
        ];

        if (method_exists(static::class, $caseFunction)) {
            $details = $this->$caseFunction();
        }

        $details = collect($details)
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
        return collect(static::cases());
    }

    public static function details(): Collection
    {
        return static::all()
            ->map(fn (self $case) => $case->getDetails());
    }

    public static function toArray(): array
    {
        return static::details()->toArray();
    }

    public static function names(): Collection
    {
        return static::details()->pluck('name');
    }

    public static function values(): Collection
    {
        return static::details()->pluck('value');
    }
}
