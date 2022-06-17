<div x-data="{showMenu: false}" class="px-4 sm:px-6 lg:px-8">
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
            <div class="flex space-x-2">
                <x-button.secondary>Edit</x-button.secondary>
                <div x-data="{showMenu: false}" class="relative">
                    <x-button.primary
                        @click="showMenu = !showMenu"
                        @click.away="showMenu = false"
                        class="flex items-center space-x-2">
                        <span>New Transaction</span>
                        <x-icon.caret-down/>
                    </x-button.primary>
                    <div x-show="showMenu" class="absolute top-0 mt-10 border bg-white text-gray-500 text-sm z-10">
                        <div role="button"
                             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400">
                            Invoice
                        </div>
                        <div role="button"
                             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400">
                            Payment
                        </div>
                        <div role="button"
                             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400">
                            Quote
                        </div>
                        <div role="button"
                             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400">
                            Sales Receipt
                        </div>
                        <div role="button"
                             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400">
                            Adjustment Note
                        </div>
                        <div role="button"
                             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400">
                            Statement
                        </div>
                    </div>
                </div>
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
                    <x-table.heading align="middle"
                                     sortable
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
                    <x-table.heading align="right"
                                     sortable
                                     multi-column
                                     :direction="$sorts['balance'] ?? null"
                                     wire:click="sortBy('balance')">
                        Balance
                    </x-table.heading>
                    <x-table.heading align="right"
                                     sortable
                                     multi-column
                                     :direction="$sorts['total_amount'] ?? null"
                                     wire:click="sortBy('total_amount')">
                        Total ex.
                    </x-table.heading>
                    <x-table.heading align="right">GST</x-table.heading>
                    <x-table.heading align="right" sortable
                                     multi-column
                                     :direction="$sorts['total'] ?? null"
                                     wire:click="sortBy('total')">
                        Total
                    </x-table.heading>
                    <x-table.heading class="text-center">Status</x-table.heading>
                    <x-table.heading class="text-center">Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($transactions as $transaction)
                        <x-table.row override-color
                                     class="{{
                            $transaction->status->value === 'Paid'
                                ? 'bg-green-400'
                                : ($transaction->status->value === 'Overdue'
                                    ? 'bg-orange-400' :
                                    ($transaction->status->value === 'Closed'
                                        ? 'bg-gray-300' : 'bg-white')) }}">
                            <x-table.cell
                                class="pl-4 sm:pl-6 text-gray-900">{{ $transaction->transaction_ref }}</x-table.cell>
                            <x-table.cell class="text-gray-900 text-center">{{ $transaction->type }}</x-table.cell>
                            <x-table.cell class="text-gray-900">{{ $transaction->transactionDateString }}</x-table.cell>
                            <x-table.cell class="text-gray-900 text-right">{{ $transaction->balanceString }}</x-table.cell>
                            <x-table.cell class="text-gray-900 text-right">{{ $transaction->totalExAmountString }}</x-table.cell>
                            <x-table.cell class="text-gray-900 text-right">{{ $transaction->gstString }}</x-table.cell>
                            <x-table.cell class="text-gray-900 text-right">{{ $transaction->totalAmountString }}</x-table.cell>
                            <x-table.cell class="text-center">{{ $transaction->status->value }}</x-table.cell>
                            <x-table.cell class="text-center">
                                <div class="flex justify-center space-x-1">

                                    @can('send', $transaction)
                                        <button
                                            title="Send"
                                            class="hover:text-blue-600"
                                            wire:click="email({{ $transaction->id }})">
                                            <x-icon.email />
                                        </button>
                                    @endcan

                                    @can('show', $transaction)
                                        <button
                                            title="View"
                                            class="hover:text-cyan-600"
                                            wire:click="view({{ $transaction->id }})">
                                            <x-icon.view />
                                        </button>
                                    @endcan

                                    @can('edit', $transaction)
                                        <button
                                            title="Edit"
                                            class="hover:text-yellow-600"
                                            wire:click="edit({{ $transaction->id }})">
                                            <x-icon.pencil />
                                        </button>
                                    @endcan

                                    @can('copy', $transaction)
                                        <button
                                            title="Copy"
                                            class="hover:text-orange-500"
                                            wire:click="copy({{ $transaction->id }})">
                                            <x-icon.copy />
                                        </button>
                                    @endcan

                                    @can('void', $transaction)
                                        <button
                                            title="Void"
                                            class="hover:text-fuchsia-700"
                                            wire:click="void({{ $transaction->id }})">
                                            <x-icon.void />
                                        </button>
                                    @endcan

                                    @can('delete', $transaction)
                                        <button
                                            title="Delete"
                                            class="hover:text-red-600"
                                            wire:click="delete({{ $transaction->id }})">
                                            <x-icon.trash />
                                        </button>
                                    @endcan
                                </div>
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

        </div>
    </div>
{{--    <div x-show="true" class="absolute top-0 mt-6 border bg-white z-10">--}}
{{--        <div role="button"--}}
{{--             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400"--}}
{{--             wire:click="send({{ $transaction->id }})">Send--}}
{{--        </div>--}}
{{--        <div role="button"--}}
{{--             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400"--}}
{{--             wire:click="show({{ $transaction->id }})">View / Edit--}}
{{--        </div>--}}
{{--        <div role="button"--}}
{{--             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400"--}}
{{--             wire:click="copy({{ $transaction->id }})">Copy--}}
{{--        </div>--}}
{{--        <div role="button"--}}
{{--             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400"--}}
{{--             wire:click="void({{ $transaction->id }})">Void--}}
{{--        </div>--}}
{{--        <div role="button"--}}
{{--             class="cursor-pointer px-4 py-2 hover:underline hover:bg-gray-100 hover:text-indigo-400"--}}
{{--             wire:click="delete({{ $transaction->id }})">Delete--}}
{{--        </div>--}}
{{--    </div>--}}

</div>
