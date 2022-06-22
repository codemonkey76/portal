<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-gray-900">Payment</h1>
        </div>

    </div>
    <div class="space-y-4">
        <div class="flex space-x-2">
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
        <div class="flex space-x-2">
            <x-input.group for="transaction_date" label="Date">
                <x-input.text name="transaction_date" wire:model="payment.date" type="date"/>
            </x-input.group>
            <x-input.group for="payment_ref" label="Reference">
                <x-input.text name="payment_ref" wire:model="payment.payment_ref"/>
            </x-input.group>
        </div>
    </div>
    fields for payment

    table of invoices
    save cancel buttons
</div>
