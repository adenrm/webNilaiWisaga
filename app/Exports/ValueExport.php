<?php

namespace App\Exports;

use App\Models\Study;
use App\Models\User;
use App\Models\Value;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ValueExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $nilai = Value::with('user')->latest()->paginate(10);
        $siswa = User::all();
        $studys = Study::all();
        $totalNilai = Value::count();
        // $averageNilai = Value::avg('value');
        $todayInputs = Value::whereDate('created_at', today())->count();

        return view('livewire.value-table');
    }
}
