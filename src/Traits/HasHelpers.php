<?php

namespace Frameck\AwesomeEnums\Traits;

use BackedEnum;
use Illuminate\Support\Arr;

trait HasHelpers
{
    public static function toSelect(): array
    {
        return collect(self::cases())
            ->mapWithKeys(function (self $case) {
                $caseDetails = $case->details();
                $selectLabel = $caseDetails['select']
                    ?? $caseDetails['label']
                    ?? $caseDetails['name'];

                return [
                    $case->value => $selectLabel,
                ];
            })
            ->toArray();
    }

    public static function toJson(): string
    {
        return collect(static::class::toSelect())
            ->toJson();
    }

    public static function fromName(string $name): ?self
    {
        $name = str($name)
            ->replace(' ', '_')
            ->upper()
            ->toString();

        return collect(self::cases())
            ->first(fn (self $case) => (
                $case->name === $name
            ));
    }

    public function in(array $cases): bool
    {
        foreach ($cases as $case) {
            if ($this === $case) {
                return true;
            }
        }

        return false;
    }

    public function notIn(array $cases): bool
    {
        return !$this->in($cases);
    }

    public function __invoke($value = null): int|string
    {
        return $this instanceof BackedEnum
            ? $this->details($value ?? 'value')
            : $this->name;
    }

    public function __call($name, $args): int|string
    {
        return $this->fromName($name)
            ->details(Arr::first($args) ?? 'value');
    }

    public static function __callStatic($name, $args): int|string
    {
        return self::fromName($name)
            ->details(Arr::first($args) ?? 'value');
    }
}
