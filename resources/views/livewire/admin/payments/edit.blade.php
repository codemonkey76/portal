<div class="px-4 sm:px-6 lg:px-8 space-y-4">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-gray-900">Payment</h1>
        </div>

    </div>
    <div class="space-y-4">
        <div class="grid grid-cols-2 gap-x-2">
            <x-input.group for="customer_id" label="Customer">
                <x-select name="customer_id" wire:model="payment.customer_id">
                    @foreach ($customers as $customer)
                        <option value="{{$customer->id}}">({{$customer->id}}) {{ $customer->company_name }}</option>
                    @endforeach
                </x-select>
            </x-input.group>
            <x-input.group for="bill_email" label="Email">
                <x-input.text name="bill_email" wire:model="payment.bill_email"/>
            </x-input.group>
        </div>
        <div class="grid grid-cols-3 gap-x-2">
            <x-input.group for="transaction_date" label="Date">
                <x-input.text name="transaction_date" wire:model="transaction_date" type="date"/>
            </x-input.group>
            <x-input.group for="payment_ref" label="Reference">
                <x-input.text name="payment_ref" wire:model="payment.payment_ref"/>
            </x-input.group>
            <x-input.group for="amount" label="Amount Received">
                <x-input.text name="amount" wire:model="payment.total_ex_gst" leading-add-on="$"/>
            </x-input.group>
        </div>
    </div>
    <div>
        <div class="text-xl font-bold">Outstanding Transactions</div>

        <div class="-mx-4 sm:-mx-6 lg:-mx-8" x-data="{}">
            <x-table>
                <x-slot name="head">
                    <x-table.heading><span class="sr-only">Checkbox</span></x-table.heading>
                    <x-table.heading>Description</x-table.heading>
                    <x-table.heading>Due Date</x-table.heading>
                    <x-table.heading>Original Amount</x-table.heading>
                    <x-table.heading>Open Balance</x-table.heading>
                    <x-table.heading>Payment</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($this->allocations as $index => $allocation)
                        <x-table.row>
                            <x-table.cell>
                                <button wire:click="allocate({{ $allocation }})">
                                    <div class="flex">
                                        @if ($allocation->transaction->getBalanceExcludingPayment($this->payment) == $allocation->amount)
                                            <x-icon.check/>
                                        @elseif ($allocation->amount != 0)
                                            <x-icon.partial/>
                                        @else
                                            <x-icon.cleared/>
                                        @endif
                                    </div>
                                </button>
                            </x-table.cell>
                            <x-table.cell>
                                <a
                                    href="{{ route('invoices.show', $allocation['transaction_id']) }}"
                                    class="text-indigo-500 hover:underline">
                                    {{ Str::title($allocation['transaction']['type']) }}
                                    # {{ $allocation['transaction']['transaction_ref'] }}
                                </a> ({{ $allocation['transaction']['transaction_date_string'] }})
                            </x-table.cell>
                            <x-table.cell>{{ $allocation['transaction']['due_date_string'] }}</x-table.cell>
                            <x-table.cell>{{ $allocation['transaction']['total_amount_string'] }}</x-table.cell>
                            <x-table.cell>{{ $allocation['transaction']['balance_string'] }}</x-table.cell>
                            <x-table.cell>
                                @if ($this->editingAllocationIndex !== $index)
                                    <div class="cursor-pointer" wire:click="editAllocation({{ $index }})">
                                        {{ $allocation['amount_string'] }}
                                    </div>
                                @else
                                    <x-input.text @click.away="$wire.saveAllocation()" leading-add-on="$" class="w-12"
                                                  wire:model.defer="allocations.{{ $index }}.amount"/>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6" class="text-gray-500 text-center italic text-md">No invoices
                                found
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>
    </div>
    <div>
        <div class="text-xl font-bold">Credits</div>
        <div class="-mx-4 sm:-mx-6 lg:-mx-8" x-data="{}">
            <x-table>
                <x-slot name="head">
                    <x-table.heading><span class="sr-only">Checkbox</span></x-table.heading>
                    <x-table.heading>Description</x-table.heading>
                    <x-table.heading>Due Date</x-table.heading>
                    <x-table.heading>Original Amount</x-table.heading>
                    <x-table.heading>Open Balance</x-table.heading>
                    <x-table.heading>Payment</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($this->creditAllocations as $index => $credit)
                        <x-table.row>
                            <x-table.cell>
                                <button wire:click="allocate({{ $credit }})">
                                    <div class="flex">
                                        @if ($credit->transaction->getBalanceExcludingPayment($this->payment) == $credit->amount)
                                            <x-icon.check/>
                                        @elseif ($credit->amount != 0)
                                            <x-icon.partial/>
                                        @else
                                            <x-icon.cleared/>
                                        @endif
                                    </div>
                                </button>
                            </x-table.cell>
                            <x-table.cell>
                                <a
                                    href="{{ route('invoices.show', $credit['transaction_id']) }}"
                                    class="text-indigo-500 hover:underline">
                                    {{ Str::title($credit['transaction']['type']) }}
                                    # {{ $credit['transaction']['transaction_ref'] }}
                                </a> ({{ $credit['transaction']['transaction_date_string'] }})
                            </x-table.cell>
                            <x-table.cell>{{ $credit['transaction']['due_date_string'] }}</x-table.cell>
                            <x-table.cell>{{ $this->formatMoney($credit['transaction']['total_amount']) }}</x-table.cell>
                            <x-table.cell>{{ $credit['transaction']['balance_string'] }}</x-table.cell>
                            <x-table.cell>
                                @if ($this->editingCreditAllocationIndex !== $index)
                                    <div class="cursor-pointer" wire:click="editCreditAllocation({{ $index }})">
                                        {{ $credit['amount_string'] }}
                                    </div>
                                @else
                                    <x-input.text @click.away="$wire.saveCreditAllocation()" leading-add-on="$" class="w-12"
                                                  wire:model.defer="creditAllocations.{{ $index }}.amount"/>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6" class="text-gray-500 text-center italic text-md">No credits
                                found
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>
    </div>
    <div class="flex justify-end">
        <div class="grid grid-cols-2 gap-2">
            <div class="text-sm font-semibold text-gray-700 p-1">Amount to Apply</div>
            <div class="text-sm text-gray-500 text-right rounded shadow-sm border border-gray-300 p-1 bg-white">{{ $this->formatMoney($this->amount_to_apply) }}</div>
            <div class="text-sm font-semibold text-gray-700 p-1">Amount to Credit</div>
            <div class="text-right text-sm text-gray-500 rounded shadow-sm border border-gray-300 p-1 bg-white">{{ $this->formatMoney($this->remaining_payment) }}</div>
        </div>
    </div>
    <div class="flex justify-end">
        <x-button.primary wire:click="savePayment">Save Payment</x-button.primary>
    </div>
</div>
