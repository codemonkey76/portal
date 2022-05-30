<div class="px-4 sm:px-6 lg:px-8">
    <!-- Page Heading -->
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Items</h1>
            <p class="mt-2 text-sm text-gray-700">List of items.</p>
        </div>
    </div>
    <!-- Page Heading -->

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <!-- Command Bar -->
            <div class="md:px-6 lg:px-8 py-2">
                <div class="flex justify-between">
                    <!-- ItemSearchButton -->
                    <x-input.search wire:model="search" />
                    <!-- ItemSearchButton -->
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage" />
                        @can('items.create')
                            <!-- CreateItemButton -->
                            <x-button.primary wire:click="create">Create</x-button.primary>
                            <!-- CreateItemButton -->
                        @endcan
                    </div>
                </div>
            </div>
            <!-- Command Bar -->

            <!-- Table -->
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable multi-column :direction="$sorts['name'] ?? null" wire:click="sortBy('name')" class="pl-4 sm:pl-6">Name</x-table.heading>
                    <x-table.heading sortable multi-column :direction="$sorts['description'] ?? null" wire:click="sortBy('description')">Description</x-table.heading>
                    <x-table.heading sortable multi-column :direction="$sorts['type'] ?? null" wire:click="sortBy('type')">Type</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($items as $item)
                        <x-table.row>
                            <x-table.cell class="pl-4 sm:pl-6 text-gray-900">
                                {{ $item->name }}
                            </x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $item->description }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $item->type }}</x-table.cell>
                            <x-table.cell>
                                @can('items.update')
                                    <!-- EditItemButton -->
                                    <x-small-button.warning wire:click="edit({{$item->id}})">Edit</x-small-button.warning>
                                    <!-- EditItemButton -->
                                @endcan
                                @can('items.destroy')
                                    <!-- DeleteItemButton -->
                                    <x-small-button.danger wire:click="confirmDelete({{$item->id}})">Delete</x-small-button.danger>
                                    <!-- DeleteItemButton -->
                                @endcan
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="4" class="text-gray-500 text-center italic text-md">
                                No items found
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            <!-- Table -->

            <div class=" md:px-6 lg:px-8">
                {{ $items->links() }}
            </div>

            <!-- ProductEditModal -->
            <form wire:submit.prevent="save">
                <x-jet-dialog-modal wire:model="showEditModal">
                    <x-slot name="title">Edit Product</x-slot>
                    <x-slot name="content">
                        <div class="space-y-4">
                            <x-input.group for="name" label="Product name" :error="$errors->first('editing.name')">
                                <x-input.text wire:model="editing.name" placeholder="Name" :has-error="$errors->has('editing.name')" />
                            </x-input.group>
                            <x-input.group for="description" label="Description" :error="$errors->first('editing.description')">
                                <x-input.text wire:model="editing.description" placeholder="Description" :has-error="$errors->has('editing.description')" />
                            </x-input.group>
                            <x-input.group for="type" label="Type" :error="$errors->first('editing.type')">
                                <x-select wire:model="editing.type" :has-error="$errors->has('editing.type')">
                                    @foreach($types as $type)
                                        <option>{{ $type }}</option>
                                    @endforeach
                                </x-select>
                            </x-input.group>


                                <div class="flex space-x-4">
                                    <x-input.group for="active" label="Active">
                                        <x-input.toggle-icon name="active" wire:model="editing.active" />
                                    </x-input.group>
                                    <x-input.group for="taxable" label="Taxable">
                                        <x-input.toggle-icon name="taxable" wire:model="editing.taxable" />
                                    </x-input.group>
                                    <x-input.group for="sync" label="Sync">
                                        <x-input.toggle-icon name="sync" wire:model="editing.sync" />
                                    </x-input.group>
                                </div>

                                <div class="flex space-x-4">
                                    <x-input.group for="unit_price" label="Unit Price">
                                        <x-input.text name="unit_price" wire:model="editing.unit_price" />
                                    </x-input.group>
                                    <x-input.group for="sales_tax_included" label="Tax inc.">
                                        <x-input.toggle-icon name="sales_tax_included" wire:model="editing.sales_tax_included" />
                                    </x-input.group>
                                </div>
                                <div class="flex space-x-4">
                                    <x-input.group for="qty_on_hand" label="On Hand">
                                        <x-input.text name="qty_on_hand" wire:model="editing.qty_on_hand" />
                                    </x-input.group>
                                    <x-input.group for="track_qty" label="Track Qty">
                                        <x-input.toggle-icon name="track_qty" wire:model="editing.track_qty_on_hand" />
                                    </x-input.group>
                                </div>
                            </div>

                            <x-jet-validation-errors class="mb-4" />

                    </x-slot>
                    <x-slot name="footer">
                        <div class="space-x-1">
                            <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                            <x-button.primary type="submit">Save</x-button.primary>
                        </div>
                    </x-slot>
                </x-jet-dialog-modal>
            </form>
            <!-- ProductEditModal -->

            <!-- ProductDeleteModal -->
            <form wire:submit.prevent="delete">
                <x-jet-confirmation-modal wire:model="showDeleteConfirmation">
                    <x-slot name="title">Delete product</x-slot>
                    <x-slot name="content">Are you sure you want to delete this product, this action is irreversible.</x-slot>
                    <x-slot name="footer">
                        <div class="flex space-x-2">
                            <x-button.secondary wire:click="cancelDelete">Cancel</x-button.secondary>
                            <x-button.danger type="submit">Delete</x-button.danger>
                        </div>
                    </x-slot>
                </x-jet-confirmation-modal>
            </form>
            <!-- ProductDeleteModal -->
        </div>
    </div>
</div>
