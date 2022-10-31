<?php

namespace AbanoubNassem\FilamentPhoneField\Forms\Components;

use Closure;
use Filament\Forms\Components\TextInput;
use JetBrains\PhpStorm\ExpectedValues;

class PhoneInput extends TextInput
{
    protected string $view = 'filament-phone-field::forms.components.phone-input';

    protected ?string $intlTelInputScript;

    protected ?string $intlTelInputCss;

    protected ?string $intlTelInputUtils;

    protected bool $allowDropdown;

    protected bool $autoHideDialCode;

    protected string $autoPlaceholder;

    protected ?string $customPlaceholder = null;

    protected ?string $customContainer;

    protected ?string $dropdownContainer = null;

    protected array $excludeCountries;

    protected bool $formatOnDisplay;

    protected ?string $initialCountry;

    protected ?string $geoIpLookup;

    protected int $cachedGeoIpSeconds;

    protected ?string $hiddenInput = '';

    protected array $localizedCountries;

    protected bool $nationalMode;

    protected array $onlyCountries;

    protected string $placeholderNumberType;

    protected ?array $preferredCountries;

    protected bool $separateDialCode;

    protected function setUp(): void
    {
        parent::setUp();
        $this->intlTelInputScript = config('filament-phone-field.intl_tel_input_script', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js');
        $this->intlTelInputCss = config('filament-phone-field.intl_tel_input_css', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css');
        $this->intlTelInputUtils = config('filament-phone-field.intl_tel_input_utils', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.min.js');
        $this->allowDropdown = config('filament-phone-field.allow_dropdown', true);
        $this->autoHideDialCode = config('filament-phone-field.auto_hide_dial_code', false);
        $this->autoPlaceholder = config('filament-phone-field.auto_placeholder', 'polite');
        $this->customContainer = config('filament-phone-field.custom_container_classes', 'h-full w-full');
        $this->excludeCountries = config('filament-phone-field.exclude_countries', []);
        $this->formatOnDisplay = config('filament-phone-field.format_on_display', true);
        $this->initialCountry = config('filament-phone-field.initial_country', 'auto');
        $this->geoIpLookup = config('filament-phone-field.geo_ip_lookup', 'ipinfo');
        $this->cachedGeoIpSeconds = config('filament-phone-field.cached_geo_ip_seconds', 24 * 60 * 60);
        $this->localizedCountries = config('filament-phone-field.localized_countries', []);
        $this->nationalMode = config('filament-phone-field.national_mode', false);
        $this->onlyCountries = config('filament-phone-field.only_countries', []);
        $this->placeholderNumberType = config('filament-phone-field.placeholder_number_type', 'MOBILE');
        $this->preferredCountries = config('filament-phone-field.preferred_countries', ['EG', 'AE', 'US', 'GB']);
        $this->separateDialCode = config('filament-phone-field.separate_dial_code', false);
    }

    /**
     * A CDN/URL to the intlTelInput css.
     * @param $intlTelInputCss
     * @return $this
     */
    public function intlTelInputCss($intlTelInputCss): static
    {
        $this->intlTelInputCss = $intlTelInputCss;

        return $this;
    }

    public function getIntlTelInputCss(): ?string
    {
        return $this->intlTelInputCss;
    }

    /**
     * A CDN/URL to the intlTelInput script.
     * @param $intlTelInputScript
     * @return $this
     */
    public function intlTelInputScript($intlTelInputScript): static
    {
        $this->intlTelInputScript = $intlTelInputScript;

        return $this;
    }

    public function getIntlTelInputScript(): ?string
    {
        return $this->intlTelInputScript;
    }

    /**
     * A CDN/URL to the intlTelInput utils.
     * @param $intlTelInputUtils
     * @return $this
     */
    public function intlTelInputUtils($intlTelInputUtils): static
    {
        $this->intlTelInputUtils = $intlTelInputUtils;

        return $this;
    }

    public function getIntlTelInputUtils(): ?string
    {
        return $this->intlTelInputUtils;
    }

    /**
     * Whether to allow the dropdown. If disabled, there is no dropdown arrow, and the selected flag is not clickable.
     * Also, we display the selected flag on the right instead because it is just a marker of state.
     * @default true
     * @param bool $allow
     * @return $this
     */
    public function allowDropdown(bool $allow = true): static
    {
        $this->allowDropdown = $allow;

        return $this;
    }

    /**
     * If there is just a dial code in the input: remove it on blur or submit, and re-add it on focus.
     * This is to prevent just a dial code getting submitted with the form. Requires nationalMode to be set to false.
     * @default false
     * @param bool $autoHideDialCode
     * @return $this
     */
    public function autoHideDialCode(bool $autoHideDialCode = false): static
    {
        $this->autoHideDialCode = $autoHideDialCode;

        return $this;
    }

    /**
     * Set the input's placeholder to an example number for the selected country, and update it if the country changes.
     * You can specify the number type using the placeholderNumberType option.
     * By default, it is set to "polite", which means it will only set the placeholder if the input doesn't already have one.
     * You can also set it to 'aggressive', which will replace any existing placeholder, or 'off'.
     * @default 'polite'
     * @param string $autoPlaceholder
     * @return $this
     */
    public function autoPlaceholder(#[ExpectedValues(['off', 'polite', 'aggressive'])] string $autoPlaceholder): static
    {
        $this->autoPlaceholder = $autoPlaceholder;

        return $this;
    }

    /**
     * Change the placeholder generated by autoPlaceholder. Must return a string.
     * @default null
     * @param string|null $customPlaceholder
     * @return $this
     */
    public function customPlaceholder(?string $customPlaceholder): static
    {
        $this->customPlaceholder = $customPlaceholder;

        return $this;
    }

    /**
     * @param Closure|string|null $placeholder
     */
    public function setPlaceholder(Closure|string|null $placeholder): void
    {
        $this->placeholder = $placeholder;
        $this->customPlaceholder = $placeholder;
    }

    /**
     * Additional classes to add to the parent div.
     * @default 'h-full w-full'
     * @param string|null $customContainer
     * @return string|null
     */
    public function customContainer(?string $customContainer = 'h-full w-full'): ?string
    {
        $this->customContainer = $customContainer;
        return $this->customContainer;
    }

    /**
     * Expects a node e.g. document.body. Instead of putting the country dropdown next to the input,
     * append it to the specified node, and it will then be positioned absolutely next to the input using JavaScript.
     * This is useful when the input is inside a container with overflow: hidden.
     * Note that the absolute positioning can be broken by scrolling, so it will automatically close on the window scroll event.
     * @default null
     * @param string|null $dropdownContainer
     * @return $this
     */
    public function dropdownContainer(?string $dropdownContainer = null): static
    {
        $this->dropdownContainer = $dropdownContainer;
        return $this;
    }

    /**
     * In the dropdown, display all countries except the ones you specify here.
     * @default empty []
     * @param array|null $excludeCountries
     * @return $this
     */
    public function excludeCountries(?array $excludeCountries = []): static
    {
        $this->excludeCountries = $excludeCountries;
        return $this;
    }

    /**
     * Format the input value (according to the nationalMode option) during initialisation.
     * @default true
     * @param bool $formatOnDisplay
     * @return $this
     */
    public function formatOnDisplay(bool $formatOnDisplay): static
    {
        $this->formatOnDisplay = $formatOnDisplay;
        return $this;
    }

    /**
     * How many days should wait before revalidating the store, to avoid repeat lookups!
     * @default 86400 a day.
     * @param int $cachedGeoIpSeconds
     * @return $this
     */
    public function cachedGeoIpSeconds(int $cachedGeoIpSeconds = 86400): static
    {
        $this->cachedGeoIpSeconds = $cachedGeoIpSeconds;
        return $this;
    }

    /**
     * Set the initial country selection by specifying its country code.
     * You can also set it to "auto", which will look up the user's country based
     * on their IP address (requires the geoIpLookup option).
     * Note that the 'auto' option will not update the country selection if the
     * input already contains a number. If you leave initialCountry blank,
     * it will default to the first country in the list.
     * @param string|null $initialCountry
     * @return $this
     */
    public function initialCountry(?string $initialCountry): static
    {
        $this->initialCountry = $initialCountry;
        return $this;
    }

    /**
     * When setting initialCountry to 'auto', you must use this option to
     * specify a custom function that looks up the user's location,
     * and then calls the success callback with the relevant country code.
     * @default 'ipinfo'
     * @param string|null $geoIpLookup
     * @return $this
     */
    public function geoIpLookup(?string $geoIpLookup = 'ipinfo'): static
    {
        $this->geoIpLookup = $geoIpLookup;
        return $this;
    }

    public function getCachedGeoIpSeconds(): int
    {
        return $this->cachedGeoIpSeconds;
    }

    /**
     * Add a hidden input with the given name (or if your input name contains square brackets then it will give the hidden input the same name,
     * replacing the contents of the brackets with the given name). On submit, populate it with the full international number.
     * This is a quick way for people using non-ajax forms to get the full international number, even when nationalMode is enabled.
     * Note: requires the input to be inside a form element, as this feature works by listening for the submit event on the closest form element.
     * Also note , it expects a valid number, and so should only be used after validation.
     * @default ''
     * @param string|null $hiddenInput
     * @return string|null
     */
    public function hiddenInput(?string $hiddenInput = ''): ?string
    {
        $this->hiddenInput = $hiddenInput;
        return $this->hiddenInput;
    }

    /**
     * Allows to translate the countries by its given iso code e.g.: [ 'de' => 'Deutschland' ]
     * @default []
     * @param array $localizedCountries
     * @return array
     */
    public function localizedCountries(array $localizedCountries = []): array
    {
        $this->localizedCountries = $localizedCountries;
        return $this->localizedCountries;
    }

    /**
     * Allow users to enter national numbers (and not have to think about
     * international dial codes). Formatting, validation and placeholders still work.
     * @default false
     * @param bool $nationalMode
     * @return bool
     */
    public function nationalMode(bool $nationalMode = false): bool
    {
        $this->nationalMode = $nationalMode;
        return $this->nationalMode;
    }

    /**
     * In the dropdown, display only the countries you specify.
     * @default null
     * @param array|null $onlyCountries
     * @return $this
     */
    public function onlyCountries(?array $onlyCountries = null): static
    {
        $this->onlyCountries = $onlyCountries;
        return $this;
    }

    /**
     * Specify one of these keys ['FIXED_LINE_OR_MOBILE', 'FIXED_LINE', 'MOBILE', 'PAGER', 'PERSONAL_NUMBER','PREMIUM_RATE', 'SHARED_COST', 'TOLL_FREE', 'UAN', 'UNKNOWN', 'VOICEMAIL', 'VOIP']
     * @default MOBILE
     * @param string $placeholderNumberType
     * @return $this
     */
    public function placeholderNumberType(#[ExpectedValues(['FIXED_LINE_OR_MOBILE', 'FIXED_LINE', 'MOBILE', 'PAGER', 'PERSONAL_NUMBER', 'PREMIUM_RATE', 'SHARED_COST', 'TOLL_FREE', 'UAN', 'UNKNOWN', 'VOICEMAIL', 'VOIP'])] string $placeholderNumberType = 'MOBILE'): static
    {
        $this->placeholderNumberType = $placeholderNumberType;
        return $this;
    }

    /**
     * Specify the countries to appear at the top of the list.
     * @default ['EG', 'AE', 'US', 'GB']
     * @param array|null $preferredCountries
     * @return $this
     */
    public function preferredCountries(array $preferredCountries = ['EG', 'AE', 'US', 'GB']): static
    {
        $this->preferredCountries = $preferredCountries;
        return $this;
    }

    /**
     * Display the country dial code next to the selected flag, so it's not part
     * of the typed number. Note that this will disable nationalMode because
     * technically we are dealing with international numbers, but with the
     * dial code separated.
     * @default false
     * @param bool $separateDialCode
     * @return bool
     */
    public function separateDialCode(bool $separateDialCode = false): bool
    {
        $this->separateDialCode = $separateDialCode;
        return $separateDialCode;
    }

    public function getConfigurations(): array
    {
        return [
            'allowDropdown' => $this->allowDropdown,
            'autoHideDialCode' => $this->autoHideDialCode,
            'autoPlaceholder' => $this->autoPlaceholder,
            'customPlaceholder' => $this->customPlaceholder,
            'customContainer' => $this->customContainer,
            'dropdownContainer' => $this->dropdownContainer,
            'excludeCountries' => $this->excludeCountries,
            'initialCountry' => $this->initialCountry,
            'geoIpLookup' => $this->geoIpLookup,
            'formatOnDisplay' => $this->formatOnDisplay,
            'hiddenInput' => $this->hiddenInput,
            'localizedCountries' => $this->localizedCountries,
            'nationalMode' => $this->nationalMode,
            'onlyCountries' => $this->onlyCountries,
            'preferredCountries' => $this->preferredCountries,
            'separateDialCode' => $this->separateDialCode
        ];
    }

}
