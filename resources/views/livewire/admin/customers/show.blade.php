<div class="px-4 sm:px-6 lg:px-8">
    <!-- Page Heading -->
    <div class="bg-gray-200 border-t border-b border-gray-300 px-6 py-2 space-y-2">
        <div class="flex justify-between">
            <div class="space-x-4 flex items-center">
                <span class="text-2xl">#{{ $customer->id }} {{ $customer->display_name }}</span>
                <a href="mailto:{{ $customer->email }}">
                    <x-icon.email/>
                </a>
                <a href="tel:{{ $customer->phone }}">
                    <x-icon.phone/>
                </a>
            </div>
            <div>
                <x-button.secondary>Edit</x-button.secondary>
                <x-button.primary>New Transaction</x-button.primary>
            </div>
        </div>
        <div class="space-x-4 font-thin">
            <span>{{ $customer->company_name }}</span>
            <span>|</span>
            <span>{{ $customer->billingAddressString }}</span>
        </div>
    </div>
    <!-- Page Heading -->

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <!-- Command Bar -->
            <div class="md:px-6 lg:px-8 py-2">
                <div class="flex justify-between">
                    <!-- ItemSearchButton -->
                    <div class="flex space-x-1">
                        <x-input.search wire:model="search"/>
                        <div x-data="{showInfo: false}" class="mt-2 text-gray-600 relative">
                            <x-icon.info
                                @mouseenter="showInfo = true"
                                @mouseleave="showInfo = false"
                            />

                            <div x-show="showInfo"
                                 class="absolute border rounded-md shadow border-gray-300 bg-white mt-2 pl-8 pr-4 py-2 text-xs w-96">
                                <ol class="list-decimal">
                                    <li>Searching by date must be done in YYYY-MM-DD format</li>
                                    <li>Searching by amount must use ex. GST amount</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- ItemSearchButton -->
                    <div class="flex space-x-2">
                        <x-input.per-page :options="$perPageOptions" wire:model="perPage"/>
                    </div>
                </div>
            </div>
            <!-- Command Bar -->

            <!-- Table -->
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable
                                     multi-column
                                     :direction="$sorts['id'] ?? null"
                                     wire:click="sortBy('id')"
                                     class="pl-4 sm:pl-6">
                        ID
                    </x-table.heading>
                    <x-table.heading sortable
                                     multi-column
                                     :direction="$sorts['type'] ?? null"
                                     wire:click="sortBy('type')">
                        Type
                    </x-table.heading>
                    <x-table.heading sortable
                                     multi-column
                                     :direction="$sorts['due_date'] ?? null"
                                     wire:click="sortBy('due_date')">
                        Due Date
                    </x-table.heading>
                    <x-table.heading sortable
                                     multi-column
                                     :direction="$sorts['balance'] ?? null"
                                     wire:click="sortBy('balance')">
                        Balance
                    </x-table.heading>
                    <x-table.heading sortable
                                     multi-column
                                     :direction="$sorts['total_amount'] ?? null"
                                     wire:click="sortBy('total_amount')">
                        Total ex.
                    </x-table.heading>
                    <x-table.heading>GST</x-table.heading>
                    <x-table.heading sortable
                                     multi-column
                                     :direction="$sorts['total'] ?? null"
                                     wire:click="sortBy('total')">
                        Total
                    </x-table.heading>
                    <x-table.heading>Status</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($transactions as $transaction)
                        <x-table.row>
                            <x-table.cell class="pl-4 sm:pl-6 text-gray-900">{{ $transaction->transaction_ref }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $transaction->type }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $transaction->transactionDateString }}</x-table.cell>
                            <x-table.cell class="text-gray-900">$0.00</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $transaction->totalAmountString }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $transaction->gstString }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $transaction->totalIncAmountString }}</x-table.cell>
                            <x-table.cell>Closed</x-table.cell>
                            <x-table.cell>
                                @if($transaction->type === 'invoice')
                                <div x-data="{showMenu: false}" class="relative">
                                    <div class="flex items-center space-x-2">
                                        <button class="hover:text-indigo-400 hover:underline" wire:click="print({{$transaction->id}})">
                                            <span>Print</span>
                                        </button>
                                        <button @click.away="showMenu = false" @click="showMenu = !showMenu">
                                            <x-icon.caret-down/>
                                        </button>
                                    </div>
                                    <div x-show="showMenu" class="absolute top-0 mt-6 border bg-white z-10">
                                        <div role="button" class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400" wire:click="send({{ $transaction->id }})">Send</div>
                                        <div role="button" class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400" wire:click="show({{ $transaction->id }})">View / Edit</div>
                                        <div role="button" class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400" wire:click="copy({{ $transaction->id }})">Copy</div>
                                        <div role="button" class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400" wire:click="void({{ $transaction->id }})">Void</div>
                                        <div role="button" class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400" wire:click="delete({{ $transaction->id }})">Delete</div>
                                    </div>
                                </div>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="9" class="text-gray-500 text-center italic text-md">
                                No transactions found
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            <!-- Table -->

            <div class=" md:px-6 lg:px-8">
                {{ $transactions->links() }}
            </div>
            @json($sorts)


        </div>
    </div>
</div>
