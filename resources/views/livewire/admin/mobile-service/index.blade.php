<div>
    @if($agreement->mobile_services()->count())
        <x-table>
            <x-slot name="head">
                <x-table.heading>Service Number</x-table.heading>
                <x-table.heading>Provider</x-table.heading>
                <x-table.heading>Sub Total (Ex GST)</x-table.heading>
                <x-table.heading><span class="sr-only">Actions</span></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($agreement->mobile_services as $mobile_service)
                    <x-table.row>
                        <x-table.cell>{{ $mobile_service->mobile_number }}</x-table.cell>
                        <x-table.cell>{{ $mobile_service->service_provider->name }}</x-table.cell>
                        <x-table.cell>{{ $mobile_service->priceString }}</x-table.cell>
                        <x-table.cell><x-small-button.danger wire:click="delete({{ $mobile_service->id }})" class="px-0.5"><x-icon.x /></x-small-button.danger></x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    @endif
</div>
