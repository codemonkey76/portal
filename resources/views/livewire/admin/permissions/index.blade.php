<div class="px-4 sm:px-6 lg:px-8">
    <!-- Page Heading -->
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Permissions and roles</h1>
            <p class="mt-2 text-sm text-gray-700">List of roles.</p>
        </div>
    </div>
    <!-- Page Heading -->

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <!-- Command Bar -->
            <div class="md:px-6 lg:px-8 py-2">
                <div class="flex justify-between">
                    <x-input.search wire:model="search" />
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage" />
                        @can('create roles')<x-button.primary wire:click="create">Create</x-button.primary>@endcan
                    </div>
                </div>
            </div>
            <!-- Command Bar -->

            <!-- Table -->
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pl-4 sm:pl-6">Role Name</x-table.heading>
                    <x-table.heading>Users</x-table.heading>
                    <x-table.heading>Permissions</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($roles as $role)
                    <x-table.row>
                        <x-table.cell class="pl-4 sm:pl-6 text-gray-900">
                            {{ $role->name }}
                        </x-table.cell>
                        <x-table.cell class="text-gray-900">{{ $role->users_count }}</x-table.cell>
                        <x-table.cell class="text-gray-900">{{ $role->permissions_count }}</x-table.cell>
                        <x-table.cell>
                            @can('edit roles')<x-small-button.warning wire:click="edit({{$role}})">Edit</x-small-button.warning>@endcan
                            @can('delete roles')<x-small-button.danger wire:click="confirmDelete({{$role}})">Delete</x-small-button.danger>@endcan
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="5" class="text-gray-500 text-center italic text-md">
                            No roles found
                        </x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            <!-- Table -->

            <div class=" md:px-6 lg:px-8">
                {{ $roles->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Denied Modal -->
    <x-jet-dialog-modal wire:model="showDeleteDeniedModal">
        <x-slot name="title">Delete unavailable</x-slot>
        <x-slot name="content">You cannot delete this role, there are currently users assigned to it.</x-slot>
        <x-slot name="footer">
            <x-button.primary wire:click="$set('showDeleteDeniedModal', false)">OK</x-button.primary>
        </x-slot>
    </x-jet-dialog-modal>
    <!-- Delete Denied Modal -->

    <!-- Delete Confirmation Modal -->
    <form wire:submit.prevent="delete">
        <x-jet-confirmation-modal wire:model="showDeleteConfirmation">
            <x-slot name="title">Are you sure you?</x-slot>
            <x-slot name="content">You won't be able to reverse this action</x-slot>
            <x-slot name="footer">
                <div class="flex space-x-2">
                    <x-button.secondary wire:click="$set('showDeleteConfirmation', false)">Cancel</x-button.secondary>
                    <x-button.danger type="submit">Delete</x-button.danger>
                </div>
            </x-slot>
        </x-jet-confirmation-modal>
    </form>
    <!-- Delete Confirmation Modal -->

    <!-- Create Modal -->
    @if($creating)
    <form wire:submit.prevent="save">
        <x-jet-dialog-modal wire:model="showCreateModal">
            <x-slot name="title">Create Role</x-slot>
            <x-slot name="content">
                <x-input.group for="name" label="Name" :error="$errors->first('creating.name')">
                    <x-input.text name="name" wire:model="creating.name" :has-error="$errors->has('creating.name')" />
                </x-input.group>
            </x-slot>
            <x-slot name="footer">
                <div class="flex space-x-2">
                    <x-button.secondary wire:click="$set('showCreateModal', false)">Cancel</x-button.secondary>
                    <x-button.primary type="submit">Save</x-button.primary>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
    @endif
    <!-- Create Modal -->

    <!-- Edit Modal -->
    @if($editing)
    <x-jet-dialog-modal wire:model="showEditModal">
        <x-slot name="title">Edit Role</x-slot>
        <x-slot name="content">
            <div class="flex flex-col space-y-4">
                <h1 class="text-xl font-semibold text-gray-900">Role: <span>{{ $this->editing->name }}</h1>
                <p class="mt-2 text-sm text-gray-700">Choose what permissions apply to this role and what users are assigned.</p>
                <x-input.group for="permissions" label="Permissions">
                    <div class="flex space-x-2">
                        <x-select size="5" multiple :has-empty-option="false" wire:model="permissionsToAdd">
                            @foreach($this->availablePermissions as $permission)
                                <option>{{ $permission->name }}</option>
                            @endforeach
                        </x-select>
                        <div class="flex flex-col space-y-2 items-center justify-center">
                            <x-small-button.primary wire:click="addPermissionsToRole" :disabled="empty($this->permissionsToAdd)">
                                <div class="flex space-x-2 items-center">
                                    <span>Add</span>
                                    <x-icon.right />
                                </div>
                            </x-small-button.primary>
                            <x-small-button.primary wire:click="removePermissionsFromRole" :disabled="empty($this->permissionsToRemove)">
                                <div class="flex space-x-2 items-center">
                                    <span>Remove</span>
                                    <x-icon.left />
                                </div>
                            </x-small-button.primary>
                        </div>
                        <x-select size="5" multiple :has-empty-option="false" wire:model="permissionsToRemove">
                            @foreach($editing->permissions as $permission)
                                <option>{{ $permission->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <x-jet-action-message class="mr-3" on="permissionChanged">
                        {{ __('Permission updated.') }}
                    </x-jet-action-message>
                </x-input.group>

                <x-input.group for="users" label="Users">
                    <div class="flex space-x-2">
                        <x-select size="5" multiple :has-empty-option="false" wire:model="usersToAdd">
                            @foreach($this->availableUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </x-select>
                        <div class="flex flex-col space-y-2 items-center justify-center">
                            <x-small-button.primary wire:click="addUsersToRole" :disabled="empty($this->usersToAdd)">
                                <div class="flex space-x-2 items-center">
                                    <span>Add</span>
                                    <x-icon.right />
                                </div>
                            </x-small-button.primary>
                            <x-small-button.primary wire:click="removeUsersFromRole" :disabled="empty($this->usersToRemove)">
                                <div class="flex space-x-2 items-center">
                                    <span>Remove</span>
                                    <x-icon.left />
                                </div>
                            </x-small-button.primary>
                        </div>
                        <x-select size="5" multiple :has-empty-option="false" wire:model="usersToRemove">
                            @foreach($editing->users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <x-jet-action-message class="mr-3" on="usersChanged">
                        {{ __('Users updated.') }}
                    </x-jet-action-message>
                </x-input.group>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button.primary wire:click="$set('showEditModal', false)">Close</x-button.primary>
        </x-slot>
    </x-jet-dialog-modal>
    @endif
    <!-- Edit Modal -->

</div>
