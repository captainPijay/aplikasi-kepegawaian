<?php

namespace App\Http\Controllers;

use App\Models\DataInstansi;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {
        $data = DataInstansi::with('pegawai')->get();
        $pdf = PDF::loadView('back_office.pdf.index', [
            'data' => $data
        ]);

        return $pdf->stream('rekapitulasi-data-kepegawaian-golongan');
    }
}
