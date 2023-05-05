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

```bash
php artisan make:enum DeclineCode
```

This command generates the following code:
```php
namespace App\Enums;

use Frameck\AwesomeEnums\Traits\FromString;
use Frameck\AwesomeEnums\Traits\HasDetails;
use Frameck\AwesomeEnums\Traits\ToSelect;

enum DeclineCode
{
    use FromString;
    use HasDetails;
    use ToSelect;
}
```

Then we specify that it's a backed enum of type string add the cases
```php
enum DeclineCode: string
{
    use FromString;
    use HasDetails;
    use ToSelect;

    case DEFAULT = 'default';
    case CARD_NOT_SUPPORTED = 'card_not_supported';
    case DO_NOT_HONOR = 'do_not_honor';
    case EXPIRED_CARD = 'expired_card';
    case GENERIC_DECLINE = 'generic_decline';
}
```

This is already enough to use this package:
```php
DeclineCode::all(); // gives you a collection of all cases with their details

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
```php
DeclineCode::EXPIRED_CARD; // gives you the the enum object for that specific case

App\Enums\DeclineCode {
    name: "EXPIRED_CARD",
    value: "expired_card",
}
```
```php
DeclineCode::EXPIRED_CARD->name; // gives you the the name for that specific case
DeclineCode::EXPIRED_CARD->value; // gives you the the value for that specific case
```
```php
DeclineCode::EXPIRED_CARD->details(); // gives you the the array of details for that specific case

[
    "name" => "Expired Card",
    "value" => "expired_card",
]
```
```php
DeclineCode::fromString('expired card')->details() // matches the case name and gives you the details
```

Additionally you can create a function with the camel cased version of the case name that returns an array of details that will be used instead of the default one:
```php
private function default(): array
{
    return [
        'name' => 'Call Issuer',
        'select' => 'Call issuer',
        'description' => 'The card was declined for an unknown reason.',
        'next_steps' => 'The customer needs to contact their card issuer for more information.',
    ];
}

private function cardNotSupported(): array
{
    return [
        'name' => 'Card Not Supported',
        'description' => 'The card was declined for an unknown reason.',
        'next_steps' => 'The customer needs to contact their card issuer for more information.',
    ];
}

private function doNotHonor(): array
{
    return [
        'name' => 'Do Not Honor',
        'description' => 'The card was declined for an unknown reason.',
        'next_steps' => 'The customer needs to contact their card issuer for more information.',
    ];
}

private function expiredCard(): array
{
    return [
        'name' => 'Expired Card',
        'description' => 'The card was declined for an unknown reason.',
        'next_steps' => 'The customer needs to contact their card issuer for more information.',
    ];
}

private function genericDecline(): array
{
    return [
        'name' => 'Generic Decline',
        'description' => 'The card was declined for an unknown reason.',
        'next_steps' => 'The customer needs to contact their card issuer for more information.',
    ];
}
```
```php
DeclineCode::toSelect(); // gives you an array of value => name to use in an html select

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
