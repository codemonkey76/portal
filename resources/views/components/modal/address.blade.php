@props([
    'id' => null,
    'maxWidth' => null,
    'title' => 'Edit Address'
    ])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        <div class="flex space-x-2">
            <x-button.secondary>Cancel</x-button.secondary>
            <x-button.primary>Save</x-button.primary>
        </div>
    </div>
</x-jet-modal>
