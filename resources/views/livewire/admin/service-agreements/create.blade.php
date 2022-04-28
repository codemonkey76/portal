<div class="space-y-2">
    <div class="grid gap-4 grid-cols-2">
        <x-icon.logo-full class="h-12" />
        <div class="flex flex-col">
            <h3 class="font-semibold text-lg text-gray-900">SERVICE AGREEMENT</h3>
            <span class="text-gray-700 tracking-tighter text-sm">{{ settings('company_name') }} {{ settings('abn') }}</span>
            <span class="text-gray-700 tracking-tighter text-sm">{{ settings('address') }}</span>
        </div>
    </div>

    <div class="flex justify-end items-baseline">
        <span>Date: </span>
         <x-input.text wire:model="created_date" type="date"  class="ml-2" />
    </div>

    <div class="bg-gray-300 rounded p-1">
        <span class="underline font-semibold uppercase">Agreement Period:</span>
    </div>

    <x-input.group for="contract_period" label="Agreement Period">
        <div class="flex">
            <div>
                <x-select wire:model="contract_term">
                    @foreach($terms as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>
    </x-input.group>

    <div class="flex space-x-2">
        <x-input.group for="starts_at" label="Agreement Start">
            <div class="flex">
                <x-input.text name="starts_at" type="date" wire:model="startsAtDate"/>
            </div>
        </x-input.group>
        <x-input.group for="ends_at" label="Agreement End">
            <div class="flex">
                <x-input.text name="ends_at" type="date" wire:model="endsAtDate" readonly />
            </div>
        </x-input.group>
    </div>

    <div class="bg-gray-300 rounded p-1">
        <span class="underline font-semibold uppercase">Customer Details:</span>
    </div>

    <x-input.group for="customer_id" label="Select Customer">
        <div class="flex">
            <div>
                <x-select wire:model="agreement.customer_id">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                  @endforeach
                </x-select>
            </div>
        </div>
    </x-input.group>

    @if($agreement->customer)
        <div class="grid grid-cols-5 gap-2">
            <span class="text-right">Company name:</span>
            <span class="border-b border-gray-900 col-span-4 text-gray-500">{{ $agreement->customer->company_name }}</span>
            <span class="text-right">ABN:</span>
            <span class="border-b border-gray-900 col-span-4 text-gray-500">{{ $agreement->customer->abn }}</span>
            <span class="text-right">Billing Email:</span>
            <span class="border-b border-gray-900 col-span-4 text-gray-500">{{ $agreement->customer->email }}</span>
            <span class="text-right">Billing Address:</span>
            <span class="border-b border-gray-900 col-span-4 text-gray-500">{{ $agreement->customer->billingAddressString }}</span>
        </div>

        <x-button.primary class="mt-4" wire:click="createServiceAgreement">Create Service Agreement</x-button.primary>
    @endif

    @json($agreement)

</div>

