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
            <x-input.group for="amount" label="Amount">
                <x-input.text name="amount" wire:model="payment.total_ex_gst" leading-add-on="$"/>
            </x-input.group>
        </div>
    </div>
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
                @if($this->allocations)
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
                            <x-table.cell>testing</x-table.cell>
                        </x-table.row>
                    @endforelse
                @endif
            </x-slot>
        </x-table>

    </div>
    <div>
        <x-button.primary wire:click="savePayment">Save Payment</x-button.primary>
    </div>
    @if ($errors->has('amount'))
        <div class="text-red-500">{{ $errors->first('amount') }}</div>
    @endif
</div>
