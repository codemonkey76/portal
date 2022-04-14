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
                <x-table.heading class="pl-4 sm:pl-6">Name</x-table.heading>
                <x-table.heading>Title</x-table.heading>
                <x-table.heading>Status</x-table.heading>
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
                        <div class="text-gray-900">{{ $user->customer?->name ?? 'No assigned customer' }}</div>
                        <div class="text-gray-500">{{ $user->customer?->phone ?? '' }}</div>
                    </x-table.cell>
                    <x-table.cell>
                        <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                    </x-table.cell>
                    <x-table.cell class="text-gray-500 space-x-1">
                        @foreach ($user->roles as $role)
                        <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">{{ $role->name }}</span>
                        @endforeach
                    </x-table.cell>
                    <x-table.cell><a href="#" wire:click="edit({{ $user->id }})" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a></x-table.cell>
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
        <form wire:submit.prevent="save">
        <x-jet-dialog-modal wire:model="showEditModal">
            <x-slot name="title">Edit User</x-slot>
            <x-slot name="content">
                <div class="space-y-4">
                    <x-input.group
                        label="Name"
                        for="name"
                        :error="$errors->first('editing.name')">
                        <x-input.text wire:model="editing.name" name="name" :has-error="$errors->has('editing.name')"/>
                    </x-input.group>
                    <x-input.group
                        label="Email"
                        for="email"
                        :error="$errors->first('editing.email')">
                        <x-input.text wire:model="editing.email" name="email" :has-error="$errors->has('editing.email')"/>
                    </x-input.group>

                    <x-input.group
                        label="Password"
                        for="password"
                        :errror="$errors->first('editing.password')">
                        <x-input.text wire:model="editing.password" name="password" type="password" :has-error="$errors->has('editing.password')"/>
                    </x-input.group>

                    <x-input.group
                        label="Confirm Password"
                        for="password_confirmation"
                        :error="$errors->first('editing.password_confirmation')">
                        <x-input.text wire:model="editing.password_confirmation" name="password_confirmation" type="password" :has-error="$errors->has('editing.password_confirmation')"/>
                    </x-input.group>
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
    </div>
  </div>
</div>
