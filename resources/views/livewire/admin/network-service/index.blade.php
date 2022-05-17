<div>
    @if($agreement->network_services()->count())
        <x-table>
            <x-slot name="head">
                <x-table.heading>Service Description</x-table.heading>
                <x-table.heading>*Speed</x-table.heading>
                <x-table.heading>Sub Total (Ex GST)</x-table.heading>
                <x-table.heading><span class="sr-only">Actions</span></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($agreement->network_services as $network_service)
                    <x-table.row>
                        <x-table.cell>{{ $network_service->description }}</x-table.cell>
                        <x-table.cell>{{ $network_service->speed }}</x-table.cell>
                        <x-table.cell>{{ $network_service->priceString }}</x-table.cell>
                        <x-table.cell>
                            <x-small-button.danger wire:click="delete({{ $network_service->id }})" class="px-0.5">
                                <x-icon.x class="h-3 w-3"/>
                            </x-small-button.danger>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    @endif
</div>
