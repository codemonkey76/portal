<div class="space-y-4">

    <!-- Invoice Header Fields -->
    <div class="grid grid-cols-3 gap-4">
        <x-input.group for="customer_name" label="Customer">
            <x-select wire:model="invoice.customer_id">
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->company_name}}</option>
                @endforeach
            </x-select>
        </x-input.group>
        <x-input.group for="customer_email" label="Customer email">
            <x-input.text wire:model="invoice.bill_email"/>
        </x-input.group>
        <x-input.group for="document_no" label="Invoice no">
            <x-input.text wire:model="invoice.doc_number"/>
        </x-input.group>
        <x-input.group for="customer_terms" label="Terms">
            <x-select wire:model="term_id">
                @foreach($terms as $term)
                    <option value="{{$term->id}}">{{ $term->name }}</option>
                @endforeach
            </x-select>
        </x-input.group>
        <x-input.group for="transaction_date" label="Transaction Date">
            <x-input.text name="transaction_date" wire:model="transaction_date" type="date"/>
        </x-input.group>
        <x-input.group for="due_date" label="Due Date">
            <x-input.text name="due_date" wire:model="due_date" type="date"/>
        </x-input.group>
    </div>
    <!-- Invoice Header Fields -->

    <div class="md:-mx-6 lg:-mx-8">
        <div class="md:px-6 lg:px-8 py-2">
            <div class="flex justify-end">
                <x-button.primary wire:click="create">Add Line</x-button.primary>
            </div>
        </div>

        <x-table>
            <x-slot name="head">
                <x-table.heading class="pl-4 sm:pl-6">Line No</x-table.heading>
                <x-table.heading>Description</x-table.heading>
                <x-table.heading>Qty</x-table.heading>
                <x-table.heading>Price</x-table.heading>
                <x-table.heading>Amount</x-table.heading>
                <x-table.heading class="w-10">Actions</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse ($invoice->invoiceLines as $line)
                    @if ($line->detail_type === 'SalesItemLineDetail')
                        <x-table.row>
                            <x-table.cell
                                class="pl-4 sm:pl-6 text-gray-900 md:text-xs ">{{ $line->line_num }}</x-table.cell>
                            <x-table.cell
                                class="text-gray-900 md:text-xs md:whitespace-normal w-128">{!! $line->descriptionString !!}</x-table.cell>
                            <x-table.cell class="text-gray-900 md:text-xs">{{ $line->qty }}</x-table.cell>
                            <x-table.cell class="text-gray-900 md:text-xs">{{ $line->unitPriceString }}</x-table.cell>
                            <x-table.cell class="text-gray-900 md:text-xs">{{ $line->amountString }}</x-table.cell>
                            <x-table.cell class="md:text-xs">
                                <x-small-button.warning wire:click="editLine({{$line->id}})">Edit</x-small-button.warning>
                                <x-small-button.danger wire:click="confirmDelete({{ $line->id }})">Delete</x-small-button.danger>
                            </x-table.cell>
                        </x-table.row>
                    @else
                        <x-table.row>
                            <x-table.cell colspan="5"
                                class="pl-4 sm:pl-6 text-gray-900 md:text-xs ">{{ $line->detail_type }}</x-table.cell>
                            <x-table.cell class="md:text-xs">
                                <x-small-button.warning wire:click="editLine({{$line->id}})">Edit</x-small-button.warning>
                                <x-small-button.danger wire:click="confirmDelete({{ $line->id }})">Delete</x-small-button.danger>
                            </x-table.cell>
                        </x-table.row>
                    @endif
                @empty
                    <x-table.row>
                        <x-table.cell colspan="6" class="text-gray-500 text-center italic text-md">
                            No lines found
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <!-- Table Footer -->
        <div class="flex justify-between lg:px-8">
            <div class="w-96 flex flex-col justify-end">
                <x-input.group for="message" label="Message on invoice">
                    <x-input.textarea readonly wire:model="invoice.customer_memo"></x-input.textarea>
                </x-input.group>
            </div>
            <!-- Totals -->
            <div class="grid grid-cols-2 gap-2 text-right text-xs">
                <div class="flex justify-end items-center">Subtotal</div>
                <div class="border px-2 py-1 bg-white rounded">{{ $invoice->totalExAmountString }}</div>
                <div class="flex justify-end items-center">GST</div>
                <div class="border px-2 py-1 bg-white rounded">{{ $invoice->gstString }}</div>
                <div class="flex justify-end items-center">Total</div>
                <div class="border px-2 py-1 bg-white rounded">{{ $invoice->totalAmountString }}</div>
                @if ($invoice->payments()->count() > 0 || true)
                    <div class="flex justify-end items-center">Amount Received</div>
                    <div class="border px-2 py-1 bg-white rounded">{{ $invoice->totalPaymentsString }}</div>
                    <div class="flex justify-end items-center">Balance</div>
                    <div class="border px-2 py-1 bg-white rounded">{{ $invoice->balanceString }}</div>
                @endif
            </div>
            <!-- Totals -->
        </div>
        <!-- Table Footer -->

        <livewire:admin.invoice-lines.edit :invoice="$invoice"/>

        <!-- InvoiceLineDeleteModal -->
        <form wire:submit.prevent="delete">
            <x-jet-confirmation-modal wire:model="showDeleteModal">
                <x-slot name="title">Delete line</x-slot>
                <x-slot name="content">Are you sure you want to delete this line?</x-slot>
                <x-slot name="footer">
                    <div class="flex space-x-2">
                        <x-button.secondary wire:click="cancelDelete">Cancel</x-button.secondary>
                        <x-button.danger type="submit">Delete</x-button.danger>
                    </div>
                </x-slot>
            </x-jet-confirmation-modal>
        </form>
        <!-- InvoiceLineDeleteModal -->
    </div>
</div>
