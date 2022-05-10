<div class="px-4 sm:px-6 lg:px-8">
    <!-- Page Heading -->
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Accounts</h1>
            <p class="mt-2 text-sm text-gray-700">List of accounts.</p>
        </div>
    </div>
    <!-- Page Heading -->

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <!-- Command Bar -->
            <div class="md:px-6 lg:px-8 py-2">
                <div class="flex justify-between">
                    <!-- AccountSearchButton -->
                    <x-input.search wire:model="search" />
                    <!-- AccountSearchButton -->
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage" />
                        @can('accounts.create')
                            <!-- CreateAccountsButton -->
                            <x-button.primary wire:click="create">Create</x-button.primary>
                            <!-- CreateAccountsButton -->
                        @endcan
                    </div>
                </div>
            </div>
            <!-- Command Bar -->

            <!-- Table -->
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable multi-column :direction="$sorts['qb_account_id'] ?? null" wire:click="sortBy('qb_account_id')" class="pl-4 sm:pl-6">ID</x-table.heading>
                    <x-table.heading sortable multi-column :direction="$sorts['name'] ?? null" wire:click="sortBy('name')" class="pl-4 sm:pl-6">Name</x-table.heading>
{{--                    <x-table.heading sortable multi-column :direction="$sorts['classification'] ?? null" wire:click="sortBy('classification')">Classification</x-table.heading>--}}
                    <x-table.heading sortable multi-column :direction="$sorts['account_type'] ?? null" wire:click="sortBy('account_type')">Type</x-table.heading>
                    <x-table.heading sortable multi-column :direction="$sorts['account_sub_type'] ?? null" wire:click="sortBy('account_sub_type')">Sub Type</x-table.heading>
                    <x-table.heading sortable multi-column :direction="$sorts['active'] ?? null" wire:click="sortBy('active')">Active</x-table.heading>
                    <x-table.heading sortable multi-column :direction="$sorts['sync'] ?? null" wire:click="sortBy('sync')">Sync</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($accounts as $account)
                        <x-table.row>
                            <x-table.cell class="pl-4 sm:pl-6 text-gray-900">{{ $account->qb_account_id }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ Str::of($account->name)->limit(30) }}</x-table.cell>
{{--                            <x-table.cell class="text-gray-900">{{ Str::of($account->classification)->limit(30) }}</x-table.cell>--}}
                            <x-table.cell class="text-gray-900">{{ Str::of($account->account_type)->limit(30) }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ Str::of($account->account_sub_type)->limit(30) }}</x-table.cell>
                            <x-table.cell class="text-gray-900"><x-active :value="$account->active" /></x-table.cell>
                            <x-table.cell class="text-gray-900"><x-active :value="$account->sync" /></x-table.cell>
                            <x-table.cell>
                                @can('accounts.update')
                                    <!-- EditAccountButton -->
                                    <x-small-button.warning wire:click="edit({{$account->id}})">Edit</x-small-button.warning>
                                    <!-- EditAccountButton -->
                                @endcan
                                @can('accounts.destroy')
                                    <!-- DeleteAccountButton -->
                                    <x-small-button.danger wire:click="confirmDelete({{$account->id}})">Delete</x-small-button.danger>
                                    <!-- DeleteAccountButton -->
                                @endcan
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6" class="text-gray-500 text-center italic text-md">
                                No accounts found
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            <!-- Table -->

            <div class=" md:px-6 lg:px-8">
                {{ $accounts->links() }}
            </div>

            <!-- AccountEditModal -->
            <form wire:submit.prevent="save">
                <x-jet-dialog-modal wire:model="showEditModal">
                    <x-slot name="title">Edit Account</x-slot>
                    <x-slot name="content">
                        <div class="space-y-4">
                            <x-input.group for="name" label="Account name" :error="$errors->first('editing.name')">
                                <x-input.text wire:model="editing.name" placeholder="Name" :has-error="$errors->has('editing.name')" />
                            </x-input.group>
                            <x-input.group for="description" label="Description" :error="$errors->first('editing.description')">
                                <x-input.text wire:model="editing.description" placeholder="Description" :has-error="$errors->has('editing.description')" />
                            </x-input.group>
                            <x-input.group for="account_classification" label="Classification">
                                <label class="flex-1 min-w-0 block w-full px-3 py-2 sm:text-sm rounded-md border border-gray-300 bg-gray-100">{{ $classification }}</label>
                            </x-input.group>
                            <x-input.group for="account_type" label="Type" :error="$errors->first('account_type')">
                                <x-select wire:model="account_type" :has-error="$errors->has('account_type')">
                                    @forelse($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @empty
                                    @endforelse
                                </x-select>
                            </x-input.group>

                            <x-input.group for="account_sub_type" label="Sub Type" :error="$errors->first('account_sub_type')">
                                <x-select wire:model="account_sub_type" :has-error="$errors->has('account_sub_type')">
                                    @forelse($sub_types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @empty
                                    @endforelse
                                </x-select>
                            </x-input.group>
                            <div class="flex space-x-4">
                                <x-input.group for="active" label="Active">
                                    <x-input.toggle-icon wire:model="editing.active" />
                                </x-input.group>
                                <x-input.group for="sync" label="Sync">
                                    <x-input.toggle-icon wire:model="editing.sync" />
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
