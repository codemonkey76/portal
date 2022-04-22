<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Users</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
        </div>
    </div>
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">

            <div class="md:px-6 lg:px-8 py-2">
                <div class="flex justify-between">
                    <x-input.search wire:model="search" />
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage" />
                        <x-button.primary wire:click="create">Add user</x-button.primary>
                    </div>
                </div>
            </div>

            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable :direction="$sorts['name'] ?? null" wire:click="sortBy('name')" class="pl-4 sm:pl-6">Name</x-table.heading>
                    <x-table.heading>Customer</x-table.heading>
                    <x-table.heading sortable :direction="$sorts['active'] ?? null" wire:click="sortBy('active')">Status</x-table.heading>
                    <x-table.heading>Role</x-table.heading>
                    <x-table.heading><span class="sr-only">Edit</span></x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($users as $user)
                    <x-table.row>
                        <x-table.cell class="pl-4 sm:pl-6">
                            <div class="flex items-center">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="Profile photo">
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </x-table.cell>
                        <x-table.cell>
                            <div class="text-gray-900">{{ $user->primary_customer?->company_name ?? 'No assigned customer' }}</div>
                            <div class="text-gray-500">{{ $user->primary_customer?->phone ?? '' }}</div>
                        </x-table.cell>
                        <x-table.cell>
                            <x-active :value="$user->active" />
                        </x-table.cell>
                        <x-table.cell class="text-gray-500 space-x-1">
                            @foreach ($user->roles as $role)
                            <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">{{ $role->name }}</span>
                            @endforeach
                        </x-table.cell>
                        <x-table.cell>
                            @can('edit users')<x-small-button.warning wire:click="edit({{$user->id}})">Edit</x-small-button.warning>@endcan
                            @can('delete users')<x-small-button.danger wire:click="confirmDelete({{$user->id}})">Delete</x-small-button.danger>@endcan
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="5" class="text-gray-500 text-center italic text-md">
                            No users found
                        </x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div class=" md:px-6 lg:px-8">
                {{ $users->links() }}
            </div>

            <!-- Edit Modal -->
            @if($editing)
            <form wire:submit.prevent="save">
                <x-jet-dialog-modal wire:model="showEditModal">
                    <x-slot name="title">Edit User</x-slot>
                    <x-slot name="content">
                        <h3 class="text-lg font-semibold text-gray-900">User: {{ $editing->name }} ({{ $editing->email }})</h3>
                        <div class="space-y-4 divide-y divide-gray-300">
                            <div>
                                <p class="my-2 text-md text-gray-900">Select the users default customer.</p>
                                <x-input.group for="primary_customer_id" label="Primary customer" :error="$errors->first('editing.primary_customer_id')">
                                    <x-select name="primary_customer_id" wire:model="editing.primary_customer_id" :has-error="$errors->has('editing.primary_customer_id')">
                                        @foreach($editing->customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                                        @endforeach
                                    </x-select>
                                </x-input.group>
                            </div>

                            <!-- Customer assignment controls -->
                            <div>
                                <p class="my-2 text-md text-gray-900">Assign the customers that this user needs to manage.</p>
                                <div class="grid grid-cols-5 gap-4">
                                    <x-input.group for="customer_list" label="Customer list" class="col-span-2">
                                        <x-select name="customer_list" size="5" multiple :has-empty-option="false" wire:model="customersToAssign">
                                            @foreach($this->availableCustomers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                                            @endforeach
                                        </x-select>
                                    </x-input.group>

                                    <div class="flex flex-col space-y-2 items-center justify-center">
                                        @can('change user customer assignments')
                                        <x-small-button.primary wire:click="assignCustomerToUser" :disabled="empty($this->customersToAssign)">
                                            <div class="flex space-x-2 items-center">
                                                <span>Add</span>
                                                <x-icon.right />
                                            </div>
                                        </x-small-button.primary>
                                        <x-small-button.primary wire:click="unassignCustomerFromUser" :disabled="empty($this->customersToUnassign)">
                                            <div class="flex space-x-2 items-center">
                                                <span>Remove</span>
                                                <x-icon.left />
                                            </div>
                                        </x-small-button.primary>
                                        @endcan
                                    </div>
                                    <x-input.group for="assigned_customers" label="Assigned customers" class="col-span-2">
                                        <x-select size="5" multiple :has-empty-option="false" wire:model="customersToUnassign">
                                            @foreach($editing->customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                                            @endforeach
                                        </x-select>
                                    </x-input.group>
                                </div>
                                <x-jet-action-message class="mr-3" on="assignedCustomersChanged">
                                    {{ __('Assigned customers updated.') }}
                                </x-jet-action-message>
                            </div>
                            <!-- Customer assignment controls -->

                            <!-- Role assignment controls -->
                            <div>
                                <p class="my-2 text-md text-gray-900">Assign the roles required by this user.</p>

                                <div class="grid grid-cols-5 gap-4">
                                    <x-input.group for="role_list" label="Available roles" class="col-span-2">
                                        <x-select name="role_list" size="5" multiple :has-empty-option="false" wire:model="rolesToAdd">
                                            @foreach($this->availableRoles as $role)
                                            <option>{{ $role->name }}</option>
                                            @endforeach
                                        </x-select>
                                    </x-input.group>
                                    <div class="flex flex-col space-y-2 items-center justify-center">
                                        @can('change user role assignments')
                                        <x-small-button.primary wire:click="addRolesToUser" :disabled="empty($this->rolesToAdd)">
                                            <div class="flex space-x-2 items-center">
                                                <span>Add</span>
                                                <x-icon.right />
                                            </div>
                                        </x-small-button.primary>
                                        <x-small-button.primary wire:click="removeRolesFromUser" :disabled="empty($this->rolesToRemove)">
                                            <div class="flex space-x-2 items-center">
                                                <span>Remove</span>
                                                <x-icon.left />
                                            </div>
                                        </x-small-button.primary>
                                        @endcan
                                    </div>
                                    <x-input.group for="assigned_roles" label="Assigned roles" class="col-span-2">
                                        <x-select name="assigned_roles" size="5" multiple :has-empty-option="false" wire:model="rolesToRemove">
                                            @foreach($this->editing->roles as $role)
                                            <option>{{ $role->name }}</option>
                                            @endforeach
                                        </x-select>
                                    </x-input.group>
                                </div>
                                <x-jet-action-message class="mr-3" on="assignedRolesChanged">
                                    {{ __('Assigned roles updated.') }}
                                </x-jet-action-message>
                            </div>
                            <!-- Role assignment controls -->
                            <div>
                                <p class="my-2 text-md text-gray-900">Only active users can login.</p>
                                <x-input.group for="active" label="Active?">
                                    <x-input.toggle-icon wire:model="editing.active" />
                                </x-input.group>
                            </div>
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
            @endif
            <!-- Edit Modal -->

            <!-- Delete Modal -->
            <form wire:submit.prevent="delete">
                <x-jet-confirmation-modal wire:model="showDeleteModal">
                    <x-slot name="title">Delete User</x-slot>
                    <x-slot name="content">Are you sure you want to delete this user, this acction is irreversible?</x-slot>
                    <x-slot name="footer">
                        <div class="space-x-1">
                            <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>
                            <x-button.danger type="submit">Delete</x-button.primary>
                        </div>
                    </x-slot>
                </x-jet-confirmation-modal>
            </form>
            <!-- Delete Modal -->
        </div>
    </div>
</div>