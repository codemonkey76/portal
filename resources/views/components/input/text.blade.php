@props([
'leadingAddOn' => false,
'hasError' => false,
'type' => 'text'
])
<div>
    <div class="mt-1 flex rounded-md shadow-sm">
        @if ($leadingAddOn)
            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 bg-gray-50 text-gray-500 sm:text-sm {{ $hasError ? 'border-red-500': 'border-gray-300' }}">
                {{ $leadingAddOn }}
            </span>
        @endif
            <input type="{{ $type }}" {{ $attributes->merge(['class' => 'flex-1 min-w-0 block w-full px-3 py-2 sm:text-sm' . ($leadingAddOn ? ' rounded-none rounded-r-md' : ' rounded-md') . ($hasError ? ' border-red-500 focus:ring-red-500 focus:border-red-500 placeholder-red-500' : ' border-gray-300 focus:ring-indigo-500 focus:border-indigo-500')]) }}>
    </div>
</div>