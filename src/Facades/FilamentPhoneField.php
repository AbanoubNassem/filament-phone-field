<?php

namespace AbanoubNassem\FilamentPhoneField\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AbanoubNassem\FilamentPhoneField\FilamentPhoneField
 */
class FilamentPhoneField extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AbanoubNassem\FilamentPhoneField\FilamentPhoneField::class;
    }
}
