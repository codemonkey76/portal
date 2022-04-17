@props([
    'hasError' => false,
    'rows' => 4
])
<textarea rows="{{ $rows }}" {{ $attributes->merge(['class' => 'shadow-sm block w-full sm:text-sm border-gray-300 rounded-md' . ($hasError ? 'focus:ring-red-500 focus:border-red-500' : 'focus:ring-indigo-500 focus:border-indigo-500')]) }}></textarea>
