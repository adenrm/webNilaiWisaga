<div class="">
    @php
        use App\Models\User;
        use App\Models\Studys;
        use App\Models\Value;
        $userId = Auth::user()->id;
        $users = User::where('id', $userId)->get();
        // $value = Value::where('user_id', $userId)->get();
        $value = Value::with('studys')->where('user_id', $userId)->get();
        $studies = studys::all();
        $studiesId = Value::where('user_id', $userId)->pluck('studys_id');
        $studiesName = studys::whereIn('id', $studiesId)->pluck('name');
    @endphp
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                        studys
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
                        Nilai
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($value as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-500">
                            {{ $item->study ?? 'N/A' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-500">
                            @php
                                $result = ($item->value_dt1 + $item->value_dt2 + $item->value_mss) / 3 ; 
                                $resultFinal = Str::limit($result, 4, '');
                            @endphp
                            {{ $resultFinal }}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
