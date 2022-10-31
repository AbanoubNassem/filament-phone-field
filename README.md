# Provides a Phone Input field for the Filament Forms, works in Admin-Panel and Forntend-Forms

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abanoubnassem/filament-phone-field.svg?style=flat-square)](https://packagist.org/packages/abanoubnassem/filament-phone-field)
[![Total Downloads](https://img.shields.io/packagist/dt/abanoubnassem/filament-phone-field.svg?style=flat-square)](https://packagist.org/packages/abanoubnassem/filament-phone-field)

A wrapper around [intl-tel-input](https://github.com/jackocnr/intl-tel-input) plugin for entering and validating international telephone numbers. It adds a flag dropdown to filament-forms, detects the user's country, displays a relevant placeholder and provides formatting/validation methods.


## Installation

You can install the package via composer:

```bash
composer require abanoubnassem/filament-phone-field
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-phone-field-config"
```

This is the [Contents](config/filament-phone-field.php) of the published config file.

## Usage

```php
$filamentPhoneField = new AbanoubNassem\FilamentPhoneField();
echo $filamentPhoneField->echoPhrase('Hello, AbanoubNassem!');
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Abanoub Nassem](https://github.com/AbanoubNassem)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
