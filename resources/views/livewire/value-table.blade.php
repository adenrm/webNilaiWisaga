<div class="">

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai DT1</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai DT2</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai MSS</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Average</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse($nilai ?? [] as $n)
        <tr class="hover:bg-gray-50 transition-colors duration-150">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">{{ $n->user->name }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-500">{{ $n->study }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-semibold 
                    @if($n->value_dt1 >= 90) text-green-600
                    @elseif($n->value_dt1 >= 75) text-blue-600
                    @else text-red-600 @endif">
                    {{ $n->value_dt1 }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-semibold 
                    @if($n->value_dt2 >= 90) text-green-600
                    @elseif($n->value_dt2 >= 75) text-blue-600
                    @else text-red-600 @endif">
                    {{ $n->value_dt2 }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-semibold 
                @if($n->value_mss >= 90) text-green-600
                @elseif($n->value_mss >= 75) text-blue-600
                @else text-red-600 @endif">
                {{ $n->value_mss }}
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-semibold 
            @php
                    $average = ($n->value_dt1 + $n->value_dt2 + $n->value_mss) / 3;
                    $averageL = Str::limit($average, 4, '' );
                    @endphp
                    @if($averageL >= 90) text-green-600
                    @elseif($averageL >= 75) text-blue-600
                    @else text-red-600 @endif">
                    {{ $averageL }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div x-data="{ isOpen: false }">
                <div  @mouseover="isOpen = true"
                @mouseleave="isOpen = false"
                 class="text-sm text-gray-500">{{ $n->created_at->format('d M Y') }}</div>
            
                    <div x-show="isOpen"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="popover absolute bg-gray-700 border shadow-md mt-2 px-4 py-2 rounded-lg">
                        
                        <p class="text-white">{{ $n->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                <button class="inline-flex items-center text-blue-600 hover:text-blue-900" onclick="openEditModal({{ $n->id }})">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </button>
                <button class="inline-flex items-center text-red-600 hover:text-red-900" onclick="openDeleteModal({{ $n->id }})">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                <div class="flex flex-col items-center">
                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p>Belum ada data nilai</p>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>