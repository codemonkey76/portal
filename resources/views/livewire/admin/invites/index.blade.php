<div class="px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-xl font-semibold text-gray-900">Invitations</h1>
      <p class="mt-2 text-sm text-gray-700">A list of all the invitations pending in the system.</p>
    </div>
  </div>
  <div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="md:px-6 lg:px-8 py-2">
            <div class="flex justify-between">
                <x-input.search wire:model="search" />
                <div class="flex space-x-2">
                    <x-input.per-page :options="$perPageOptions" wire:model="perPage" />
                    @can('invites.create')<!-- CreateInviteButton --><x-button.primary wire:click="create">Invite User</x-button.primary>@endcan
                </div>
            </div>
        </div>

        <x-table>
            <x-slot name="head">
                <x-table.heading class="pl-4 sm:pl-6">Name</x-table.heading>
                <x-table.heading>Email</x-table.heading>
                <x-table.heading>Customer</x-table.heading>
                <x-table.heading>Expiry</x-table.heading>
                <x-table.heading>Actions</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse ($invites as $invite)
                <x-table.row>
                    <x-table.cell class="pl-4 sm:pl-6">{{ $invite->name }}</x-table.cell>
                    <x-table.cell>{{ $invite->email }}</x-table.cell>
                    <x-table.cell>{{ $invite->customer?->company_name }}</x-table.cell>
                    <x-table.cell>{{ $invite->expiry }}</x-table.cell>
                    <x-table.cell>
                        @can('invites.destroy')<!-- DeleteInviteButton --><x-small-button.danger wire:click="delete({{$invite}})">Delete</x-small-button.danger>@endcan
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
            {{ $invites->links() }}
        </div>

        <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showCreateModal">
            <x-slot name="title">Invite User</x-slot>
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

                    <x-input.group for="customer" label="Customer" :error="$errors->first('editing.customer_id')">
                        <x-select name="customer_id" wire:model="editing.customer_id" :has-error="$errors->has('editing.customer_id')">
                            @foreach(App\Models\Customer::orderBy('company_name')->get() as $customer)
                                <option value={{ $customer->id }}>{{ $customer->company_name }}</option>
                            @endforeach
                        </x-select>
                    </x-input.group>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="space-x-1">
                    <x-button.secondary wire:click="$set('showCreateModal', false)">Cancel</x-button.secondary>
                    <x-button.primary type="submit">Save</x-button.primary>
                </div>
            </x-slot>
        </x-modal.dialog>
        </form>
    </div>
  </div>
</div>
