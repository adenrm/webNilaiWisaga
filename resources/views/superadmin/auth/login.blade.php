<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <h2 class="text-2xl font-bold text-center mb-6">Login Super Admin</h2>

        <x-validation-errors class="mb-4" />

        @if (session('error'))
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('superadmin.login') }}">
            @csrf

            <div>
                <x-label for="email" value="Email" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Password" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="w-full justify-center">
                    Login
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> 