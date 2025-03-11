<?php

namespace App\Exports;

use App\Models\Value;
use Maatwebsite\Excel\Concerns\FromCollection;

class ValueExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Value::all();
    }
}
