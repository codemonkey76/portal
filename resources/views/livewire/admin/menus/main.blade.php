<div>
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <!-- Command Bar -->
            <div class="md:px-6 lg:px-8 py-2">
                <div class="flex justify-between">
                    <div class="flex items-center space-x-2">
                        <h1 class="text-xl font-semibold">Main Menus</h1>
                        <x-input.search wire:model="search" />
                    </div>
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage" />
                        @can('create menus')<x-button.primary wire:click="create">Create</x-button.primary>@endcan
                    </div>
                </div>
            </div>
            <!-- Command Bar -->

            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pl-4 sm:pl-6">Icon</x-table.heading>
                    <x-table.heading>Label</x-table.heading>
                    <x-table.heading>Route</x-table.heading>
                    <x-table.heading>Permission</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($items as $item)
                        <x-table.row>
                            <x-table.cell class="pl-4 sm:pl-6 text-gray-900">
                                <svg
                                    class="mr-3 h-6 w-6 fill-current"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    {!! $item->icon !!}
                                </svg>
                            </x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $item->label }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $item->route }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $item->permission_required }}</x-table.cell>
                            <x-table.cell>
                                @can('edit menus')<x-small-button.warning wire:click="edit({{$item}})">Edit</x-small-button.warning>@endcan
                                @can('delete menus')<x-small-button.danger wire:click="delete({{$item}})">Delete</x-small-button.danger>@endcan
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="5" class="text-gray-500 text-center italic text-md">
                                No invitations found
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            <div class=" md:px-6 lg:px-8">
                {{ $items->links() }}
            </div>
        </div>
    </div>
    <form wire:submit.prevent="save">
        <x-jet-dialog-modal wire:model="showEditModal">
            <x-slot name="title">Edit Menu</x-slot>
            <x-slot name="content">
                <x-jet-validation-errors class="mb-4" />
                <div class="flex flex-col space-y-2">
                    <x-input.group for="label" label="Label" :error="$errors->first('editing.label')">
                        <x-input.text name="label" wire:model="editing.label" :has-error="$errors->has('editing.label')" />
                    </x-input.group>
                    <x-input.group for="route" label="Route" :error="$errors->first('editing.route')">
                        <x-select wire:model="editing.route" :has-error="$errors->has('editing.route')">
                            @foreach($routes as $route)
                                <option>{{ $route }}</option>
                            @endforeach
                        </x-select>
                    </x-input.group>
                    <x-input.group for="permission" label="Permission" :error="$errors->first('editing.permission_required')">
                        <x-select wire:model="editing.permission_required" :has-error="$errors->has('editing.permission_required')">
                            @foreach($permissions as $permission)
                                <option>{{ $permission }}</option>
                            @endforeach
                        </x-select>
                    </x-input.group>
                    <x-input.group for="icon" label="Icon" :error="$errors->first('editing.icon')">
                        <x-input.textarea rows="6" name="icon" wire:model="editing.icon" :has-error="$errors->has('editing.icon')" />
                    </x-input.group>
                    <x-input.group for="icon-preview" label="Icon Preview">
                        {!! $editing->icon !!}
                    </x-input.group>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="flex space-x-2">
                    <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                    <x-button.primary type="submit">Save</x-button.primary>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>
