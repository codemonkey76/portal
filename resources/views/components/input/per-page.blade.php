@props(['options' => []])
<x-input.group :inline="false" borderless paddingless for="perPage" label="Per Page">
    <x-input.select :options="$options" {{ $attributes->whereStartsWith('wire:model') }} id="perPage" />
</x-input.group>