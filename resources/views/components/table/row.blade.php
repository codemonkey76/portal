@props([
    'overrideColor' => false
])
<tr {{ $attributes->merge(['class' => (!$overrideColor) ? 'odd:bg-white even:bg-gray-50' : '']) }}>
    {{ $slot }}
</tr>
