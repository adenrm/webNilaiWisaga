@extends('layouts.superadmin')

@section('title', 'Pengaturan')

@section('content')
<div x-data="{ 
    sidebarOpen: false,
    sidebarMinimized: localStorage.getItem('sidebarMinimized') === 'true',
    toggleSidebar() {
        this.sidebarMinimized = !this.sidebarMinimized;
        localStorage.setItem('sidebarMinimized', this.sidebarMinimized);
    }
}" class="flex h-screen bg-gray-50 overflow-hidden">
    <aside :class="{
            'w-64': !sidebarMinimized,
            'w-28': sidebarMinimized,
            'translate-x-0': sidebarOpen,
            '-translate-x-full lg:translate-x-0': !sidebarOpen
        }" 
        class="fixed inset-y-0 left-0 z-50 flex flex-col transition-all duration-300 ease-in-out bg-white border-r border-gray-200 lg:relative">
        <div class="flex items-center justify-between h-16 bg-indigo-700">
            <a href="{{ route('superadmin.dashboard') }}" class="flex items-center" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-8 w-8 text-white mx-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-white text-xl font-bold" x-show="!sidebarMinimized">SuperAdmin</span>
            </a>
            <button @click="toggleSidebar" class="p-2 text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-40 lg:block hidden mr-2">
                <svg x-show="!sidebarMinimized" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
                <svg x-show="sidebarMinimized" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </button>
        </div>
        <div class="flex items-center px-4 py-5 border-b border-gray-200" x-show="!sidebarMinimized">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                    <span class="text-lg font-medium text-indigo-600">{{ substr(Auth::guard('superadmin')->user()->name ?? 'A', 0, 1) }}</span>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">{{ Auth::guard('superadmin')->user()->name ?? 'Administrator' }}</p>
                <p class="text-xs font-medium text-gray-500">Super Administrator</p>
            </div>
        </div>
        <div class="flex justify-center py-5 border-b border-gray-200" x-show="sidebarMinimized" x-cloak>
            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                <span class="text-lg font-medium text-indigo-600">{{ substr(Auth::guard('superadmin')->user()->name ?? 'A', 0, 1) }}</span>
            </div>
        </div>
        <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
            <div class="px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Menu Utama</h3>
            </div>
            <a href="{{ route('superadmin.dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('superadmin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('superadmin.dashboard') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Dashboard</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Dashboard</div>
            </a>
            <div class="mt-8 px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Manajemen</h3>
            </div>
            <a href="{{ route('superadmin.users') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('superadmin.users') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('superadmin.users') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Manajemen User</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Manajemen User</div>
            </a>
            <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 text-gray-700" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Manajemen Nilai</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Manajemen Nilai</div>
            </a>
            <div class="mt-8 px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Konfigurasi</h3>
            </div>
            <a href="{{ route('superadmin.settings') }}" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('superadmin.settings') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('superadmin.settings') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Pengaturan</span>
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Pengaturan</div>
            </a>
            <div class="px-3 mt-8">
                <form method="POST" action="{{ route('superadmin.logout') }}">
                    @csrf
                    <button type="submit" class="group flex w-full items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-red-50 text-gray-700 hover:text-red-700" :class="{ 'justify-center': sidebarMinimized }">
                        <svg class="h-6 w-6 text-gray-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="ml-3" x-show="!sidebarMinimized">Logout</span>
                        <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Logout</div>
                    </button>
                </form>
            </div>
        </nav>
    </aside>
    <div class="flex-1 flex flex-col min-h-screen overflow-x-hidden" :class="{ 'lg:ml-0': !sidebarMinimized, 'lg:ml-0': sidebarMinimized }">
        <header class="sticky top-0 z-10 bg-white shadow">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <button @click="sidebarOpen = !sidebarOpen" type="button" class="lg:hidden text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md p-1">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1">
                        <h1 class="text-2xl font-semibold text-gray-900">Pengaturan</h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="space-y-8">
                        <!-- Profile Settings -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-gray-900">Profil</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Informasi profil dan pengaturan akun Anda.
                                    </p>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <div class="bg-white shadow-md rounded-lg">
                                    <div class="p-6">
                                        @if(session('success'))
                                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        <form action="{{ route('superadmin.profile.update') }}" method="POST" class="space-y-6">
                                            @csrf
                                            @method('PUT')

                                            <div>
                                                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                                <input type="text" name="name" id="name" value="{{ $superadmin->name }}"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                @error('name')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                                <input type="email" name="email" id="email" value="{{ $superadmin->email }}"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                @error('email')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                                <input type="text" name="phone" id="phone" value="{{ $superadmin->phone }}"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                @error('phone')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                                    Simpan Perubahan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security Settings -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-gray-900">Keamanan</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Pengaturan keamanan dan autentikasi akun.
                                    </p>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <div class="bg-white shadow-md rounded-lg">
                                    <div class="p-6">
                                        <form action="{{ route('superadmin.password.update') }}" method="POST" class="space-y-6">
                                            @csrf
                                            @method('PUT')

                                            <div>
                                                <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                                                <input type="password" name="current_password" id="current_password"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                @error('current_password')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                                <input type="password" name="password" id="password"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                @error('password')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                                    Perbarui Password
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notification Settings -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-gray-900">Notifikasi</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Atur preferensi notifikasi email dan sistem.
                                    </p>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <div class="bg-white shadow-md rounded-lg">
                                    <div class="p-6">
                                        <form action="{{ route('superadmin.notifications.update') }}" method="POST" class="space-y-6">
                                            @csrf
                                            @method('PUT')

                                            <div class="space-y-4">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <h4 class="text-sm font-medium text-gray-900">Email Notifikasi</h4>
                                                        <p class="text-sm text-gray-500">Terima notifikasi melalui email</p>
                                                    </div>
                                                    <button type="button" role="switch" 
                                                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 bg-gray-200"
                                                            x-data="{ on: false }"
                                                            :class="{ 'bg-blue-600': on, 'bg-gray-200': !on }"
                                                            @click="on = !on">
                                                        <span class="sr-only">Gunakan pengaturan</span>
                                                        <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                                              :class="{ 'translate-x-5': on, 'translate-x-0': !on }">
                                                        </span>
                                                    </button>
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <h4 class="text-sm font-medium text-gray-900">Notifikasi Browser</h4>
                                                        <p class="text-sm text-gray-500">Terima notifikasi melalui browser</p>
                                                    </div>
                                                    <button type="button" role="switch" 
                                                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 bg-gray-200"
                                                            x-data="{ on: false }"
                                                            :class="{ 'bg-blue-600': on, 'bg-gray-200': !on }"
                                                            @click="on = !on">
                                                        <span class="sr-only">Gunakan pengaturan</span>
                                                        <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                                              :class="{ 'translate-x-5': on, 'translate-x-0': !on }">
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                                    Simpan Pengaturan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- System Settings -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-gray-900">Sistem</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Pengaturan sistem dan maintenance.
                                    </p>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <div class="bg-white shadow-md rounded-lg">
                                    <div class="p-6">
                                        <div class="space-y-6">
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-900">Mode Maintenance</h4>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    Aktifkan mode maintenance untuk melakukan perbaikan sistem
                                                </p>
                                                <div class="mt-4">
                                                    <button type="button" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                                                        Aktifkan Mode Maintenance
                                                    </button>
                                                </div>
                                            </div>

                                            <div>
                                                <h4 class="text-sm font-medium text-gray-900">Backup Database</h4>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    Lakukan backup database sistem
                                                </p>
                                                <div class="mt-4">
                                                    <button type="button" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">
                                                        Mulai Backup
                                                    </button>
                                                </div>
                                            </div>

                                            <div>
                                                <h4 class="text-sm font-medium text-gray-900">Clear Cache</h4>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    Bersihkan cache sistem
                                                </p>
                                                <div class="mt-4">
                                                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                                        Clear Cache
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection 