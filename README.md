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

This is the [Content](config/filament-phone-field.php) of the published config file. Check it for more understanding of how the plugin works.

All the configurations , can be overridden by chaining the `PhoneInput` field.

## Usage

```php
use AbanoubNassem\FilamentPhoneField\Forms\Components\PhoneInput;

// admin panel
    public static function form(Form $form): Form
    {
        return $form->schema([
                    ...
                    PhoneInput::make('phone')
                    // make sure to set Initial Country to null, in the admin panel
                    // especially if you have multiple records of phone numbers from 
                    // multiple different countries.
                    ->initialCountry(null)
                    ->tel()
                ]);
     }

//frontend-forms 
    protected function getFormSchema(): array
    {
        return [
            ....
             PhoneInput::make('phone')
             ->tel()
        ];
    }
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Security Vulnerabilities

If you discover any security related issues, please create an issue.

## Credits

- [Abanoub Nassem](https://github.com/AbanoubNassem)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
