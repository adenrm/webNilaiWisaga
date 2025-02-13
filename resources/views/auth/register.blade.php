<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div>
                <x-label for="class" value="{{ __('Rombel') }}" />
                <select class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm block mt-1 w-full" name="class" id="class">
                    <option value="" disabled selected>Pilih Rombel</option>
                    <option value="X-PPLG">X-PPLG</option>
                    <option value="XI-PPLG">XI-PPLG</option>
                    <option value="XII-PPLG">XII-PPLG</option>
                    <option value="X-TJKT">X-TJKT</option>
                    <option value="XI-TJKT">XI-TJKT</option>
                    <option value="XII-TJKT">XII-TJKT</option>
                    <option value="X-PMN">X-PMN</option>
                    <option value="XI-PMN">XI-PMN</option>
                    <option value="XII-PMN">XII-PMN</option>
                    <option value="X-HTL">X-HTL</option>
                    <option value="XI-HTL">XI-HTL</option>
                    <option value="XII-HTL">XII-HTL</option>
                </select>
            </div>

            <div>
                <x-label for="gender" value="{{ __('Gender') }}" />
                <select class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm block mt-1 w-full" name="gender" id="gender">
                    <option value="" disabled selected>Pilih Gender</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 transition hover:text-white hover:font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
