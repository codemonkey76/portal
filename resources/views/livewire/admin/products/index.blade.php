<div class="px-4 sm:px-6 lg:px-8">
    <!-- Page Heading -->
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Products</h1>
            <p class="mt-2 text-sm text-gray-700">List of products.</p>
        </div>
    </div>
    <!-- Page Heading -->

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <!-- Command Bar -->
            <div class="md:px-6 lg:px-8 py-2">
                <div class="flex justify-between">
                    <!-- ProductSearchButton -->
                    <x-input.search wire:model="search" />
                    <!-- ProductSearchButton -->
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage" />
                        @can('items.create')
                            <!-- CreateProductButton -->
                            <x-button.primary wire:click="create">Create</x-button.primary>
                            <!-- CreateProductButton -->
                        @endcan
                    </div>
                </div>
            </div>
            <!-- Command Bar -->

            <!-- Table -->
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable multi-column :direction="$sorts['name'] ?? null" wire:click="sortBy('name')" class="pl-4 sm:pl-6 w-full">Name</x-table.heading>
                    <x-table.heading sortable multi-column :direction="$sorts['price'] ?? null" wire:click="sortBy('price')" class="pl-4 sm:pl-6">Price</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($products as $product)
                        <x-table.row>
                            <x-table.cell class="pl-4 sm:pl-6 text-gray-900">{{ $product->name }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $product->priceString }}</x-table.cell>
                            <x-table.cell>
                                @can('products.update')
                                    <!-- EditProductButton -->
                                    <x-small-button.warning wire:click="edit({{$product}})">Edit</x-small-button.warning>
                                    <!-- EditProductButton -->
                                @endcan
                                @can('products.destroy')
                                    <!-- DeleteProductButton -->
                                    <x-small-button.danger wire:click="confirmDelete({{$product}})">Delete</x-small-button.danger>
                                    <!-- DeleteProductButton -->
                                @endcan
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="4" class="text-gray-500 text-center italic text-md">
                                No products found
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            <!-- Table -->

            <div class=" md:px-6 lg:px-8">
                {{ $products->links() }}
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

                            <x-input.group for="item" label="Quickbooks Item" :error="$errors->first('editing.item_id')">
                                <x-select wire:model="editing.item_id" name="item">
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </x-select>
                            </x-input.group>

                            <div class="flex space-x-4">
                                <x-input.group for="price" label="Unit Price">
                                    <x-input.text leading-add-on="$" name="price" wire:model="editing.price" />
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
                <x-jet-confirmation-modal wire:model="showDeleteModal">
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
