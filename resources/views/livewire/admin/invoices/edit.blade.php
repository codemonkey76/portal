<div>
    <div class="flex space-x-2">
        <x-input.group for="customer_name" label="Customer">
            <x-select wire:model="invoice.customer_id">
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->company_name}}</option>
                @endforeach
            </x-select>
        </x-input.group>
        <x-input.group for="customer_email" label="Customer email">
            <x-input.text :value="$invoice->bill_email"/>
        </x-input.group>
    </div>
    <x-input.group for="customer_terms" label="Terms">
        <x-select wire:model="term_id">
            @foreach($terms as $term)
                <option value="{{$term->id}}">{{ $term->name }}</option>
            @endforeach
        </x-select>
    </x-input.group>
    <x-input.group for="transaction_date" label="Transaction Date">
        <x-input.text name="transaction_date" wire:model="transaction_date" type="date" />
    </x-input.group>
    <x-input.group for="due_date" label="Due Date">
        <x-input.text name="due_date" wire:model="due_date" type="date"/>
    </x-input.group>
    <div>Invoice No.
    Invoice Date
    Due Date
    Items
    Message on Invoice
    </div>
    <div>
        @json($invoice)
    </div>
</div>
