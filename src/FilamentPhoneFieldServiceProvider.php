<?php

namespace AbanoubNassem\FilamentPhoneField;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
