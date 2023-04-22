@once
    @push('scripts')
        @if($getIntlTelInputCss())
            <link rel="stylesheet" href="{{$getIntlTelInputCss()}}"/>
        @endif
        @if($getIntlTelInputScript())
            <script src="{{$getIntlTelInputScript()}}"></script>
        @endif
        <style>
            .dark .filament-phone-input-field-component .iti__country-list {
                --tw-bg-opacity: 1;
                --tw-text-opacity: 1;
                background-color: rgb(55 65 81/var(--tw-bg-opacity));
                color: rgb(255 255 255/var(--tw-text-opacity))
            }
        </style>
    @endpush
@endonce

<script>
    window.initPhoneField = function (statePath) {
        const input = document.querySelector(`[wire\\:model\\.defer="${statePath}"]`);
        const config = @js($getConfigurations());

        const intl = intlTelInput(input, {
            ...config,
            utilsScript: '{{$getIntlTelInputUtils()}}',
            customPlaceholder: config.customPlaceholder != null ? (_, __) => config.customPlaceholder : null,
            geoIpLookup: config.geoIpLookup === "ipinfo" ? function (success, _) {
                const countryCode = localStorage.getItem('phone-input-country-code');
                const lastCheck = localStorage.getItem('phone-input-last-check');


                if (lastCheck === null || new Date() >= new Date(lastCheck)) {
                    fetch("https://ipinfo.io/json")
                        .then((res) => res.json())
                        .then((data) => data)
                        .then((data) => {
                            const countryCode = data.country;
                            const newDate = new Date();
                            localStorage.setItem('phone-input-last-check', (new Date(newDate.setSeconds(newDate.getSeconds() + {{$getCachedGeoIpSeconds()}}))).toString());
                            localStorage.setItem('phone-input-country-code', countryCode);
                            success(country);
                        })
                        .catch((_) => success(localStorage.getItem('phone-input-country-code')));
                } else {
                    success(countryCode);
                }
            } : config.geoIpLookup,
        });

        if (config.initialCountry === 'auto') {
            intl.setCountry(localStorage.getItem('phone-input-country-code'));
        }

    }

</script>


<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
    x-init="initPhoneField('{{$getStatePath()}}')"
    x-effect="initPhoneField('{{$getStatePath()}}')"
>
    <div {{ $attributes->merge($getExtraAttributes())->class(['filament-phone-input-field-component flex items-center space-x-2 rtl:space-x-reverse group']) }}>
        @if (($prefixAction = $getPrefixAction()) && (! $prefixAction->isHidden()))
            {{ $prefixAction }}
        @endif

        @if ($icon = $getPrefixIcon())
            <x-dynamic-component :component="$icon" class="w-5 h-5"/>
        @endif

        @if ($label = $getPrefixLabel())
            <span @class($affixLabelClasses)>
                {{ $label }}
            </span>
        @endif

        <div class="flex-1">
            <input
                @unless ($hasMask())
                    x-data="{}"
            {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
            type="{{ $getType() }}"
            @else
                x-data="textInputFormComponent({
                        {{ $hasMask() ? "getMaskOptionsUsing: (IMask) => ({$getJsonMaskConfiguration()})," : null }}
                state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')', lazilyEntangledModifiers: ['defer']) }},
                    })"
                type="text"
                wire:ignore
                {!! $isLazy() ? "x-on:blur=\"\$wire.\$refresh\"" : null !!}
                {!! $isDebounced() ? "x-on:input.debounce.{$getDebounce()}=\"\$wire.\$refresh\"" : null !!}
                {{ $getExtraAlpineAttributeBag() }}
            @endunless
            dusk="filament.forms.{{ $getStatePath() }}"
            {!! ($autocapitalize = $getAutocapitalize()) ? "autocapitalize=\"{$autocapitalize}\"" : null !!}
            {!! ($autocomplete = $getAutocomplete()) ? "autocomplete=\"{$autocomplete}\"" : null !!}
            {!! $isAutofocused() ? 'autofocus' : null !!}
            {!! $isDisabled() ? 'disabled' : null !!}
            id="{{ $getId() }}"
            {!! ($inputMode = $getInputMode()) ? "inputmode=\"{$inputMode}\"" : null !!}
            {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : null !!}
            {!! ($interval = $getStep()) ? "step=\"{$interval}\"" : null !!}
            @if (! $isConcealed())
                {!! filled($length = $getMaxLength()) ? "maxlength=\"{$length}\"" : null !!}
                {!! filled($value = $getMaxValue()) ? "max=\"{$value}\"" : null !!}
                {!! filled($length = $getMinLength()) ? "minlength=\"{$length}\"" : null !!}
                {!! filled($value = $getMinValue()) ? "min=\"{$value}\"" : null !!}
                {!! $isRequired() ? 'required' : null !!}
            @endif
            {{ $getExtraInputAttributeBag()->class([
                'block w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70',
                'dark:bg-gray-700 dark:text-white dark:focus:border-primary-500' => config('forms.dark_mode'),
            ]) }}
            x-bind:class="{
                    'border-gray-300': ! (@js($getStatePath()) in $wire.__instance.serverMemo.errors),
                    'dark:border-gray-600': ! (@js($getStatePath())
            in $wire.__instance.serverMemo.errors) && @js(config('forms.dark_mode')),
                    'border-danger-600 ring-danger-600': (@js($getStatePath()) in $wire.__instance.serverMemo.errors),
                }"
            />
        </div>

        @if ($label = $getSuffixLabel())
            <span @class($affixLabelClasses)>
                {{ $label }}
            </span>
        @endif

        @if ($icon = $getSuffixIcon())
            <x-dynamic-component :component="$icon" class="w-5 h-5"/>
        @endif

        @if (($suffixAction = $getSuffixAction()) && (! $suffixAction->isHidden()))
            {{ $suffixAction }}
        @endif
    </div>

</x-dynamic-component>
