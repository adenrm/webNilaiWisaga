<?php

namespace App\Http\Controllers;

use App\Exports\ValueExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function exportValue()
    {
        return Excel::download(new ValueExport, 'value.xlsx');
    }
}
