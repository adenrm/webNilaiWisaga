<?php

namespace App\Livewire;

use App\Models\Study;
use App\Models\User;
use App\Models\Value;
use Livewire\Component;

class ValueTable extends Component
{
    public function render()
    {
        $nilai = Value::with('user')->latest()->paginate(10);
        $siswa = User::all();
        $studys = Study::all();
        $totalNilai = Value::count();
        // $averageNilai = Value::avg('value');
        $todayInputs = Value::whereDate('created_at', today())->count();
        return view('livewire.value-table', compact('nilai', 'siswa', 'studys',  'totalNilai', 'todayInputs'));
    }
}
