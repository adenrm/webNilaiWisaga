<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Big+Shoulders:opsz,wght@10..72,100..900&family=Lalezar&display=swap');
        .lalezar-regular {
         font-family: "Lalezar", system-ui;
         font-weight: 400;
         font-style: normal;
        }

        </style>
    <div class="flex flex-row justify-center gap-10 overflow-hidden">
        <div class="w-1/2 bg-white shadow-2xl ">
            <div class="text-justify translate-y-60 mx-16">
                <img src="img/logo.png" class="w-96" alt="logo">
                <h1 class="text-3xl lalezar-regular ">membantu sekolah mengelola nilai siswa.</h1>
                <p>Berisi berbagai nilai yang telah di input oleh Bapak/i guru.</p>
            </div>
        </div>
        <x-authentication-card class="w-3/12">
            <h1 class="text-xl text-center text-black font-bold">Masukkan Email dan Password</h1>
            {{-- <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot> --}}
            
            <x-validation-errors class="mb-4" />
            
            @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
        @endsession
        
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-label for="email" class="text-black" value="{{ __('Email') }}" />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <x-label for="password" class="text-black" value="{{ __('Password') }}" />
            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="flex items-center">
                <x-checkbox id="remember_me" class="transition duration-500" name="remember" />
                <span class="ms-2 text-sm text-black">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex gap-4 items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-800 transition hover:text-cyan-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-button class="ms-4">
                {{ __('Log in') }}
            </x-button>
        </div>
    </form>
</x-authentication-card>
</div>
</x-guest-layout>
