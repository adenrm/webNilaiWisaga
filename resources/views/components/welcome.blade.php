<div class="">
    @php
        use App\Models\User;
        use App\Models\Studys;
        $users = User::all();
        $studys = Studys::all();
        $study_id = User::find(1)->value();
        $nameStudys = Studys::where('id', $study_id);
    @endphp
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                        Study
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                        Nilai
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($users as $user)
                @foreach ($nameStudys as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $user->name }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-500">
                            {{-- {{ $item->name }} --}}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-500">
                            {{ ($user->value->value_dt1 + $user->value->value_dt2 + $user->value->value_mss) / 3 }}
                        </div>
                    </td>
                </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
