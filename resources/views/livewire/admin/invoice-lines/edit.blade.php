<div>
    @if ($editing)
        <form wire:submit.prevent="save">
            <x-jet-dialog-modal wire:model="showModal">
                <x-slot name="title">Edit Line</x-slot>
                <x-slot name="content">
                    <div class="space-y-4">
                        <x-input.group for="item" label="Item">
                            <x-select wire:model="editing.item_id" name="item">
                                @foreach($items as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </x-select>
                        </x-input.group>
                        <x-input.group for="description" label="Description">
                            <x-input.textarea name="description" wire:model="editing.description"/>
                        </x-input.group>
                        <div class="w-48">
                            <x-input.group for="qty" label="Qty" class="w-1/4">
                                <x-input.text name="qty" wire:model="editing.qty"/>
                            </x-input.group>
                        </div>
                        <div class="w-48">
                            <x-input.group for="unit_price" label="Unit Price">
                                <x-input.text leading-add-on="$" name="unit_price" wire:model="editing.unit_price"/>
                            </x-input.group>
                        </div>
                        <div class="w-48">
                            <x-input.group for="amount" label="Amount">
                                <x-input.text leading-add-on="$"
                                              name="amount"
                                              wire:model="editing.amount"
                                              readonly/>
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
            </x-jet-dialog-modal>
        </form>
    @endif
</div>
