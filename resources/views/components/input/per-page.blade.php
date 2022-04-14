@props(['options' => []])
<x-input.group :inline="false" borderless paddingless for="perPage" label="Per Page">
    <x-select {{ $attributes->whereStartsWith('wire:model') }} id="perPage" :has-empty-option="false">
        @foreach($options as $option => $key)
            <option value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </x-select>
</x-input.group>
