<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\KenaikanGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KenaikanGajiController extends Controller
{
    public function index(Request $request)
    {
        $data = KenaikanGaji::with('pegawai')->latest();
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
                ->addColumn('calculated_date', function ($data) {
                    return $data->calculated_date;
                })
                ->addColumn('gaji_pokok', function ($data) {
                    return number_format($data->gaji_pokok, 0, ',', '.');
                })
                ->addColumn('akta_lahir', function ($data) {
                    return "<a href='" . asset("upload/" . $data->akta_lahir) . "' target='_blank'><i class='ri-file-list-3-line' style='color:#556FF6;font-size:30px;'></i></a>";
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
                ->rawColumns(['action', 'image', 'akta_lahir'])
                ->make(true);
        }
        $getData = $data->get();
        $pegawaiDatas = Pegawai::latest()->get();
        $storeUrl = 'kenaikanGaji.store';
        $deleteUrl = 'kenaikanGaji.destroy';
        $updateUrl = 'kenaikanGaji.update';
        $title = "Kenaikan Gaji";
        $formTitle = "Kenaikan Gaji";
        return view('back_office.kenaikan_gaji.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl', 'pegawaiDatas'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'calculated_date' => 'required',
            "akta_lahir" => "required|mimes:pdf|max:10000",
            'gaji_pokok' => 'required|numeric',
        ], [
            'pegawai_id.required' => 'Nama Pegawai diperlukan.',
            'calculated_date.required' => 'Tanggal Terhitung diperlukan.',
            'akta_lahir.required' => 'Nomor Surat Cuti diperlukan.',
            'gaji_pokok.required' => 'Gaji Pokok diperlukan.',
            'gaji_pokok.numeric' => 'Gaji Pokok Harus Berupa Angka',
        ]);

        // Jalankan validasi
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $uploadPath = 'upload';
        $localDriver = Storage::createLocalDriver(['root' => $uploadPath]);
        $path = $localDriver->put('pdf', $request->akta_lahir);
        $validatedData['akta_lahir'] = $path;
        KenaikanGaji::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $kenaikanGaji = KenaikanGaji::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'calculated_date' => 'required',
            "akta_lahir" => "mimes:pdf|max:10000",
            'gaji' => 'required|numeric',
        ], [
            'pegawai_id.required' => 'Nama Pegawai diperlukan.',
            'calculated_date.required' => 'Tanggal Terhitung diperlukan.',
            'akta_lahir.mimes' => 'File Harus Berupa PDF',
            'akta_lahir.max' => 'Ukuran Maksimal File Adalah 10mb',
            'gaji.required' => 'Gaji Pokok diperlukan.',
            'gaji.numeric' => 'Gaji Pokok Harus Berupa Angka',
        ]);

        // Jalankan validasi
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $validatedData['gaji_pokok'] = implode("", explode(".", $validatedData['gaji']));
        unset($validatedData['gaji']);
        if ($request->hasFile('akta_lahir')) {
            $aktaLahirPath = public_path('upload/' . $kenaikanGaji->akta_lahir);
            if (file_exists($aktaLahirPath)) {
                unlink($aktaLahirPath);
            }
            $uploadPath = 'upload';
            $localDriver = Storage::createLocalDriver(['root' => $uploadPath]);
            $path = $localDriver->put('pdf', $request->akta_lahir);
            $validatedData['akta_lahir'] = $path;
        }
        $kenaikanGaji->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $kenaikanGajiData = KenaikanGaji::findOrFail($id);
        $aktaPath = public_path('upload/' . $kenaikanGajiData->akta_lahir);
        if (file_exists($aktaPath)) {
            unlink($aktaPath);
        }
        $kenaikanGajiData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
