<div>
    @if($agreement->mobileServices()->count())
        <x-table>
            <x-slot name="head">
                <x-table.heading>Service Number</x-table.heading>
                <x-table.heading>Provider</x-table.heading>
                <x-table.heading>Sub Total (Ex GST)</x-table.heading>
                @if($showControls)
                    <x-table.heading><span class="sr-only">Actions</span></x-table.heading>
                @endif
            </x-slot>
            <x-slot name="body">
                @foreach($agreement->mobileServices as $mobile_service)
                    <x-table.row>
                        <x-table.cell>{{ $mobile_service->mobile_number }}</x-table.cell>
                        <x-table.cell>{{ $mobile_service->service_provider->name }}</x-table.cell>
                        <x-table.cell>{{ $mobile_service->priceString }}</x-table.cell>
                        @if($showControls)
                            <x-table.cell>
                                <x-small-button.danger wire:click="delete({{ $mobile_service->id }})" class="px-0.5"><x-icon.x /></x-small-button.danger>
                            </x-table.cell>
                        @endif
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    @endif
</div>
