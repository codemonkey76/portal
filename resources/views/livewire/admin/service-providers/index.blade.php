<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Service Providers</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the service providers.</p>
        </div>
    </div>
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="md:px-6 lg:px-8 py-2">
                <div class="flex justify-between">
                    <x-input.search wire:model="search" />
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage" />
                        @can('service-providers.create')<x-button.primary wire:click="create">New Provider</x-button.primary>@endcan
                    </div>
                </div>
            </div>

            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable multi-column>Name</x-table.heading>
                    <x-table.heading sortable multi-column>Type</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($providers as $provider)
                        <x-table.row>
                            <x-table.cell>{{ $provider->name }}</x-table.cell>
                            <x-table.cell>{{ $provider->type }}</x-table.cell>
                            <x-table.cell>
                                @can('service-providers.update')<x-small-button.warning>Edit</x-small-button.warning>@endcan
                                @can('service-providers.destroy')<x-small-button.danger wire:click="confirmDelete({{ $provider->id }})">Delete</x-small-button.danger>@endcan
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="3" class="text-gray-500 text-center italic text-md">
                                No providers found
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>
    </div>
</div>
