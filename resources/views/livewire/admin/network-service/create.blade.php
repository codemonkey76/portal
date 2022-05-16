<form wire:submit.prevent="save">
    <x-modal.dialog wire:model="showModal">
        <x-slot name="title">Edit Network Service</x-slot>
        <x-slot name="content">
            <div class="space-y-4">
                <x-input.group for="description" label="Description">
                    <x-input.text name="description" wire:model="network.description" />
                </x-input.group>

                <div class="grid grid-cols-2 gap-x-2">
                    <x-input.group for="service_id" label="Service ID">
                        <x-input.text name="service_id" wire:model="network.service_id" />
                    </x-input.group>
                    <x-input.group for="ip_address" label="IP Address">
                        <x-input.text name="ip_address" wire:model="network.ip_address" />
                    </x-input.group>
                </div>

                <div class="grid gap-x-2 grid-cols-3">
                    <x-input.group for="carrier" label="Carrier">
                        <x-select name="carrier" wire:model="network.carrier">
                            @foreach ($carriers as $carrier)
                                <option>{{ $carrier }}</option>
                            @endforeach
                        </x-select>
                    </x-input.group>

                    <x-input.group for="service_type" label="Type">
                        <x-select name="service_type" wire:model="network.service_type">
                            @foreach ($service_types as $type)
                                <option>{{ $type }}</option>
                            @endforeach
                        </x-select>
                    </x-input.group>

                    <x-input.group for="speed" label="Speed">
                        <x-select name="speed" wire:model="network.speed">
                            @foreach ($network_speeds as $speed)
                                <option value="{{ $speed->id }}">{{ $speed->name }} ({{ $speed->priceString }})</option>
                            @endforeach
                        </x-select>
                    </x-input.group>
                </div>

                <div class="grid grid-cols-2 gap-x-2">
                    <x-input.group for="username" label="Username">
                        <x-input.text name="username" data-lpignore="true" wire:model="network.username" />
                    </x-input.group>

                    <x-input.group for="password" label="Password">
                        <x-input.text name="password" data-lpignore="true" wire:model="network.password" />
                    </x-input.group>
                </div>

                <div class="grid grid-cols-2 gap-x-2">
                    <x-input.group for="end_user" label="End User">
                        <x-input.text name="end_user" wire:model="network.end_user" />
                    </x-input.group>

                    <x-input.group for="site_name" label="Site Name">
                        <x-input.text name="site_name" wire:model="network.site_name" />
                    </x-input.group>
                </div>

                <x-input.group for="site_address" label="Site Address">
                    <x-input.text name="site_address" wire:model="network.site_address" />
                </x-input.group>

                <div class="grid grid-cols-2 gap-x-2">
                    <x-input.group for="frequency" label="Frequency">
                        <x-select name="terms" wire:model="network.frequency">
                            @foreach ($frequencies as $frequency)
                                <option value="{{ $frequency->value }}">{{ $frequency->name }}</option>
                            @endforeach
                        </x-select>
                    </x-input.group>
                    <x-input.group for="price" label="Price (ex GST)">
                        <x-input.text name="price" wire:model="network.price" />
                    </x-input.group>
                </div>
            </div>

            <x-jet-validation-errors />
        </x-slot>
        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-button.secondary wire:click="$set('showModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </div>
        </x-slot>
    </x-modal.dialog>
</form>
