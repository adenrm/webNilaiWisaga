@extends('layouts.superadmin')

@section('title', 'Manajemen Nilai')

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

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen" :class="{ 'lg:pl-0': !sidebarMinimized, 'lg:pl-0': sidebarMinimized }">
        <!-- Top Navigation -->
        <header class="sticky top-0 z-10 bg-white shadow">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <button @click="sidebarOpen = !sidebarOpen" type="button" class="lg:hidden text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md p-1">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1">
                        <h1 class="text-2xl font-semibold text-gray-900">Manajemen Nilai</h1>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Statistik Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-blue-700 bg-opacity-30 rounded-full">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <div class="ml-4 text-white">
                                    <p class="text-sm font-medium">Total Nilai</p>
                                    <p class="text-2xl font-bold">{{ $totalNilai ?? 0 }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-700 bg-opacity-30 rounded-full">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4 text-white">
                                    <p class="text-sm font-medium">Rata-rata Nilai</p>
                                    <p class="text-2xl font-bold">{{ $averageNilai ?? 0 }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-purple-700 bg-opacity-30 rounded-full">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </div>
                                <div class="ml-4 text-white">
                                    <p class="text-sm font-medium">Input Hari Ini</p>
                                    <p class="text-2xl font-bold">{{ $todayInputs ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Nilai -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800">Daftar Nilai</h2>
                                    <p class="text-gray-500 mt-1">Kelola semua nilai dalam sistem</p>
                                </div>
                                <div class="flex space-x-3">
                                    <button class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150 shadow-md" onclick="window.location.href='{{ route('export.value') }}'">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Export Excel
                                    </button>
                                    <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150 shadow-md" onclick="openAddModal()">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Tambah Nilai
                                    </button>
                                </div>
                            </div>

                            <div class="overflow-x-auto rounded-lg border border-gray-100">
                                @livewire('valueTable')
                            </div>

                            @if(isset($nilai))
                            <div class="mt-4">
                                {{ $nilai->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Add/Edit -->
<div id="formModal" class="fixed inset-0 bg-gray-800 bg-opacity-60 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-6 border w-full max-w-md shadow-2xl rounded-xl bg-white transform transition-all duration-300">
        <div class="absolute top-3 right-3">
            <button onclick="closeFormModal()" class="text-gray-400 hover:text-gray-600 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gray-400 rounded-full p-1">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-5" id="modalTitle">Tambah Nilai</h3>
            <form id="nilaiForm" method="POST" action="{{ route('nilai.store') }}">
                @csrf
                <input type="hidden" id="nilai_id" name="id">
                <div class="space-y-4">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                        <select id="user_id" name="user_id" class="form-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Siswa</option>
                            @foreach($siswa ?? [] as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="studys_id" class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                        <select id="studys_id" name="studys_id" class="form-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach($studys ?? [] as $study)
                                <option value="{{ $study->id }}">{{ $study->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="study" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelajaran</label>
                        <input type="text" id="study" name="study" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="value_dt1" class="block text-sm font-medium text-gray-700 mb-1">Nilai DT1</label>
                        <input type="number" id="value_dt1" name="value_dt1" min="0" max="100" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="value_dt2" class="block text-sm font-medium text-gray-700 mb-1">Nilai DT2</label>
                        <input type="number" id="value_dt2" name="value_dt2" min="0" max="100" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="value_mss" class="block text-sm font-medium text-gray-700 mb-1">Nilai MSS</label>
                        <input type="number" id="value_mss" name="value_mss" min="0" max="100" class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeFormModal()" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors duration-150">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150">
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
            <p class="text-sm text-gray-500 mb-6">
                Apakah Anda yakin ingin menghapus nilai ini? Tindakan ini tidak dapat dibatalkan.
            </p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors duration-150">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Form Modal Functions
    function openAddModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Nilai';
        document.getElementById('nilaiForm').reset();
        document.getElementById('nilaiForm').action = "{{ route('nilai.store') }}";
        document.getElementById('nilai_id').value = '';
        document.getElementById('formModal').classList.remove('hidden');
    }

    function openEditModal(id) {
        document.getElementById('modalTitle').innerText = 'Edit Nilai';
        document.getElementById('nilaiForm').action = `{{ route('nilai.update', '') }}/${id}`;
        document.getElementById('nilai_id').value = id;
        document.getElementById('formModal').classList.remove('hidden');
        
        // Fetch nilai data and populate form
        // Add your fetch logic here
    }

    function closeFormModal() {
        document.getElementById('formModal').classList.add('hidden');
    }

    // Delete Modal Functions
    function openDeleteModal(id) {
        document.getElementById('deleteForm').action = `{{ route('nilai.destroy', '') }}/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        const formModal = document.getElementById('formModal');
        const deleteModal = document.getElementById('deleteModal');
        
        if (event.target === formModal) {
            closeFormModal();
        }
        if (event.target === deleteModal) {
            closeDeleteModal();
        }
    }

    // Close modals with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeFormModal();
            closeDeleteModal();
        }
    });
</script>
@endpush
@endsection 