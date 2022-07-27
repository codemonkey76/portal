<div class="px-4 sm:px-6 lg:px-8">
    <!-- Page Heading -->
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Quickbooks Utilities</h1>
            <p class="mt-2 text-sm text-gray-700">Used to interact with the Quickbooks API.</p>
            <div class="space-y-4 pt-4">
                <h2 class="text-lg font-semibold text-gray-900">Functions</h2>

                <div class="flex space-y-2 flex-col">
                    <x-button.primary wire:click="quickbooksSetup" :disabled="$setupInProgress">Setup Quickbooks</x-button.primary>
                    <x-button.primary wire:click="quickbooksCleanup">Cleanup Quickbooks</x-button.primary>
                </div>
                <x-input.textarea rows="20" readonly wire:model="output"/>
            </div>

        </div>
    </div>
</div>
