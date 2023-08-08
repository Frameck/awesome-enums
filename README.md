# Awesome Enums

[![Latest Version on Packagist](https://img.shields.io/packagist/v/frameck/awesome-enums.svg?style=flat-square)](https://packagist.org/packages/frameck/awesome-enums)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/frameck/awesome-enums/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/frameck/awesome-enums/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/frameck/awesome-enums/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/frameck/awesome-enums/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/frameck/awesome-enums.svg?style=flat-square)](https://packagist.org/packages/frameck/awesome-enums)

This package provides a `make:enum` command and a set of traits that extend the functionality of enums

## Installation

You can install the package via composer:

```bash
composer require frameck/awesome-enums
```

## Usage

`--type` accepts `string` or `int` as values
```bash
php artisan make:enum DeclineCode --type=string
```

This command generates the following code:
```php
namespace App\Enums;

use Frameck\AwesomeEnums\Traits\Comparable;
use Frameck\AwesomeEnums\Traits\HasDetails;
use Frameck\AwesomeEnums\Traits\HasHelpers;

enum DeclineCode: string
{
    use Comparable;
    use HasDetails;
    use HasHelpers;
}
```

Then we add the cases
```php
enum DeclineCode: string
{
    use Comparable;
    use HasDetails;
    use HasHelpers;

    case DEFAULT = 'default';
    case CARD_NOT_SUPPORTED = 'card_not_supported';
    case DO_NOT_HONOR = 'do_not_honor';
    case EXPIRED_CARD = 'expired_card';
    case GENERIC_DECLINE = 'generic_decline';
}
```

This is already enough to use this package:

The `all()` method provides a collection of all cases
```php
DeclineCode::all();

// result
Illuminate\Support\Collection {
    all: [
        App\Enums\DeclineCode {
            +name: "DEFAULT",
            +value: "default",
        },
        App\Enums\DeclineCode {
            +name: "CARD_NOT_SUPPORTED",
            +value: "card_not_supported",
        },
        App\Enums\DeclineCode {
            +name: "DO_NOT_HONOR",
            +value: "do_not_honor",
        },
        App\Enums\DeclineCode {
            +name: "EXPIRED_CARD",
            +value: "expired_card",
        },
        App\Enums\DeclineCode {
            +name: "GENERIC_DECLINE",
            +value: "generic_decline",
        },
    ],
}
```

The `details()` method provides a collection of all cases with their details
```php
DeclineCode::details();

// result
Illuminate\Support\Collection {
    all: [
        [
            "name" => "Default",
            "value" => "default",
        ],
        [
            "name" => "Card Not Supported",
            "value" => "card_not_supported",
        ],
        [
            "name" => "Do Not Honor",
            "value" => "do_not_honor",
        ],
        [
            "name" => "Expired Card",
            "value" => "expired_card",
        ],
        [
            "name" => "Generic Decline",
            "value" => "generic_decline",
        ],
    ],
}
```

The `toArray()` method provides the array representation of the `details()` method
```php
DeclineCode::toArray();

// result
[
    [
        "name" => "Default",
        "value" => "default",
    ],
    [
        "name" => "Card Not Supported",
        "value" => "card_not_supported",
    ],
    [
        "name" => "Do Not Honor",
        "value" => "do_not_honor",
    ],
    [
        "name" => "Expired Card",
        "value" => "expired_card",
    ],
    [
        "name" => "Generic Decline",
        "value" => "generic_decline",
    ],
]
```

The `fromName()` method matches the case name and returns you the enum instance
```php
DeclineCode::fromName('expired card')

// result
App\Enums\DeclineCode {
    name: "EXPIRED_CARD",
    value: "expired_card",
}
```

You can call the enum case as a static function
```php
DeclineCode::EXPIRED_CARD() // equivalent to DeclineCode::EXPIRED_CARD->value
DeclineCode::EXPIRED_CARD('name') // equivalent to DeclineCode::EXPIRED_CARD->name
DeclineCode::EXPIRED_CARD('value') // equivalent to DeclineCode::EXPIRED_CARD->value
```

or from an instance
```php
$declineCode = DeclineCode::EXPIRED_CARD;

$declineCode() // equivalent to $declineCode->value
$declineCode('name') // equivalent to $declineCode->name
$declineCode('value') // equivalent to $declineCode->value
```

The `details()` method gives you the the array of details for that specific case
```php
DeclineCode::EXPIRED_CARD->getDetails();

// result
[
    "name" => "Expired Card",
    "value" => "expired_card",
]
```

Additionally you can create a function with the camel cased version of the case name (+ Details) that returns an array of details that will be used instead of the default one:
```php
private function defaultDetails(): array
{
    return [
        'name' => 'Call Issuer',
        'select' => 'Call issuer',
        'description' => 'The card was declined for an unknown reason.',
        'next_steps' => 'The customer needs to contact their card issuer for more information.',
    ];
}

private function cardNotSupportedDetails(): array
{
    return [
        'name' => 'Card Not Supported',
        'description' => 'The card was declined for an unknown reason.',
        'next_steps' => 'The customer needs to contact their card issuer for more information.',
    ];
}

private function doNotHonorDetails(): array
{
    return [
        'name' => 'Do Not Honor',
        'description' => 'The card was declined for an unknown reason.',
        'next_steps' => 'The customer needs to contact their card issuer for more information.',
    ];
}

private function expiredCardDetails(): array
{
    return [
        'name' => 'Expired Card',
        'description' => 'The card was declined for an unknown reason.',
        'next_steps' => 'The customer needs to contact their card issuer for more information.',
    ];
}

private function genericDeclineDetails(): array
{
    return [
        'name' => 'Generic Decline',
        'description' => 'The card was declined for an unknown reason.',
        'next_steps' => 'The customer needs to contact their card issuer for more information.',
    ];
}
```
You can also pass an optional key to retrieve only that value
```php
DeclineCode::EXPIRED_CARD->getDetails('description');

// result
// The card was declined for an unknown reason.
```

The `toSelect()` method provides an array of key value pair useful in html selects
```php
DeclineCode::toSelect();

[
    "default" => "Call issuer",
    "card_not_supported" => "Card Not Supported",
    "do_not_honor" => "Do Not Honor",
    "expired_card" => "Expired Card",
    "generic_decline" => "Generic Decline",
]

// the toSelect() method is based on the details() array so you can specify a custom label for the select
// in order the package searches for a 'select' key then 'label' and 'name'
// so you can have a different value for 'name' and 'select'
public static function toSelect(): array
{
    return collect(self::cases())
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
```

The `toJson()` method provides the json representation of the `toSelect()` method useful when you have to share data with a frontend in vue, react ecc... or an api:
```php
DeclineCode::toJson();

// "{"default":"Call issuer","card_not_supported":"Card Not Supported","do_not_honor":"Do Not Honor","expired_card":"Expired Card","generic_decline":"Generic Decline"}"
```

The `is()` and `isNot()` methods provide a fluent way to check if an enum instance is equal to another:
```php
DeclineCode::CARD_NOT_SUPPORTED->is(DeclineCode::EXPIRED_CARD); // false
DeclineCode::CARD_NOT_SUPPORTED->isNot(DeclineCode::EXPIRED_CARD); // true
```

The `in()` and `notIn()` methods provide a fluent way to check if an enum instance is present in an array of enums:
```php
DeclineCode::CARD_NOT_SUPPORTED->in([DeclineCode::EXPIRED_CARD, DeclineCode::GENERIC_DECLINE]); // false
DeclineCode::CARD_NOT_SUPPORTED->notIn([DeclineCode::EXPIRED_CARD, DeclineCode::GENERIC_DECLINE]); // true
```

To better integrate the enum in a laravel ecosystem you can add it inside the `$casts` property of the model
```php
class Payment extends Model
{
    protected $casts = [
        'decline_code' => DeclineCode::class
    ];
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Frameck](https://github.com/Frameck)
- [All Contributors](../../contributors)
- [Steve Barbera post on medium](https://stevebarbera.medium.com/extending-php8-1-enums-10ea22aa15c4)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
