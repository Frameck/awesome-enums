<?php

namespace Frameck\AwesomeEnums\Traits;

use BackedEnum;
use Illuminate\Support\Arr;

trait HasHelpers
{
    public static function toSelect(): array
    {
        return collect(static::cases())
            ->mapWithKeys(function (self $case) {
                $caseDetails = $case->getDetails();
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

    public static function fromName(string $name): ?static
    {
        $name = str($name)
            ->replace(' ', '_')
            ->upper()
            ->toString();

        return collect(static::cases())
            ->first(fn (self $case) => (
                $case->name === $name
            ));
    }

    public function in(array $cases): bool
    {
        return in_array($this, $cases);
    }

    public function notIn(array $cases): bool
    {
        return !$this->in($cases);
    }

    public function __invoke($value = null): int|string
    {
        return $this instanceof BackedEnum
            ? $this->getDetails($value ?? 'value')
            : $this->name;
    }

    public function __call($name, $args): int|string
    {
        return $this->fromName($name)
            ->getDetails(Arr::first($args) ?? 'value');
    }

    public static function __callStatic($name, $args): int|string
    {
        return self::fromName($name)
            ->getDetails(Arr::first($args) ?? 'value');
    }
}
