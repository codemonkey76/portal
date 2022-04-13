<x-jet-action-section>
    <x-slot name="title">
        {{ __('Connect quickbooks') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Connect your quickbooks account to your ASG Communications portal user account.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->connected)
                    {{ __('You have connected your quickbooks account.') }}
            @else
                {{ __('You have not connected your quickbooks account.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('When your quickbooks account is connected, you will be able to import and synchronize quickbooks resources to the ASG Communications portal.') }}
            </p>
        </div>

        <div class="mt-5">
            @if (! $this->connected)
                <x-jet-confirms-password wire:then="connectQuickbooks">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Connect') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                <x-jet-confirms-password wire:then="disconnectQuickbooks">
                    <x-jet-secondary-button class="mr-3">
                        {{ __('Disconnect') }}
                    </x-jet-secondary-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
