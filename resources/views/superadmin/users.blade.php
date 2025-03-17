@extends('layouts.superadmin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div x-data="{ 
    sidebarOpen: false,
    sidebarMinimized: localStorage.getItem('sidebarMinimized') === 'true',
    toggleSidebar() {
        this.sidebarMinimized = !this.sidebarMinimized;
        localStorage.setItem('sidebarMinimized', this.sidebarMinimized);
    }
}" class="flex h-screen bg-gray-50 overflow-hidden">
    <!-- Sidebar -->
    <aside :class="{
            'w-64': !sidebarMinimized,
            'w-28': sidebarMinimized,
            'translate-x-0': sidebarOpen,
            '-translate-x-full lg:translate-x-0': !sidebarOpen
        }" 
        class="fixed inset-y-0 left-0 z-50 flex flex-col transition-all duration-300 ease-in-out bg-white border-r border-gray-200 lg:sticky">
        
        <!-- Logo -->
        <div class="flex items-center justify-between h-16 bg-indigo-700">
            <a href="{{ route('superadmin.dashboard') }}" class="flex items-center" :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-8 w-8 text-white mx-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-white text-xl font-bold" x-show="!sidebarMinimized">SuperAdmin</span>
            </a>
            <!-- Toggle Minimize Button -->
            <button @click="toggleSidebar" class="p-2 text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-40 lg:block hidden mr-2">
                <svg x-show="!sidebarMinimized" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
                <svg x-show="sidebarMinimized" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Profile Preview -->
        <div class="flex items-center px-4 py-5 border-b border-gray-200" x-show="!sidebarMinimized">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                    <span class="text-lg font-medium text-indigo-600">
                        {{ substr(Auth::guard('superadmin')->user()->name ?? 'A', 0, 1) }}
                    </span>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                    {{ Auth::guard('superadmin')->user()->name ?? 'Administrator' }}
                </p>
                <p class="text-xs font-medium text-gray-500">
                    Super Administrator
                </p>
            </div>
        </div>

        <!-- Minimized Profile -->
        <div class="flex justify-center py-5 border-b border-gray-200" x-show="sidebarMinimized" x-cloak>
            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                <span class="text-lg font-medium text-indigo-600">
                    {{ substr(Auth::guard('superadmin')->user()->name ?? 'A', 0, 1) }}
                </span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
            <!-- Menu Utama -->
            <div class="px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Menu Utama</h3>
            </div>
            
            <a href="{{ route('superadmin.dashboard') }}" 
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('superadmin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}"
               :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('superadmin.dashboard') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Dashboard</span>
                <!-- Tooltip untuk mode minimize -->
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    Dashboard
                </div>
            </a>

            <!-- Menu Manajemen -->
            <div class="mt-8 px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Manajemen</h3>
            </div>

            <a href="{{ route('superadmin.users') }}" 
               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('superadmin.users') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}"
               :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('superadmin.users') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Manajemen User</span>
                <!-- Tooltip -->
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    Manajemen User
                </div>
            </a>

            <a href="{{ route('superadmin.nilai') }}" 
               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 text-gray-700"
               :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Manajemen Nilai</span>
                <!-- Tooltip -->
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    Manajemen Nilai
                </div>
            </a>

            <!-- Menu Konfigurasi -->
            <div class="mt-8 px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Konfigurasi</h3>
            </div>

            <a href="{{ route('superadmin.settings') }}" 
               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 {{ request()->routeIs('superadmin.settings') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700' }}"
               :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 {{ request()->routeIs('superadmin.settings') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Pengaturan</span>
                <!-- Tooltip -->
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    Pengaturan
                </div>
            </a>

            {{-- <!-- Menu Laporan -->
            <div class="mt-8 px-3 pb-2" x-show="!sidebarMinimized">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Laporan</h3>
            </div>

            <a href="#" 
               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-gray-100 text-gray-700"
               :class="{ 'justify-center': sidebarMinimized }">
                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="ml-3" x-show="!sidebarMinimized">Laporan Nilai</span>
                <!-- Tooltip -->
                <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    Laporan Nilai
                </div>
            </a> --}}

            <!-- Logout Button -->
            <div class="px-3 mt-8">
                <form method="POST" action="{{ route('superadmin.logout') }}">
                    @csrf
                    <button type="submit" 
                            class="group flex w-full items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150 hover:bg-red-50 text-gray-700 hover:text-red-700"
                            :class="{ 'justify-center': sidebarMinimized }">
                        <svg class="h-6 w-6 text-gray-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="ml-3" x-show="!sidebarMinimized">Logout</span>
                        <!-- Tooltip -->
                        <div x-show="sidebarMinimized" class="absolute left-full ml-6 px-2 py-1 bg-gray-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            Logout
                        </div>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen" :class="{ 'lg:pl-0': !sidebarMinimized, 'lg:pl-0': sidebarMinimized }">
        <!-- Top Navigation -->
        <header class="sticky top-0 z-10 bg-white shadow">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = !sidebarOpen" type="button" class="lg:hidden text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md p-1">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1">
                        <h1 class="text-2xl font-semibold text-gray-900">Manajemen Pengguna</h1>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="space-y-8">
                        <!-- Stats Overview -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center">
                                    <div class="p-3 bg-blue-700 bg-opacity-30 rounded-full">
                                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4 text-white">
                                        <p class="text-sm font-medium">Total Admin</p>
                                        <p class="text-2xl font-bold">{{ $admins->total() }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center">
                                    <div class="p-3 bg-green-700 bg-opacity-30 rounded-full">
                                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4 text-white">
                                        <p class="text-sm font-medium">Total Pengguna</p>
                                        <p class="text-2xl font-bold">{{ $users->total() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin List -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                                    <div>
                                        <h2 class="text-2xl font-bold text-gray-800">Daftar Admin</h2>
                                        <p class="text-gray-500 mt-1">Kelola semua admin dalam sistem</p>
                                    </div>
                                    <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150 shadow-md" onclick="openAddModal('admin')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Tambah Admin
                                    </button>
                                </div>

                                <div class="overflow-x-auto rounded-lg border border-gray-100">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr class="bg-gray-50">
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Study</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse($admins as $admin)
                                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="h-10 w-10 flex-shrink-0 bg-blue-100 rounded-full flex items-center justify-center">
                                                            <span class="text-blue-800 font-medium text-lg">{{ substr($admin->name, 0, 1) }}</span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $admin->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ $admin->email }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ $admin->studies->implode('name') ?? 'N/A' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <form action="{{ route('superadmin.users.updateStatus', $admin->id) }}" method="POST" class="status-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" onchange="this.form.submit()" class="text-sm rounded-full px-3 py-1 font-semibold transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-1
                                                            @if($admin->status === 'active') bg-green-100 text-green-800 hover:bg-green-200 focus:ring-green-500
                                                            @else bg-red-100 text-red-800 hover:bg-red-200 focus:ring-red-500 @endif">
                                                            <option value="active" {{ $admin->status === 'active' ? 'selected' : '' }}>Aktif</option>
                                                            <option value="inactive" {{ $admin->status === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div x-data="{ isAdminOpen: false }">
                                                        <div  @mouseover="isAdminOpen = true"
                                                        @mouseleave="isAdminOpen = false"
                                                         class="text-sm text-gray-500">{{ $admin->created_at->format('d M Y') }}</div>
                                                    
                                                            <div x-show="isAdminOpen"
                                                                 x-transition:enter="transition ease-out duration-300"
                                                                 x-transition:enter-start="opacity-0 transform scale-95"
                                                                 x-transition:enter-end="opacity-100 transform scale-100"
                                                                 x-transition:leave="transition ease-in duration-200"
                                                                 x-transition:leave-start="opacity-100 transform scale-100"
                                                                 x-transition:leave-end="opacity-0 transform scale-95"
                                                                 class="popover absolute bg-gray-700 border shadow-md mt-2 px-4 py-2 rounded-lg">
                                                                
                                                                <p class="text-white">{{ $admin->created_at->diffForHumans() }}</p>
                                                            </div>
                                                        </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                                    <button class="inline-flex items-center text-blue-600 hover:text-blue-900 transition-colors duration-150" onclick="openEditModal('admin', {{ $admin->id }}, '{{ $admin->name }}', '{{ $admin->email }}')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Edit
                                                    </button>
                                                    <button class="inline-flex items-center text-red-600 hover:text-red-900 transition-colors duration-150" onclick="openDeleteModal('admin', {{ $admin->id }}, '{{ $admin->name }}')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                                    <div class="flex flex-col items-center">
                                                        <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <p>Tidak ada data admin</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    {{ $admins->links() }}
                                </div>
                            </div>
                        </div>

                        <!-- Users List -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                                    <div>
                                        <h2 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h2>
                                        <p class="text-gray-500 mt-1">Kelola semua pengguna dalam sistem</p>
                                    </div>
                                    <button class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150 shadow-md" onclick="openAddModal('user')">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Tambah Pengguna
                                    </button>
                                </div>

                                <div class="overflow-x-auto rounded-lg border border-gray-100">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr class="bg-gray-50">
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rombel</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse($users as $user)
                                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="h-10 w-10 flex-shrink-0 bg-green-100 rounded-full flex items-center justify-center">
                                                            <span class="text-green-800 font-medium text-lg">{{ substr($user->name, 0, 1) }}</span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-500">{{ $user->class ?? 'N/A' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <form action="{{ route('superadmin.users.updateStatus', $user->id) }}" method="POST" class="status-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" onchange="this.form.submit()" class="text-sm rounded-full px-3 py-1 font-semibold transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-1
                                                            @if($user->status === 'active') bg-green-100 text-green-800 hover:bg-green-200 focus:ring-green-500
                                                            @else bg-red-100 text-red-800 hover:bg-red-200 focus:ring-red-500 @endif">
                                                            <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Aktif</option>
                                                            <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div x-data="{ isUserOpen: false }">
                                                        <div  @mouseover="isUserOpen = true"
                                                        @mouseleave="isUserOpen = false"
                                                         class="text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</div>
                                                    
                                                            <div x-show="isUserOpen"
                                                                 x-transition:enter="transition ease-out duration-300"
                                                                 x-transition:enter-start="opacity-0 transform scale-95"
                                                                 x-transition:enter-end="opacity-100 transform scale-100"
                                                                 x-transition:leave="transition ease-in duration-200"
                                                                 x-transition:leave-start="opacity-100 transform scale-100"
                                                                 x-transition:leave-end="opacity-0 transform scale-95"
                                                                 class="popover absolute bg-gray-700 border shadow-md mt-2 px-4 py-2 rounded-lg">
                                                                
                                                                <p class="text-white">{{ $user->created_at->diffForHumans() }}</p>
                                                            </div>
                                                        </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                                    <button class="inline-flex items-center text-blue-600 hover:text-blue-900 transition-colors duration-150" onclick="openEditModal('user', {{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Edit
                                                    </button>
                                                    <button class="inline-flex items-center text-red-600 hover:text-red-900 transition-colors duration-150" onclick="openDeleteModal('user', {{ $user->id }}, '{{ $user->name }}')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                                    <div class="flex flex-col items-center">
                                                        <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <p>Tidak ada data pengguna</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-gray-800 bg-opacity-60 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-6 border w-full max-w-md shadow-2xl rounded-xl bg-white transform transition-all duration-300">
        <div class="absolute top-3 right-3">
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gray-400 rounded-full p-1">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-5" id="editModalTitle">Edit Pengguna</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="editId" name="id">
                <input type="hidden" id="editType" name="type">
                
                <div class="mb-4">
                    <label for="editName" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" id="editName" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                </div>
                
                <div class="mb-4">
                    <label for="editEmail" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="editEmail" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                </div>
                
                <div class="mb-6">
                    <label for="editPassword" class="block text-sm font-medium text-gray-700 mb-1">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" id="editPassword" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                </div>
                
                <div class="flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors duration-150 shadow-sm">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150 shadow-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-60 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-6 border w-full max-w-md shadow-2xl rounded-xl bg-white transform transition-all duration-300">
        <div class="absolute top-3 right-3">
            <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gray-400 rounded-full p-1">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div>
            <div class="flex items-center mb-5 text-red-600">
                <svg class="h-8 w-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-900">Konfirmasi Hapus</h3>
            </div>
            <p class="text-sm text-gray-500 mb-6" id="deleteModalText">
                Apakah Anda yakin ingin menghapus pengguna ini?
            </p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" id="deleteId" name="id">
                <input type="hidden" id="deleteType" name="type">
                
                <div class="flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors duration-150 shadow-sm">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150 shadow-sm">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div id="addModal" class="fixed inset-0 bg-gray-800 bg-opacity-60 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-6 border w-full max-w-md shadow-2xl rounded-xl bg-white transform transition-all duration-300">
        <div class="absolute top-3 right-3">
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gray-400 rounded-full p-1">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-5" id="addModalTitle">Tambah Pengguna</h3>
            <form id="addForm" method="POST">
                @csrf
                <input type="hidden" id="addType" name="type">
                
                <div class="mb-4">
                    <label for="addName" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" id="addName" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200" required>
                </div>
                
                <div class="mb-4">
                    <label for="addEmail" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="addEmail" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200" required>
                </div>
                
                <div class="mb-6">
                    <label for="addPassword" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="addPassword" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200" required>
                </div>
                
                <div class="flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors duration-150 shadow-sm">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150 shadow-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Notifications -->
@if(session('success'))
<div id="notification" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl transform transition-all duration-500 translate-y-0 flex items-center z-50">
    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
    </svg>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div id="notification" class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-xl transform transition-all duration-500 translate-y-0 flex items-center z-50">
    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
    {{ session('error') }}
</div>
@endif

@push('scripts')
<script>
    // Auto-submit form when status changes
    document.querySelectorAll('.status-form select').forEach(select => {
        select.addEventListener('change', function() {
            this.closest('form').submit();
        });
    });

    // Notification auto-hide
    const notification = document.getElementById('notification');
    if (notification) {
        setTimeout(() => {
            notification.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }

    // Modal Functions
    function openEditModal(type, id, name, email) {
        document.getElementById('editModalTitle').innerText = type === 'admin' ? 'Edit Admin' : 'Edit Pengguna';
        document.getElementById('editId').value = id;
        document.getElementById('editType').value = type;
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editPassword').value = '';
        
        document.getElementById('editForm').action = "{{ route('superadmin.users.update', '') }}/" + id;
        
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.querySelector('.relative').classList.add('animate-modalEnter');
        setTimeout(() => document.getElementById('editName').focus(), 100);
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.querySelector('.relative').classList.remove('animate-modalEnter');
        modal.classList.add('hidden');
    }

    function openDeleteModal(type, id, name) {
        document.getElementById('deleteModalText').innerText = `Apakah Anda yakin ingin menghapus ${type === 'admin' ? 'admin' : 'pengguna'} "${name}"?`;
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteType').value = type;
        
        document.getElementById('deleteForm').action = "{{ route('superadmin.users.destroy', '') }}/" + id;
        
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.querySelector('.relative').classList.add('animate-modalEnter');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.querySelector('.relative').classList.remove('animate-modalEnter');
        modal.classList.add('hidden');
    }

    function openAddModal(type) {
        document.getElementById('addModalTitle').innerText = type === 'admin' ? 'Tambah Admin' : 'Tambah Pengguna';
        document.getElementById('addType').value = type;
        document.getElementById('addName').value = '';
        document.getElementById('addEmail').value = '';
        document.getElementById('addPassword').value = '';
        
        document.getElementById('addForm').action = "{{ route('superadmin.users.store') }}";
        
        const modal = document.getElementById('addModal');
        modal.classList.remove('hidden');
        modal.querySelector('.relative').classList.add('animate-modalEnter');
        setTimeout(() => document.getElementById('addName').focus(), 100);
    }

    function closeAddModal() {
        const modal = document.getElementById('addModal');
        modal.querySelector('.relative').classList.remove('animate-modalEnter');
        modal.classList.add('hidden');
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        const modals = [
            { element: document.getElementById('editModal'), close: closeEditModal },
            { element: document.getElementById('deleteModal'), close: closeDeleteModal },
            { element: document.getElementById('addModal'), close: closeAddModal }
        ];

        modals.forEach(({ element, close }) => {
            if (event.target === element) {
                close();
            }
        });
    }

    // Close modals with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeEditModal();
            closeDeleteModal();
            closeAddModal();
        }
    });

    // Add animation classes
    document.head.insertAdjacentHTML('beforeend', `
        <style>
            @keyframes modalEnter {
                from { opacity: 0; transform: scale(0.95); }
                to { opacity: 1; transform: scale(1); }
            }
            .animate-modalEnter {
                animation: modalEnter 0.2s ease-out forwards;
            }
        </style>
    `);
</script>
@endpush
@endsection 