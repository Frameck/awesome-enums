<?php

namespace Frameck\AwesomeEnums;

trait ToSelect
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
}
