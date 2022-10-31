<?php

namespace AbanoubNassem\FilamentPhoneField;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AbanoubNassem\FilamentPhoneField\Commands\FilamentPhoneFieldCommand;

class FilamentPhoneFieldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-phone-field')
            ->hasConfigFile()
            ->hasViews();
    }
}
