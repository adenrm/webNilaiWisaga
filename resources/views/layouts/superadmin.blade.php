<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js (single include) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        /* Sidebar styling */
        .sidebar-item {
            @apply flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200;
        }
        
        .sidebar-item-active {
            @apply bg-indigo-600 text-white;
        }
        
        .sidebar-item-inactive {
            @apply text-gray-700 hover:bg-indigo-50 hover:text-indigo-700;
        }
        
        .sidebar-icon {
            @apply mr-3 h-6 w-6 transition-colors duration-150;
        }
        
        .sidebar-icon-active {
            @apply text-white;
        }
        
        .sidebar-icon-inactive {
            @apply text-gray-500 group-hover:text-indigo-600;
        }
        
        /* Custom transitions */
        .fade-enter-active, .fade-leave-active {
            transition: opacity 0.3s;
        }
        .fade-enter-from, .fade-leave-to {
            opacity: 0;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('modals')
    @stack('scripts')
</body>
</html> 