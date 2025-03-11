<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    @vite('resources/css/app.css')
</head>
<body style="background-image: url('{{asset('img/background-1.jpg')}}')" class="bg-cover">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div style="backdrop-filter:blur(5px) brightness(110%);" class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-5">
                {{-- <img src="{{ asset('img/logo.png') }}" alt=""> --}}
                <a href="{{ route('admin.login') }}" class="text-9xl text-center font-bold font-sans">GURU</a>
            </div>
    
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="email">Email</label>
                    <input class="border-gray-300  block mt-1 w-full focus:border-primary focus:ring-primary rounded-md shadow-sm" type="text" name="email" required>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="password">Password</label>
                    <input class="border-gray-300  block mt-1 w-full focus:border-primary focus:ring-primary rounded-md shadow-sm" type="password" name="password" required>
                </div>
                <div class="flex gap-4 items-center justify-end mt-4">
                    <button class="ms-5 bg-secondary inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:text-white hover:bg-primary focus:bg-primary active:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" type="submit">Login</button>
                </div>
            </form>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</body>
</html>