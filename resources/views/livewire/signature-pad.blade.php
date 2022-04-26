<div  class="relative shadow-xl bg-white rounded-lg p-6 flex flex-col gap-4">
    <form wire:submit.prevent="submit">
        <x-signature-pad wire:model.defer="signature" />
        <x-button.danger wire:click="clear">Clear</x-button.danger>
        <x-button.primary type="submit">Submit</x-button.primary>
    </form>
</div>
