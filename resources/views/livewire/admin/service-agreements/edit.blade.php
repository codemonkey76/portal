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
            <x-table.heading>Period</x-table.heading>
        </x-slot>
        <x-slot name="body">
            <x-table.row>
                <x-table.cell>{{ $agreement->starts_at->format('d/m/Y') }}</x-table.cell>
                <x-table.cell>{{ $agreement->ends_at->format('d/m/Y') }}</x-table.cell>
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

    <x-table>
        <x-slot name="head">
            <x-table.heading>Product Description</x-table.heading>
            <x-table.heading>Qty</x-table.heading>
            <x-table.heading>Unit Price</x-table.heading>
            <x-table.heading>Sub Total (Ex GST)</x-table.heading>
        </x-slot>
        <x-slot name="body">
            <x-table.row>
                <x-table.cell>Hybrid Router (VDSL, Fibre, 4G)</x-table.cell>
                <x-table.cell>1</x-table.cell>
                <x-table.cell>$220.00</x-table.cell>
                <x-table.cell>$220.00</x-table.cell>
            </x-table.row>
        </x-slot>
    </x-table>

    <div class="grid grid-cols-3 gap-2 md:px-6 lg:px-8">
        <div class="col-span-2">
        </div>
        <div class="grid grid-cols-2 gap-x-2 bg-white md:rounded-lg shadow ring-1 ring-black text-gray-900 ring-opacity-5 p-2 text-sm">
            <span class="font-bold">Total (Ex GST)</span>
            <span class="text-right text-gray-500">$220.00</span>
            <span class="font-bold">GST Amount</span>
            <span class="text-right text-gray-500">$22.00</span>
            <span class="font-bold">Total (Inc GST)</span>
            <span class="text-right text-gray-500">$242.00</span>
        </div>
    </div>
    <!-- Product Details -->

    <!-- Customer Declaration -->
    <div class="bg-gray-300 rounded p-1">
        <span class="underline font-semibold uppercase">Customer Signature:</span>
    </div>

    <div class="grid grid-cols-2 gap-2">
        <div>
            <x-input.group for="name" label="Name">
                <x-input.text name="name" value="Shane Poppleton" readonly></x-input.text>
            </x-input.group>
            <x-input.group for="position" label="Position">
                <x-input.text name="position" value="Systems Administrator" readonly></x-input.text>
            </x-input.group>
            <x-input.group for="date" label="Date">
                <x-input.text name="date" value="20/04/2022" readonly></x-input.text>
            </x-input.group>
        </div>
        <div class="flex justify-center items-center"><livewire:signature-pad /></div>
    </div>

    <div class="bg-gray-300 rounded p-1">
        <span class="underline font-semibold uppercase">Customer Acknowledgement - Important Declaration</span>
    </div>
    <div class="text-sm">
        I certify that I have the authority to sign this agreement with {{ settings('company_name') }}
        ({{ settings('abn') }}) for services or to make changes to existing services and acknowledge that
        {{ settings('company_name') }} will bill me for the services. An SQ (Service qualification) for the above
        service at the above address must be approved before this agreement is valid. All debt recovery fees incurred
        by {{ settings('company_name') }} will be recoverable from the client. This is a "Contract for Services". You
        agree with the attached Service information summary. A full Terms and Conditions, and SLA can be supplied on
        request.
    </div>
    <!-- Customer Declaration -->

    <livewire:admin.mobile-service.create :agreement="$agreement" />


    <livewire:admin.network-service.create :agreement="$agreement"/>
</div>

