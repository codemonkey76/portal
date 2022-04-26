<div>
    <h1 class="text-xl font-semibold text-gray-900">New Service Agreement</h1>
    <form wire:submit.prevent="save">

        <x-input.group for="created_at" label="Agreement Date">
            <x-input.text type="date" name="created_at" wire:model="created_date"/>
        </x-input.group>

        <x-input.group for="customer_id" label="Customer">
            <x-select wire:model="agreement.customer_id">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                @endforeach
            </x-select>
        </x-input.group>

        <x-input.group for="agreement_type_id" label="Agreement Type">
            <x-select wire:model="agreement_type">
                @foreach ($agreementTypes as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-select>
        </x-input.group>
    </form>
</div>
