<div class="">
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <h1 class="text-xl mb-5">
            Bapak {{ Auth::guard('admin')->user()->study }} Indonesia! Inilah nilai dari muridmu pak
        </h1>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Rombel
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Mapel
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Nilai
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        use App\Models\User;
                        $users = User::with('value')->get();
                        $adminStudy = Auth::guard('admin')->user()->study;
                        $i = 1;
                    @endphp
                @foreach ($users as $user)    
                    @foreach ($user->value as $value)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $i++ }}
                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->class }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $value->studys ? $value->studys->name : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ ($value->value_dt1 + $value->value_dt2 + $value->value_mss) / 3 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-toggle="modal" data-target="#editModal{{ $value->id }}">
                                            Edit
                                        </button>
                                        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editModal{{ $value->id }}" role="dialog" aria-labelledby="modal-title" aria-modal="true">
                                            <div class="flex items-center justify-center min-h-screen">
                                                <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                                    <div class="px-4 py-5 sm:px-6">
                                                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Edit Nilai</h3>
                                                        <div class="mt-2">
                                                            <form action="{{ route('nilai.update', ['id' => $value->id]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="grid grid-cols-1 gap-y-6">
                                                                    <div>
                                                                        <label for="value_dt1" class="block text-sm font-medium text-gray-700">Nilai DT1</label>
                                                                        <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="value_dt1" name="value_dt1" value="{{ $value->value_dt1 }}" required>
                                                                    </div>
                                                                    <div>
                                                                        <label for="value_dt2" class="block text-sm font-medium text-gray-700">Nilai DT2</label>
                                                                        <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="value_dt2" name="value_dt2" value="{{ $value->value_dt2 }}" required>
                                                                    </div>
                                                                    <div>
                                                                        <label for="value_mss" class="block text-sm font-medium text-gray-700">Nilai MSS</label>
                                                                        <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="value_mss" name="value_mss" value="{{ $value->value_mss }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-4">
                                                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                        Simpan
                                                                    </button>
                                                                    <button type="button" class="ml-2 inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" onclick="document.getElementById('editModal{{ $value->id }}').style.display='none'">
                                                                        Batal
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('nilai.destroy', ['id' => $value->id]) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-black bg-tertiary hover:bg-green-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" data-toggle="modal" data-target="#addModal">
            + Tambah
        </button>
        <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="addModal" role="dialog" aria-labelledby="modal-title" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Tambah Nilai</h3>
                        <div class="mt-2">
                            <form action="{{ route('nilai.store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 gap-y-6">
                                    <div>
                                        <label for="user_id" class="block text-sm font-medium text-gray-700">ID User</label>
                                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" name="user_id" id="user_id">
                                            <option value="" disabled selected>Pilih Siswa</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="value_dt1" class="block text-sm font-medium text-gray-700">Nilai DT1</label>
                                        <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="value_dt1" name="value_dt1" required>
                                    </div>
                                    <div>
                                        <label for="value_dt2" class="block text-sm font-medium text-gray-700">Nilai DT2</label>
                                        <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="value_dt2" name="value_dt2" required>
                                    </div>
                                    <div>
                                        <label for="value_mss" class="block text-sm font-medium text-gray-700">Nilai MSS</label>
                                        <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="value_mss" name="value_mss" required>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Simpan
                                    </button>
                                    <button type="button" class="ml-2 inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="document.getElementById('addModal').style.display='none'">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalButtons = document.querySelectorAll('[data-toggle="modal"]');
            modalButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const targetModal = document.querySelector(button.getAttribute('data-target'));
                    targetModal.style.display = 'block';
                    targetModal.style.opacity = '0';
                    setTimeout(() => {
                        targetModal.style.opacity = '1';
                    }, 10);
                });
            });
        });
    </script>
</div>