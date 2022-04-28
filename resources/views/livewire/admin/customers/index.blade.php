<div class="px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-xl font-semibold text-gray-900">Customers</h1>
      <p class="mt-2 text-sm text-gray-700">A list of all the customers.</p>
    </div>
  </div>
  <div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="md:px-6 lg:px-8 py-2">
            <div class="flex justify-between">
                <x-input.search wire:model="search" />
                <div class="flex space-x-2">
                    <x-input.per-page :options="$perPageOptions" wire:model="perPage" />
                    @can('create customers')<x-button.primary wire:click="create">Create Customer</x-button.primary>@endcan
                </div>
            </div>
        </div>

        <x-table>
            <x-slot name="head">
                <x-table.heading sortable mult-column :direction="$sorts['company_name'] ?? null" wire:click="sortBy('company_name')">Name</x-table.heading>
                <x-table.heading sortable multi-column :direction="$sorts['phone'] ?? null" wire:click="sortBy('phone')">Phone</x-table.heading>
                <x-table.heading sortable multi-column :direction="$sorts['email'] ?? null" wire:click="sortBy('email')">Email</x-table.heading>
                <x-table.heading sortable multi-column :direction="$sorts['active'] ?? null" wire:click="sortBy('active')">Status</x-table.heading>
                <x-table.heading sortable multi-column :direction="$sorts['sync'] ?? null" wire:click="sortBy('sync')">Sync</x-table.heading>
                <x-table.heading>Actions</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse ($customers as $customer)
                    <x-table.row>
                        <x-table.cell>{{ $customer->company_name }}</x-table.cell>
                        <x-table.cell>{{ $customer->phone }}</x-table.cell>
                        <x-table.cell>{{ $customer->email }}</x-table.cell>
                        <x-table.cell><x-active :value="$customer->active" /></x-table.cell>
                        <x-table.cell><x-active :value="$customer->sync" /></x-table.cell>
                        <x-table.cell>
                            <x-small-button.primary wire:click="show({{$customer->id}})">View</x-small-button.primary>
                            @can('edit customers')<x-small-button.warning wire:click="edit({{$customer->id}})">Edit</x-small-button.warning>@endcan
                            @can('delete customers')<x-small-button.danger wire:click="confirmDelete({{$customer->id}})">Delete</x-small-button.danger>@endcan
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="6" class="text-gray-500 text-center italic text-md">
                            No customers found
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <div class="md:px-6 lg:px-8">
            {{ $customers->links() }}
        </div>

        <!-- Create Modal -->
        <form wire:submit.prevent="save">
            <x-jet-dialog-modal wire:model="showEditModal">
                <x-slot name="title">Edit Customer</x-slot>
                <x-slot name="content">
                    <div class="space-y-4">
                        <x-input.group for="company_name" label="Company name" :error="$errors->first('editing.company_name')">
                            <x-input.text wire:model="editing.company_name" placeholder="Company name" :has-error="$errors->has('editing.company_name')" />
                        </x-input.group>
                        <x-input.group for="fully_qualified_name" label="Fully qualified name" :error="$errors->first('editing.fully_qualified_name')">
                            <x-input.text wire:model="editing.fully_qualified_name" placeholder="Fully qualified name" :has-error="$errors->has('editing.fully_qualified_name')"/>
                        </x-input.group>
                        <x-input.group for="display_name" label="Display name" :error="$errors->first('editing.display_name')">
                            <x-input.text wire:model="editing.display_name" placeholder="Display name" :has-error="$errors->has('editing.display_name')"/>
                        </x-input.group>
                        <x-input.group for="first_name" label="Accounts Contact" :error="$errors->first('editing.first_name') . ' ' . $errors->first('editing.last_name')">
                            <div class="flex space-x-2">
                                <x-input.text name="first_name" wire:model="editing.first_name" placeholder="First name" :has-error="$errors->has('editing.first_name')"/>
                                <x-input.text name="first_name" wire:model="editing.last_name" placeholder="Last name" :has-error="$errors->has('editing.last_name')" />
                            </div>
                        </x-input.group>
                        <x-input.group for="phone" label="Phone" :error="$errors->first('editing.phone')">
                            <x-input.text wire:model="editing.phone" placeholder="Phone" :has-error="$errors->has('editing.phone')"/>
                        </x-input.group>
                        <x-input.group for="email" label="Email" :error="$errors->first('editing.email')">
                            <x-input.text wire:model="editing.email" placeholder="Email" :has-error="$errors->has('editing.email')"/>
                        </x-input.group>
                        <div class="flex space-x-4">
                            <x-input.group for="active" label="Active">
                                <x-input.toggle-icon wire:model="editing.active" />
                            </x-input.group>
                            <x-input.group for="sync" label="Sync">
                                <x-input.toggle-icon wire:model="editing.sync" />
                            </x-input.group>
                        </div>
                        <x-jet-validation-errors class="mb-4" />
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <div class="space-x-1">
                        <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                        <x-button.primary type="submit">Save</x-button.primary>
                    </div>
                </x-slot>
            </x-jet-dialog-modal>
        </form>
        <!-- Create Modal -->

        <!-- Edit Modal -->

        <!-- Edit Modal -->

        <!-- Delete Modal -->

        <!-- Delete Modal -->
    </div>
  </div>
</div>
