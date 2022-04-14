<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('invites.process') }}">
            @csrf

            <div class="space-y-4">
                <x-input.group for="name" label="{{ __('Name') }}" :error="$errors->first('name')">
                    <x-input.text name="name" id="name" :value="old('name', $invite->name)" required autofocus :has-error="$errors->has('name')"/>
                </x-input.group>

                <x-input.group for="email" label="{{ __('Email') }}" :error="$errors->first('email')">
                    <x-input.text name="email" id="email" type="email" :value="old('email', $invite->email)" required :has-error="$errors->has('email')" />
                </x-input>

                <input name="token" type="hidden" value="{{ $invite->token }}">
                <input name="customer_id" type="hidden" value="{{ $invite->customer_id }}">

                <x-input.group for="password" label="{{ __('Password') }}" :error="$errors->first('password')">
                    <x-input.text id="password" type="password" name="password" required autocomplete="new-password" :has-error="$errors->has('password')" />
                </x-input.group>

                <x-input.group for="password_confirmation" label="{{ __('Confirm Password') }}" :error="$errors->first('password_confirmation')">
                    <x-input.text id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" :has-error="$errors->has('password_confirmation')" />
                </x-input.group>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
