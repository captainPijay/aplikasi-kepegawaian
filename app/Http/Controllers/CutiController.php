<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
    public function index(Request $request)
    {
        $data = Cuti::with('pegawai')->latest();
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('name', function ($data) {
                    return $data->pegawai->name;
                })
                ->addColumn('jenis', function ($data) {
                    return $data->jenis;
                })
                ->addColumn('surat_cuti_number', function ($data) {
                    return $data->surat_cuti_number;
                })
                ->addColumn('cuti_date', function ($data) {
                    return $data->cuti_date;
                })
                ->addColumn('cuti_time', function ($data) {
                    return $data->cuti_time;
                })
                ->addColumn('lampiran', function ($data) {
                    return "<a href='" . asset("upload/" . $data->lampiran) . "' target='_blank'><i class='ri-file-list-3-line' style='color:#556FF6;font-size:30px;'></i></a>";
                })
                ->addColumn('action', function ($data) {
                    return "<div class='dropdown btn-aksi'>
                        <button class='btn btn-sm btn-outline-info' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                            <i class='ri-more-line'></i>
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                            <li><button onclick='editData(" . json_encode($data) . ")' aria-expanded='false' class='btn'><i class='ri-pencil-line'></i> Ubah Data</button></li>
                            <li><button onclick='deleteData($data->id)' aria-expanded='false' class='btn'><i class='ri-close-line'></i> Hapus Data</button></li>
                        </ul>
                    </div>";
                })
                ->rawColumns(['action', 'image', 'lampiran'])
                ->make(true);
        }
        $getData = $data->get();
        $pegawaiDatas = Pegawai::latest()->get();
        $storeUrl = 'cuti.store';
        $deleteUrl = 'cuti.destroy';
        $updateUrl = 'cuti.update';
        $title = "Cuti";
        $formTitle = "Cuti";
        return view('back_office.cuti.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl', 'pegawaiDatas'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'jenis' => 'required',
            'surat_cuti_number' => 'required|unique:cutis',
            'cuti_date' => 'required',
            'cuti_time' => 'required',
            "lampiran" => "required|mimes:pdf|max:10000"
        ], [
            'pegawai_id.required' => 'Nama Pegawai diperlukan.',
            'jenis.required' => 'Jenis diperlukan.',
            'surat_cuti_number.required' => 'Nomor Surat Cuti diperlukan.',
            'surat_cuti_number.unique' => 'Nomor Surat Cuti sudah ada.',
            'cuti_date.required' => 'Tanggal Cuti diperlukan.',
            'cuti_time.required' => 'Lama Cuti diperlukan.',
            'lampiran.required' => 'Lampiran diperlukan.',
            'lampiran.mimes' => 'Lampiran harus berupa file PDF.',
            'lampiran.max' => 'Ukuran lampiran tidak boleh melebihi 10MB.',
        ]);

        // Jalankan validasi
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $uploadPath = 'upload';
        $localDriver = Storage::createLocalDriver(['root' => $uploadPath]);
        $path = $localDriver->put('pdf', $request->lampiran);
        $validatedData['lampiran'] = $path;
        Cuti::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $cutiData = Cuti::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'jenis' => 'required',
            'surat_cuti_number' => 'required|unique:cutis,surat_cuti_number,' . $id,
            'cuti_date' => 'required',
            'cuti_time' => 'required',
            "lampiran" => "mimes:pdf|max:10000"
        ], [
            'pegawai_id.required' => 'Nama Pegawai diperlukan.',
            'jenis.required' => 'Jenis diperlukan.',
            'surat_cuti_number.required' => 'Nomor Surat Cuti diperlukan.',
            'surat_cuti_number.unique' => 'Nomor Surat Cuti sudah ada.',
            'cuti_date.required' => 'Tanggal Cuti diperlukan.',
            'cuti_time.required' => 'Lama Cuti diperlukan.',
            'lampiran.mimes' => 'Lampiran harus berupa file PDF.',
            'lampiran.max' => 'Ukuran lampiran tidak boleh melebihi 10MB.',
        ]);

        // Jalankan validasi
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        if ($request->hasFile('lampiran')) {
            $lampiranPath = public_path('upload/' . $cutiData->lampiran);
            if (file_exists($lampiranPath)) {
                unlink($lampiranPath);
            }
            $uploadPath = 'upload';
            $localDriver = Storage::createLocalDriver(['root' => $uploadPath]);
            $path = $localDriver->put('pdf', $request->lampiran);
            $validatedData['lampiran'] = $path;
        }
        $cutiData->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $cutiData = Cuti::findOrFail($id);
        $lampiranPath = public_path('upload/' . $cutiData->lampiran);
        if (file_exists($lampiranPath)) {
            unlink($lampiranPath);
        }
        $cutiData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
    public function updateReadonlyInput(Request $request)
    {
        $selectedValue = $request->input('inputData');
        $cutiTime = '';

        switch ($selectedValue) {
            case 'Bersalin':
                $cutiTime = '3 bulan';
                break;
            case 'Sakit':
                $cutiTime = '2 hari';
                break;
            case 'Acara Keluarga':
                $cutiTime = '10 hari';
                break;
            default:
                return response()->json(['status' => 'error', 'message' => 'Jenis tidak valid']);
        }

        return response()->json(['status' => 'success', 'cutiTime' => $cutiTime]);
    }
}
