<form wire:submit.prevent="save">
    <x-modal.dialog wire:model="showModal">
        <x-slot name="title">Edit Product</x-slot>
        <x-slot name="content">
            <div class="space-y-4">
                <x-input.group for="product" label="Product">
                    <x-select name="product" wire:model="product.product_id">
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </x-select>
                </x-input.group>
                <x-input.group for="name" label="Description" :error="$errors->first('product.name')">
                    <x-input.text name="name" wire:model="product.name" :has-error="$errors->has('product.name')" />
                </x-input.group>

                <x-input.group for="qty" label="Qty" :error="$errors->first('product.qty')">
                    <x-input.text name="qty" type="number" min="1" wire:model="product.qty" :has-error="$errors->has('product.qty')" />
                </x-input.group>

                <x-input.group for="price" label="Price (ex GST)" :error="$errors->first('product.unit_price')">
                    <x-input.text leading-add-on="$" name="price" wire:model="product.unit_price" :has-error="$errors->has('product.unit_price')"/>
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
