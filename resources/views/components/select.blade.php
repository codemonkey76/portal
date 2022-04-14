@props([
    'hasError' => false,
    'emptyOption' => 'Make a selection',
    'hasEmptyOption' => true

])
<select
    name="customer_id" {{ $attributes->merge(['class' => 'block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md'. ($hasError ? ' border-red-500 focus:ring-red-500 focus:border-red-500 placeholder-red-500' : ' border-gray-300 focus:ring-indigo-500 focus:border-indigo-500')]) }}>
    @if ($hasEmptyOption)
        <option selected value>{{ $emptyOption }}</option>
    @endif
    {{ $slot }}
</select>
