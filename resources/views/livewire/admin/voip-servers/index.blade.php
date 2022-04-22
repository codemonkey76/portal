<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">VOIP Servers</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the servers that will be queried for calls.</p>
        </div>
    </div>
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="md:px-6 lg:px-8 py-2">
                <div class="flex justify-between">
                    <x-input.search wire:model="search" />
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage" />
                        @can('create voip servers')<x-button.primary wire:click="create">Add server</x-button.primary>@endcan
                    </div>
                </div>
            </div>

            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable multi-column :direction="$sorts['name'] ?? null" wire:click="sortBy('name')">Name</x-table.heading>
                    <x-table.heading sortable multi-column :direction="$sorts['server_url'] ?? null" wire:click="sortBy('server_url')">Server URL</x-table.heading>
                    <x-table.heading sortable multi-column :direction="$sorts['api_user'] ?? null" wire:click="sortBy('api_user')">API User</x-table.heading>
                    <x-table.heading sortable multi-column :direction="$sorts['active'] ?? null" wire:click="sortBy('active')">Status</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @forelse($voip_servers as $voip_server)
                    <x-table.row>
                        <x-table.cell>{{ $voip_server->name }}</x-table.cell>
                        <x-table.cell>{{ Str::of($voip_server->server_url)->limit(50) }}</x-table.cell>
                        <x-table.cell>{{ $voip_server->api_user}}</x-table.cell>
                        <x-table.cell><x-active :value="$voip_server->active" /></x-table.cell>
                        <x-table.cell>
                            @can('edit voip servers')<x-small-button.warning wire:click="edit({{$voip_server->id}})">Edit</x-small-button.warning>@endcan
                            @can('delete voip servers')<x-small-button.danger wire:click="confirmDelete({{$voip_server->id}})">Delete</x-small-button.danger>@endcan
                        </x-table.cell>

                    </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="5" class="text-gray-500 text-center italic text-md">
                                No VOIP servers available
                            </x-table.cell>
                        </x-table.row>
                    @endforelse

                </x-slot>

            </x-table>
            <div class=" md:px-6 lg:px-8">
                {{ $voip_servers->links() }}
            </div>

            @if($editing)
            <form wire:submit.prevent="save">
                <x-jet-dialog-modal wire:model="showEditModal">
                    <x-slot name="title">Edit Server</x-slot>
                    <x-slot name="content">
                        <div class="space-y-4">
                            <x-input.group
                                for="name"
                                label="Server Name"
                                :error="$errors->first('editing.name')">
                                <x-input.text
                                    name="name"
                                    wire:model="editing.name"
                                    :has-error="$errors->has('editing.name')" />
                            </x-input.group>

                            <x-input.group
                                for="server_url"
                                label="Server URL"
                                :error="$errors->first('editing.server_url')">
                                <x-input.text
                                    name="server_url"
                                    wire:model="editing.server_url"
                                    :has-error="$errors->has('editing.server_url')" />
                            </x-input.group>

                            <x-input.group
                                for="api_user"
                                label="API Username"
                                :error="$errors->first('editing.api_user')">
                                <x-input.text
                                    name="api_user"
                                    wire:model="editing.api_user"
                                    :has-error="$errors->has('editing.api_user')" />
                            </x-input.group>

                            <x-input.group
                                for="api_password"
                                label="API Password"
                                :error="$errors->first('editing.api_password')">
                                <x-input.text
                                    name="api_password"
                                    type="password"
                                    wire:model="editing.api_password"
                                    :has-error="$errors->has('editing.api_password')" />
                            </x-input.group>

                            <x-input.group
                                for="active"
                                label="Active?"
                                :error="$errors->first('editing.active')">
                                <x-input.toggle-icon wire:model="editing.active" />
                            </x-input.group>

                            <div class="flex space-x-2 items-baseline">
                                <x-button.primary wire:click="testConnection">Test Connection</x-button.primary>
                                @if($credentialsChecked)
                                    @if ($credentialsValid)
                                        <span class="text-sm text-green-600">Connection succeeded.</span>
                                    @else
                                        <span class="text-sm text-red-600">Connection failed.</span>
                                    @endif
                                @endif
                                <input type="hidden" name="valid" wire:model="credentialsValid">
                            </div>

                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <div class="flex-1 flex justify-between items-baseline">
                            <div>
                                @error('credentialsValid')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                                <span>&nbsp;</span>
                            </div>
                            <div class="space-x-1">
                                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                                <x-button.primary type="submit">Save</x-button.primary>
                            </div>
                        </div>
                    </x-slot>
                </x-jet-dialog-modal>
            </form>
            @endif

            <!-- Delete Modal -->
            <form wire:submit.prevent="delete">
                <x-jet-confirmation-modal wire:model="showDeleteModal">
                    <x-slot name="title">Delete VOIP Server</x-slot>
                    <x-slot name="content">Are you sure you want to delete this server, this acction is irreversible?</x-slot>
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