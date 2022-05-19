<div class="space-y-2">

    <!-- Page Header -->
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
        <span class="border-b border-gray-900 w-32 text-right">26/04/2022</span>
    </div>
    <!-- Page Header -->

    <!-- Customer Details -->
    <div class="bg-gray-300 rounded p-1">
        <span class="underline font-semibold uppercase">Customer Details:</span>
    </div>

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
    <!-- Customer Details -->

    <!-- Agreement Period -->
    <div class="bg-gray-300 rounded p-1">
        <span class="underline font-semibold uppercase">Agreement Period:</span>
    </div>

    <x-table>
        <x-slot name="head">
            <x-table.heading>Starts at</x-table.heading>
            <x-table.heading>Ends at</x-table.heading>
            <x-table.heading>Frequency</x-table.heading>
            <x-table.heading>Term</x-table.heading>
        </x-slot>
        <x-slot name="body">
            <x-table.row>
                <x-table.cell>{{ $agreement->starts_at->format('d/m/Y') }}</x-table.cell>
                <x-table.cell>{{ $agreement->ends_at->format('d/m/Y') }}</x-table.cell>
                <x-table.cell>{{ $agreement->frequencyString }}</x-table.cell>
                <x-table.cell>{{ $agreement->termString }}</x-table.cell>
            </x-table.row>
        </x-slot>
    </x-table>
    <!-- Agreement Period -->


    <!-- Service Details -->
    <div class="bg-gray-300 rounded p-1">
        <span class="underline font-semibold uppercase">Service Details:</span>
    </div>

    <div class="md:px-6 lg:px-8">
        <x-input.group for="service_type" wire:model="service_type" label="Service Type">
            <div class="flex space-x-2">
                <div>
                    <x-select>
                        <option value="mobile">Mobile</option>
                        <option value="network">Network</option>
                        <option value="voip">VOIP</option>
                    </x-select>
                </div>
                <x-button.primary wire:click="addService" :disabled="!$service_type">Add</x-button.primary>
            </div>
        </x-input.group>
    </div>

    <livewire:admin.mobile-service.index :agreement="$agreement" />
    <livewire:admin.network-service.index :agreement="$agreement" />

    <div class="grid grid-cols-3 gap-2 md:px-6 lg:px-8">
        <div class="col-span-2 bg-white md:rounded-lg shadow ring-1 ring-black text-gray-900 ring-opacity-5 p-2 text-sm flex items-center justify-center">
            <div>
                <div><span class="font-bold">* Note:</span> The speed of the service is governed by a number of factors, the speed listed above is the maximum speed of the service.</div>
                <div><span class="font-bold">Standard Exclusions:</span> Unscoped work, cabling, MDF upgrades (if required), and any other telecommunications connections or ongoing fees.</div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-2 bg-white md:rounded-lg shadow ring-1 ring-black text-gray-900 ring-opacity-5 p-2 text-sm">
            <span class="font-bold">Total (Ex GST)</span>
            <span class="text-right text-gray-500">{{ $agreement->totalString }}</span>
            <span class="font-bold">GST Amount</span>
            <span class="text-right text-gray-500">{{ $agreement->gstString }}</span>
            <span class="font-bold">Total (Inc GST)</span>
            <span class="text-right text-gray-500">{{ $agreement->grandTotalString }}</span>
        </div>
    </div>

    <div class="py-2 md:px-6 lg:px-8 flex justify-end items-center space-x-2">
        <span class="text-right font-bold">** Service agreement term: </span>
        <span class="bg-white md:rounded-lg shadow ring-1 ring-black text-gray-900 ring-opacity-5 p-2 text-sm">{{ $agreement->termString }}</span>
    </div>

    <span class="text-xs">** The agreement start date is the date that the service is active at the above address, and will run for the agreement term above.</span>
    <!-- Service Details -->

    <!-- Product Details -->
    <div class="bg-gray-300 rounded p-1">
        <span class="underline font-semibold uppercase">Product Details (Once Only Charge):</span>
    </div>

    <div class="md:px-6 lg:px-8">
        <x-button.primary wire:click="addProduct">Add</x-button.primary>
    </div>

    <livewire:admin.service-agreements.products.index :agreement="$agreement" />

    <div class="grid grid-cols-3 gap-2 md:px-6 lg:px-8">
        <div class="col-span-2">
        </div>
        <div class="grid grid-cols-2 gap-x-2 bg-white md:rounded-lg shadow ring-1 ring-black text-gray-900 ring-opacity-5 p-2 text-sm">
            <span class="font-bold">Total (Ex GST)</span>
            <span class="text-right text-gray-500">{{ $agreement->productTotalString }}</span>
            <span class="font-bold">GST Amount</span>
            <span class="text-right text-gray-500">{{ $agreement->productGstString }}</span>
            <span class="font-bold">Total (Inc GST)</span>
            <span class="text-right text-gray-500">{{ $agreement->productGrandTotalString }}</span>
        </div>
    </div>
    <!-- Product Details -->

    <x-button.primary wire:click="sendAgreement">Send Proposal</x-button.primary>

    <!-- Modals -->
    <livewire:admin.mobile-service.create :agreement="$agreement" />
    <livewire:admin.network-service.create :agreement="$agreement" />
    <livewire:admin.service-agreements.products.create :agreement="$agreement" />
    <!-- Modals -->
</div>

