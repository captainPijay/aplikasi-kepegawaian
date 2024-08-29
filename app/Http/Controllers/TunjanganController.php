<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Tunjangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TunjanganController extends Controller
{
    public function index(Request $request)
    {
        $data = Tunjangan::with('pegawai')->latest();
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('name', function ($data) {
                    return $data->pegawai->name;
                })
                ->addColumn('anak', function ($data) {
                    return $data->anak;
                })
                ->addColumn('suami_atau_istri', function ($data) {
                    return $data->suami_atau_istri;
                })
                ->addColumn('calculated_date', function ($data) {
                    return $data->calculated_date;
                })
                ->addColumn('akta_perkawinan', function ($data) {
                    if ($data->akta_perkawinan) {
                        return "<a href='" . asset("upload/" . $data->akta_perkawinan) . "' target='_blank'>Akta Perkawinan " . $data->pegawai->name . "</a>";
                    } else {
                        return "Akta Perkawinan Tidak Tersedia";
                    }
                })
                ->addColumn('akta_lahir', function ($data) {
                    if ($data->akta_lahir) {
                        return "<a href='" . asset("upload/" . $data->akta_lahir) . "' target='_blank'>Akta Lahir " . $data->pegawai->name . "</a>";
                    } else {
                        return "Akta Lahir Tidak Tersedia";
                    }
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
                ->rawColumns(['action', 'image', 'akta_perkawinan', 'akta_lahir'])
                ->make(true);
        }
        $getData = $data->get();
        $pegawaiDatas = Pegawai::latest()->get();
        $storeUrl = 'tunjangan.store';
        $deleteUrl = 'tunjangan.destroy';
        $updateUrl = 'tunjangan.update';
        $title = "Tunjangan";
        $formTitle = "Tunjangan";
        return view('back_office.tunjangan.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl', 'pegawaiDatas'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'calculated_date' => 'required',
            'suami_atau_istri' => 'required',
            'anak' => 'required',
            "akta_perkawinan" => "nullable|mimes:pdf|max:10000",
            "akta_lahir" => "nullable|mimes:pdf|max:10000"
        ], [
            'pegawai_id.required' => 'Nama Pegawai diperlukan.',
            'suami_atau_istri.required' => 'Data Diperlukan',
            'anak.required' => 'Data Diperlukan',
            'calculated_date.required' => 'Tanggal Terhitung Cuti diperlukan.',
            'akta_perkawinan.nullable' => 'Akta Perkawinan Boleh Kosong.',
            'akta_perkawinan.mimes' => 'Akta Perkawinan harus berupa file PDF.',
            'akta_perkawinan.max' => 'Ukuran Akta Perkawinan tidak boleh melebihi 10MB.',
            'akta_lahir.nullable' => 'Akta Lahir Boleh Kosong.',
            'akta_lahir.mimes' => 'Akta Lahir harus berupa file PDF.',
            'akta_lahir.max' => 'Ukuran Akta Lahir tidak boleh melebihi 10MB.',
        ]);

        // Jalankan validasi
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $validatedData['akta_perkawinan'] = $this->storeDocument($request->akta_perkawinan);
        $validatedData['akta_lahir'] = $this->storeDocument($request->akta_lahir);
        Tunjangan::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $tunjanganData = Tunjangan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'calculated_date' => 'required',
            'suami_atau_istri' => 'required',
            'anak' => 'required',
            "akta_perkawinan" => "nullable|mimes:pdf|max:10000",
            "akta_lahir" => "nullable|mimes:pdf|max:10000"
        ], [
            'pegawai_id.required' => 'Nama Pegawai diperlukan.',
            'suami_atau_istri.required' => 'Data Diperlukan',
            'anak.required' => 'Data Diperlukan',
            'calculated_date.required' => 'Tanggal Terhitung Cuti diperlukan.',
            'akta_perkawinan.nullable' => 'Akta Perkawinan Boleh Kosong.',
            'akta_perkawinan.mimes' => 'Akta Perkawinan harus berupa file PDF.',
            'akta_perkawinan.max' => 'Ukuran Akta Perkawinan tidak boleh melebihi 10MB.',
            'akta_lahir.nullable' => 'Akta Lahir Boleh Kosong.',
            'akta_lahir.mimes' => 'Akta Lahir harus berupa file PDF.',
            'akta_lahir.max' => 'Ukuran Akta Lahir tidak boleh melebihi 10MB.',
        ]);

        // Jalankan validasi
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        if ($request->hasFile('akta_perkawinan')) {
            $aktaPerkawinan = public_path('upload/' . $tunjanganData->akta_perkawinan);
            if (file_exists($aktaPerkawinan)) {
                unlink($aktaPerkawinan);
            }
            $validatedData['akta_perkawinan'] = $this->storeDocument($request->akta_perkawinan);
        }
        if ($request->hasFile('akta_lahir')) {
            $aktaLahir = public_path('upload/' . $tunjanganData->akta_lahir);
            if (file_exists($aktaLahir)) {
                unlink($aktaLahir);
            }
            $validatedData['akta_lahir'] = $this->storeDocument($request->akta_lahir);
        }
        $tunjanganData->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $tunjanganData = Tunjangan::findOrFail($id);
        $aktaPerkawinanPath = public_path('upload/' . $tunjanganData->akta_perkawinan);
        $aktaLahirPath = public_path('upload/' . $tunjanganData->akta_lahir);
        if (file_exists($aktaPerkawinanPath)) {
            unlink($aktaPerkawinanPath);
        }
        if (file_exists($aktaLahirPath)) {
            unlink($aktaLahirPath);
        }
        $tunjanganData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
    private function storeDocument($document)
    {
        $uploadPath = 'upload';
        $localDriver = Storage::createLocalDriver(['root' => $uploadPath]);
        return $localDriver->put('pdf', $document);
    }
}
