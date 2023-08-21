<?php

// config for AbanoubNassem/FilamentPhoneField
return [
    /*
    |--------------------------------------------------------------------------
    | International Telephone Input Script
    |--------------------------------------------------------------------------
    |
    | A CDN/URL to the intlTelInput Javascript.
    | You can use asset() , if you would like to load it locally.
    |
    */

    'intl_tel_input_script' => 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js',

    /*
    |--------------------------------------------------------------------------
    | International Telephone Input StyleSheet
    |--------------------------------------------------------------------------
    |
    | A CDN/URL to the intlTelInput Javascript.
    | You can use asset() , if you would like to load it locally.
    |
    */

    'intl_tel_input_css' => 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css',

    /*
    |--------------------------------------------------------------------------
    | International Telephone Input Utilities Script
    |--------------------------------------------------------------------------
    |
    | A CDN/URL to the intlTelInput Utilities Script.
    | You can use asset() , if you would like to load it locally.
    |
    */

    'intl_tel_input_utils' => 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.min.js',

    /*
    |
    | Whether to allow the dropdown.
    | If disabled, there is no dropdown arrow, and the selected flag is not clickable.
    | Also, we display the selected flag on the right instead because it is just a marker of state.
    |
    */

    'allow_dropdown' => true,

    /*
    |
    | If there is just a dial code in the input: remove it on blur or submit, and re-add it on focus.
    | This is to prevent just a dial code getting submitted with the form.
    | Requires nationalMode to be set to false.
    |
    */

    'auto_hide_dial_code' => false,

    /*
    |
    | Set the input's placeholder to an example number for the selected country, and update it if the country changes.
    | You can specify the number type using the placeholderNumberType option.
    | By default, it is set to 'polite', which means it will only set the placeholder if the input doesn't already have one.
    | You can also set it to 'aggressive', which will replace any existing placeholder, or 'off'.
    |
    */

    'auto_placeholder' => 'polite',

    /*
    |
    | Additional classes to add to the parent div.
    |
    */

    'custom_container_classes' => 'h-full w-full',

    /*
    |
    | Format the input value (according to the nationalMode option) during initialisation.
    |
    */

    'format_on_display' => true,

    /*
    |
    | Set the initial country selection by specifying its country code.
    | You can also set it to 'auto', which will look up the user's country based
    | on their IP address (requires the geoIpLookup option).
    | Note that the 'auto' option will not update the country selection if the
    | input already contains a number. If you leave initialCountry blank,
    | it will default to the first country in the list.
    |
    */

    'initial_country' => 'auto',

    /*
    |
    | When setting initialCountry to 'auto', you must use this option to
    | specify a custom function that looks up the user's location,
    | and then calls the success callback with the relevant country code.
    |
    */

    'geo_ip_lookup' => 'ipinfo',

    /*
    |
    | How many seconds should wait before revalidating the store, to avoid repeat lookups!
    |
    */

    'cached_geo_ip_seconds' => 24 * 60 * 60,

    /*
    |
    | Allow users to enter national numbers (and not have to think about
    | international dial codes). Formatting, validation and placeholders still work.
    |
    */

    'national_mode' => false,

    /*
    |
    | Specify one of these keys ['FIXED_LINE_OR_MOBILE', 'FIXED_LINE', 'MOBILE', 'PAGER', 'PERSONAL_NUMBER',
    | 'PREMIUM_RATE', 'SHARED_COST', 'TOLL_FREE', 'UAN', 'UNKNOWN', 'VOICEMAIL', 'VOIP']
    |
    */

    'placeholder_number_type' => 'MOBILE',

    /*
    |
    | Display the country dial code next to the selected flag, so it's not part
    | of the typed number. Note that this will disable nationalMode because
    | technically we are dealing with international numbers, but with the dial code separated.
    |
    */

    'separate_dial_code' => false,

    /*
    |
    | In the dropdown, display only the countries you specify.
    |
    */

    'only_countries' => [],

    /*
    |
    | Specify the countries to appear at the top of the list.
    |
    */

    'preferred_countries' => ['EG', 'AE', 'US', 'GB'],

    /*
    |
    | In the dropdown, display all countries except the ones you specify here.
    |
    */

    'exclude_countries' => [],

    /*
    |
    | Allows to translate the countries by its given iso code e.g.: [ 'de' => 'Deutschland' ]
    |
    */

    'localized_countries' => [],
];
