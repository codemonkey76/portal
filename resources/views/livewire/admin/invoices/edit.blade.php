<div>
    Hello World
    @if($invoice)
        <form wire:submit.prevent="save">
            <x-modal.dialog wire:model="show">
                <x-slot name="title">Edit Invoice</x-slot>
                <x-slot name="content">
                    <x-input.group for="customer_name" label="Customer">
                        <x-input.text :value="$invoice->customer->company_name" readonly />
                    </x-input.group>
                    <x-input.group for="customer_email" label="Customer email">
                        <x-input.text :value="$invoice->bill_email" readonly />
                    </x-input.group>

                    Terms
                    Invoice No.
                    Invoice Date
                    Due Date
                    Items
                    Message on Invoice
                </x-slot>
                <x-slot name="footer">
                    <div class="flex-1 flex justify-between">
                        <x-button.secondary>Cancel</x-button.secondary>
                        <div class="flex space-x-2">
                            <x-button.secondary>Save</x-button.secondary>
                            <x-button.primary>Save and send</x-button.primary>
                        </div>
                    </div>
                </x-slot>
            </x-modal.dialog>
        </form>
    @endif
</div>
