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
                    <!-- CustomerSearchButton -->
                    <x-input.search wire:model="search"/>
                    <!-- CustomerSearchButton -->
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage"/>
                        @can('customers.create')
                            <!-- CreateCustomerButton -->
                            <x-button.primary wire:click="create">Create Customer</x-button.primary>
                        @endcan
                    </div>
                </div>
            </div>

            <x-table>
                <x-slot name="head">
                    <x-table.heading align="middle">
                        <span class="sr-only">Sync required?</span>
                    </x-table.heading>
                    <x-table.heading sortable
                                     mult-column
                                     :direction="$sorts['company_name'] ?? null"
                                     wire:click="sortBy('company_name')">
                        Name
                    </x-table.heading>
                    <x-table.heading sortable
                                     multi-column
                                     :direction="$sorts['phone'] ?? null"
                                     wire:click="sortBy('phone')">
                        Phone
                    </x-table.heading>
                    <x-table.heading sortable
                                     multi-column
                                     :direction="$sorts['email'] ?? null"
                                     wire:click="sortBy('email')">
                        Email
                    </x-table.heading>
                    <x-table.heading sortable
                                     multi-column
                                     :direction="$sorts['active'] ?? null"
                                     wire:click="sortBy('active')">
                        Status
                    </x-table.heading>
                    <x-table.heading sortable
                                     multi-column
                                     :direction="$sorts['sync'] ?? null"
                                     wire:click="sortBy('sync')">
                        Sync
                    </x-table.heading>
                    <x-table.heading align="center">Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($customers as $customer)
                        <x-table.row>
                            <x-table.cell class="text-gray-900">
                                <div class="flex justify-center">
                                    @if($customer->needsSync())
                                        <x-icon.sync/>
                                    @endif
                                </div>
                            </x-table.cell>
                            <x-table.cell>{{ $customer->company_name }}</x-table.cell>
                            <x-table.cell>{{ $customer->phone }}</x-table.cell>
                            <x-table.cell>{{ $customer->email }}</x-table.cell>
                            <x-table.cell>
                                <x-active :value="$customer->active"/>
                            </x-table.cell>
                            <x-table.cell>
                                <x-active :value="$customer->sync"/>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex justify-center space-x-1">

                                    @can('show', $customer)
                                        <button
                                            title="View"
                                            class="hover:text-cyan-600"
                                            wire:click="view({{ $customer->id }})">
                                            <x-icon.view/>
                                        </button>
                                    @endcan

                                    @can('edit', $customer)
                                        <button
                                            title="Edit"
                                            class="hover:text-yellow-600"
                                            wire:click="edit({{ $customer->id }})">
                                            <x-icon.pencil/>
                                        </button>
                                    @endcan

                                    @can('delete', $customer)
                                        <button
                                            title="Delete"
                                            class="hover:text-red-600"
                                            wire:click="confirmDelete({{ $customer->id }})">
                                            <x-icon.trash/>
                                        </button>
                                    @endcan

                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="7" class="text-gray-500 text-center italic text-md">
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
                            <x-input.group for="company_name" label="Company name"
                                           :error="$errors->first('editing.company_name')">
                                <x-input.text wire:model="editing.company_name" placeholder="Company name"
                                              :has-error="$errors->has('editing.company_name')"/>
                            </x-input.group>
                            <x-input.group for="billing_address" label="Billing Address"
                                           :error="$errors->first('editing.billing_address')">
                                <div class="flex flex-col space-y-1">
                                    <x-input.text name="address" placeholder="Street Address"
                                                  wire:model="editing.billing_address"/>
                                    <div class="grid grid-cols-5 gap-x-1">
                                        <div class="col-span-3">
                                            <x-input.text name="suburb" placeholder="Suburb"
                                                          wire:model="editing.billing_suburb"/>
                                        </div>
                                        <x-input.text name="state" placeholder="State"
                                                      wire:model="editing.billing_state"/>
                                        <x-input.text name="postcode" placeholder="Postcode"
                                                      wire:model="editing.billing_postcode"/>
                                    </div>
                                </div>
                            </x-input.group>
                            <x-input.group for="first_name" label="Accounts Contact"
                                           :error="$errors->first('editing.first_name') || $errors->first('editing.last_name')">
                                <div class="flex space-x-2">
                                    <x-input.text name="first_name" wire:model="editing.first_name"
                                                  placeholder="First name"
                                                  :has-error="$errors->has('editing.first_name')"/>
                                    <x-input.text name="first_name" wire:model="editing.last_name"
                                                  placeholder="Last name"
                                                  :has-error="$errors->has('editing.last_name')"/>
                                </div>
                            </x-input.group>
                            <x-input.group for="phone" label="Phone" :error="$errors->first('editing.phone')">
                                <x-input.text wire:model="editing.phone" placeholder="Phone"
                                              :has-error="$errors->has('editing.phone')"/>
                            </x-input.group>
                            <x-input.group for="email" label="Email" :error="$errors->first('editing.email')">
                                <x-input.text wire:model="editing.email" placeholder="Email"
                                              :has-error="$errors->has('editing.email')"/>
                            </x-input.group>
                            <div class="flex space-x-4">
                                <x-input.group for="active" label="Active">
                                    <x-input.toggle-icon wire:model="editing.active"/>
                                </x-input.group>
                                <x-input.group for="sync" label="Sync">
                                    <x-input.toggle-icon wire:model="editing.sync"/>
                                </x-input.group>
                            </div>
                            <x-jet-validation-errors class="mb-4"/>
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
        </div>
    </div>
</div>
