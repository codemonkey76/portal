<form wire:submit.prevent="submit">
    <div class="flex flex-col space-y-2">
        <x-signature-pad wire:model.defer="signature" />
        <div class="space-x-2 flex">
            <x-small-button.danger wire:click="clear">Clear</x-small-button.danger>
            <x-small-button.primary type="submit">Submit</x-small-button.primary>
        </div>
    </div>
</form>
