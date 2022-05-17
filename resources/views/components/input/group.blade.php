@props([
'label',
'for',
'error' => false,
'helpText' => false,
'inline' => true,
'paddingless' => false,
'borderless' => false,
])

@if($inline)
    <div {{ $attributes }}>
        <label for="{{ $for }}" class="block text-sm font-medium leading-5 {{ $error ? 'text-red-500 font-semibold' : 'text-gray-700' }}">{{ $label }}</label>

        <div class="mt-1 relative">
            {{ $slot }}

            @if ($error)
                <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
            @endif

            @if ($helpText)
                <p class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
            @endif
        </div>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start' . ($borderless ? '' : ' sm:border-t ') . ' sm:border-gray-200 ' . ($paddingless ? '' : ' sm:py-5 ')]) }}>
        <label for="{{ $for }}" class="block text-sm font-medium leading-5 sm:mt-px sm:pt-2 {{ $error ? 'text-red-500 font-semibold' : 'text-gray-700' }}">
            {{ $label }}
        </label>

        <div class="mt-1 sm:mt-0 sm:col-span-2">
            {{ $slot }}

            @if ($error)
                <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
            @endif

            @if ($helpText)
                <p class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
            @endif
        </div>
    </div>
@endif
