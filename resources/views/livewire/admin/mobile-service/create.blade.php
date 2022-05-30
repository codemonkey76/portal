<form wire:submit.prevent="saveMobileService">
    <x-modal.dialog wire:model="showModal">
        <x-slot name="title">Edit Mobile Service</x-slot>
        <x-slot name="content">
            <div class="space-y-4">
                <x-input.group for="mobile_number" label="Mobile Number" :error="$errors->first('mobile_service.mobile_number')">
                    <x-input.text name="mobile_number" wire:model="mobile_service.mobile_number" :has-error="$errors->has('mobile_service.mobile_number')"/>
                </x-input.group>

                <x-input.group for="mobile_provider" label="Mobile Provider" :error="$errors->first('mobile_service.service_provider_id')">
                    <x-select wire:model="mobile_service.service_provider_id" :has-error="$errors->has('mobile_service.service_provider_id')">
                        @foreach ($mobile_service_providers as $provider)
                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                        @endforeach
                    </x-select>
                </x-input.group>

                <x-input.group for="price" label="Price (ex GST)" :error="$errors->first('mobile_service.price')">
                    <x-input.text leading-add-on="$" name="price" wire:model="mobile_service.price" :has-error="$errors->has('mobile_service.price')"/>
                </x-input.group>
                <x-jet-validation-errors />
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-button.secondary wire:click="$set('showModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </div>
        </x-slot>
    </x-modal.dialog>
</form>
