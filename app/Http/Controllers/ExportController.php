<?php

namespace App\Http\Controllers;

use App\Exports\PegawaiExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        return view('back_office.cetakLaporan.index', [
            'title' => 'Cetak Laporan'
        ]);
    }
    public function download(Request $request)
    {
        if ($request->kategori == 'golongan') {
            return redirect()->route('pdf.index');
        }
        return Excel::download(new PegawaiExport($request->kategori), $request->kategori . '.xlsx');
    }
}
