<div class="space-y-2">
    <div class="grid gap-4 grid-cols-2">
        <x-icon.logo-full class="h-12" />
        <div class="flex flex-col">
            <h3 class="font-semibold text-lg text-gray-900">SERVICE AGREEMENT</h3>
            <span class="text-gray-700 tracking-tighter text-sm">{{ settings('company_name') }} {{ settings('abn') }}</span>
            <span class="text-gray-700 tracking-tighter text-sm">{{ settings('address') }}</span>
        </div>
    </div>

    <div class="flex justify-end">
        <span>Date: </span>
        <span class="border-b border-gray-900 w-32 text-right">26/04/2022</span>
    </div>

    <div class="bg-gray-300 rounded p-1">
        <span class="underline font-semibold uppercase">Customer Details:</span>
    </div>

    <x-input.group for="customer_id" label="Select Customer">
        <x-select>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
            @endforeach
        </x-select>
    </x-input.group>

    <div class="grid grid-cols-5 gap-2">
        <span class="text-right">Company name:</span>
        <span class="border-b border-gray-900 col-span-4 text-gray-500">{{ $serviceAgreement->customer->company_name }}</span>
        <span class="text-right">ABN:</span>
        <span class="border-b border-gray-900 col-span-4 text-gray-500">{{ $serviceAgreement->customer->abn }}</span>
        <span class="text-right">Billing Email:</span>
        <span class="border-b border-gray-900 col-span-4 text-gray-500">{{ $serviceAgreement->customer->email }}</span>
        <span class="text-right">Billing Address:</span>
        <span class="border-b border-gray-900 col-span-4 text-gray-500">{{ $serviceAgreement->customer->billingAddressString }}</span>
    </div>

    <!-- Service Details -->
    <div class="bg-gray-300 rounded p-1">
        <span class="underline font-semibold uppercase">Service Details:</span>
    </div>

    <x-table>
        <x-slot name="head">
            <x-table.heading>Service Description</x-table.heading>
            <x-table.heading>*Speed</x-table.heading>
            <x-table.heading>Billing Type</x-table.heading>
            <x-table.heading>Sub Total (Ex GST)</x-table.heading>
        </x-slot>
        <x-slot name="body">
            <x-table.row>
                <x-table.cell>Business Grade NBN - FTTP (Fibre)</x-table.cell>
                <x-table.cell>50/20</x-table.cell>
                <x-table.cell>Monthly</x-table.cell>
                <x-table.cell>$105.00</x-table.cell>
            </x-table.row>
        </x-slot>
    </x-table>

    <div class="grid grid-cols-3 gap-2 md:px-6 lg:px-8">
        <div class="col-span-2 bg-white md:rounded-lg shadow ring-1 ring-black text-gray-900 ring-opacity-5 p-2 text-sm flex items-center justify-center">
            <div>
                <div><span class="font-bold">* Note:</span> The speed of the service is governed by a number of factors, the speed listed above is the maximum speed of the service.</div>
                <div><span class="font-bold">Standard Exclusions:</span> Unscoped work, cabling, MDF upgrades (if required), and any other telecommunications connections or ongoing fees.</div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-x-2 bg-white md:rounded-lg shadow ring-1 ring-black text-gray-900 ring-opacity-5 p-2 text-sm">
            <span class="font-bold">Total (Ex GST)</span>
            <span class="text-right text-gray-500">$105.00</span>
            <span class="font-bold">GST Amount</span>
            <span class="text-right text-gray-500">$10.50</span>
            <span class="font-bold">Total (Inc GST)</span>
            <span class="text-right text-gray-500">$115.50</span>
        </div>
    </div>

    <div class="py-2 md:px-6 lg:px-8 flex justify-end items-center space-x-2">
        <span class="text-right font-bold">** Service agreement term: </span>
        <span class="bg-white md:rounded-lg shadow ring-1 ring-black text-gray-900 ring-opacity-5 p-2 text-sm">24 Months</span>
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

</div>
