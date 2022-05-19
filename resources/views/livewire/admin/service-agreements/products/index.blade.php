<x-table>
    <x-slot name="head">
        <x-table.heading>Product Description</x-table.heading>
        <x-table.heading>Qty</x-table.heading>
        <x-table.heading>Unit Price</x-table.heading>
        <x-table.heading>Sub Total (Ex GST)</x-table.heading>
        @if($showControls)
            <x-table.heading><span class="sr-only">Actions</span></x-table.heading>
        @endif
    </x-slot>
    <x-slot name="body">
        @forelse ($products as $product)
            <x-table.row>
                <x-table.cell>{{ $product->name }}</x-table.cell>
                <x-table.cell>{{ $product->qty }}</x-table.cell>
                <x-table.cell>{{ $product->unitPriceString }}</x-table.cell>
                <x-table.cell>{{ $product->extensionString }}</x-table.cell>
                @if($showControls)
                    <x-table.cell>
                        <x-small-button.danger wire:click="delete({{ $product->id }})" class="px-0.5">
                            <x-icon.x class="h-3 w-3"/>
                        </x-small-button.danger>
                    </x-table.cell>
                @endif
            </x-table.row>
        @empty
            <x-table.row>
                <x-table.cell colspan="5" class="text-gray-500 text-center italic text-md">No products</x-table.cell>
            </x-table.row>
        @endforelse
    </x-slot>
</x-table>
