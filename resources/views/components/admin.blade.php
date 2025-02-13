<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('admin.dashboard') }}">
                                    {{-- <x-application-mark class="block h-9 w-auto" /> --}}
                                    <img src="{{asset('img/icon-crop.png')}}" class="block h-9 w-auto" alt="">
                                </a>
                            </div>
            
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="inline-flex items-center mt-5 px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out" type="submit">Logout</button>
                        </form>

            
                       
            
                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            
                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    </div>
            
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="shrink-0 me-3">
                                    <img class="size-10 rounded-full object-cover" src="{{ Auth::guard('admin')->user()->profile_photo_url }}" alt="{{ Auth::guard('admin')->user()->name }}" />
                                </div>
                            @endif
            
                            <div>
                                <div class="font-medium text-base text-gray-800">{{ Auth::guard('admin')->user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::guard('admin')->user()->email }}</div>
                            </div>
                        </div>
            
                        <div class="mt-3 space-y-1">
                            <!-- Account Management -->
                            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>
            
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                    {{ __('API Tokens') }}
                                </x-responsive-nav-link>
                            @endif
            
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
            
                                <x-responsive-nav-link href="{{ route('logout') }}"
                                               @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
            
                            <!-- Team Management -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="border-t border-gray-200"></div>
            
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>
            
                                <!-- Team Settings -->
                                <x-responsive-nav-link href="{{ route('teams.show', Auth::guard('admin')->user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                    {{ __('Team Settings') }}
                                </x-responsive-nav-link>
            
                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                        {{ __('Create New Team') }}
                                    </x-responsive-nav-link>
                                @endcan
            
                                <!-- Team Switcher -->
                                @if (Auth::guard('admin')->user()->allTeams()->count() > 1)
                                    <div class="border-t border-gray-200"></div>
            
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>
            
                                    @foreach (Auth::guard('admin')->user()->allTeams() as $team)
                                        <x-switchable-team :team="$team" component="responsive-nav-link" />
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
            

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
