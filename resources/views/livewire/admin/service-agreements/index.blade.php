<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Service Agreements</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the service agreements.</p>
        </div>
    </div>
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="md:px-6 lg:px-8 py-2">
                <div class="flex justify-between">
                    <x-input.search wire:model="search"/>
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage"/>
                        @can('service-agreements.create')
                            <x-button.primary wire:click="create">Create Agreement</x-button.primary>
                        @endcan
                    </div>
                </div>
            </div>
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable multi-column>Date</x-table.heading>
                    <x-table.heading sortable multi-column>Term</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('customers.company_name')">Customer
                    </x-table.heading>
                    <x-table.heading sortable multi-column>Frequency</x-table.heading>
                    <x-table.heading sortable multi-column>Amount</x-table.heading>
                    <x-table.heading sortable multi-column>Status</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($agreements as $agreement)
                        <x-table.row>
                            <x-table.cell>{{ $agreement->created_at->format('d/m/Y') }}</x-table.cell>
                            <x-table.cell>{{ $agreement->termString }}</x-table.cell>
                            <x-table.cell>{{ $agreement->customer->company_name }}</x-table.cell>
                            <x-table.cell>{{ $agreement->frequencyString }}</x-table.cell>
                            <x-table.cell>{{ $agreement->amountString }}</x-table.cell>
                            <x-table.cell>
                                <x-state-bubble :color="$agreement->statusColor">{{ Str::of($agreement->status)->title() }}</x-state-bubble>
                            </x-table.cell>
                            <x-table.cell>
                                @can('activate', $agreement)<x-small-button.primary wire:click="confirmActivate({{ $agreement->id }})">Activate</x-small-button.primary>@endcan
                                @can('update', $agreement)<x-small-button.warning wire:click="edit({{ $agreement->id }})">Edit</x-small-button.warning>@endcan
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="7" class="text-gray-500 text-center italic text-md">
                                No agreements found
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>
    </div>
    <!-- Activate Modal -->
    <form wire:submit.prevent="activate">
        <x-modal.dialog wire:model="showActivateModal">
            <x-slot name="title">Activate Agreement</x-slot>
            <x-slot name="content">
                <x-input.group for="start_date" label="Activation Date">
                    <x-input.text type="date" wire:model="activationDate" />
                </x-input.group>
                <x-jet-validation-errors />
            </x-slot>
            <x-slot name="footer">
                <div class="flex space-x-2">
                    <x-button.secondary wire:model="$set('showActivateModal', false)">Cancel</x-button.secondary>
                    <x-button.primary type="submit">Save</x-button.primary>
                </div>
            </x-slot>
        </x-modal.dialog>
    </form>
    <!-- Activate Modal -->
    <div class="bg-yellow-100 bg-green-100 bg-blue-100 bg-red-100 bg-violet-100 bg-cyan-100 bg-gray-100 text-yellow-800 text-green-800 text-blue-800 text-red-800 text-violet-800 text-cyan-800 text-gray-800"></div>
</div>
