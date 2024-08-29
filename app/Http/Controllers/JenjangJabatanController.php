<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\JenjangJabatan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class JenjangJabatanController extends Controller
{
    public function __construct()
    {
        \Carbon\Carbon::setLocale('id');
    }
    public function index(Request $request)
    {
        $data = JenjangJabatan::with('pegawai')->latest();
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('name', function ($data) {
                    return $data->pegawai->name;
                })
                ->addColumn('jenjang_jabatan_name', function ($data) {
                    return ucwords($data->jenjang_jabatan_name);
                })
                ->addColumn('jabatan_pensiun', function ($data) {
                    return $data->jabatan_pensiun;
                })
                ->addColumn('tanggal_pensiun', function ($data) {
                    $tanggalPensiun = Carbon::parse($data->tanggal_pensiun);
                    return $tanggalPensiun->translatedFormat('d-F-Y');
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
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        $getData = $data->get();
        $pegawaiDatas = Pegawai::doesntHave('jenjangJabatan')->get();
        $storeUrl = 'jenjangJabatan.store';
        $deleteUrl = 'jenjangJabatan.destroy';
        $updateUrl = 'jenjangJabatan.update';
        $title = "Jenjang Jabatan";
        $formTitle = "Jenjang Jabatan";
        return view('back_office.jenjang_jabatan.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl', 'pegawaiDatas'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'jenjang_jabatan_name' => 'required',
            'jabatan_pensiun' => 'required',
        ], [
            'pegawai_id.required' => 'Nama wajib diisi.',
            'jenjang_jabatan_name.required' => 'Jenjang Jabatan Diperlukan',
            'jabatan_pensiun.required' => 'Tanggal Pensiun Sesuai Jabatan Diperlukan',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $pegawaiData = Pegawai::firstWhere('id', $request->pegawai_id)->date_of_birth;
        $pegawaiData = Carbon::parse($pegawaiData);

        $validatedData = $validator->validated();
        if ($request->jabatan_pensiun == 'Ahli Utama') {
            $validatedData['tanggal_pensiun'] = $pegawaiData->addYears(65)->toDateString();
        }
        if ($request->jabatan_pensiun == 'Kadis' || $request->jabatan_pensiun == 'Ahli Madya') {
            $validatedData['tanggal_pensiun'] = $pegawaiData->addYears(60)->toDateString();
        }
        if ($request->jabatan_pensiun == 'Sekretaris' || $request->jabatan_pensiun == 'Kasubag' || $request->jabatan_pensiun == 'Ahli Muda' || $request->jabatan_pensiun == 'Ahli Pertama' || $request->jabatan_pensiun == 'Penyelia' || $request->jabatan_pensiun == 'Mahir' || $request->jabatan_pensiun == 'Terampil' || $request->jabatan_pensiun == 'Administrasi') {
            $validatedData['tanggal_pensiun'] = $pegawaiData->addYears(58)->toDateString();
        }
        JenjangJabatan::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $jenjangJabatanData = JenjangJabatan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'jenjang_jabatan_name' => 'required',
            'jabatan_pensiun' => 'required',
        ], [
            'jenjang_jabatan_name.required' => 'Jenjang Jabatan Diperlukan',
            'jabatan_pensiun.required' => 'Tanggal Pensiun Sesuai Jabatan Diperlukan',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $pegawaiData = Pegawai::firstWhere('id', $jenjangJabatanData->pegawai_id)->date_of_birth;
        $pegawaiData = Carbon::parse($pegawaiData);

        $validatedData = $validator->validated();
        if ($request->jabatan_pensiun == 'Ahli Utama') {
            $validatedData['tanggal_pensiun'] = $pegawaiData->addYears(65)->toDateString();
        }
        if ($request->jabatan_pensiun == 'Kadis' || $request->jabatan_pensiun == 'Ahli Madya') {
            $validatedData['tanggal_pensiun'] = $pegawaiData->addYears(60)->toDateString();
        }
        if ($request->jabatan_pensiun == 'Sekretaris' || $request->jabatan_pensiun == 'Kasubag' || $request->jabatan_pensiun == 'Ahli Muda' || $request->jabatan_pensiun == 'Ahli Pertama' || $request->jabatan_pensiun == 'Penyelia' || $request->jabatan_pensiun == 'Mahir' || $request->jabatan_pensiun == 'Terampil' || $request->jabatan_pensiun == 'Administrasi') {
            $validatedData['tanggal_pensiun'] = $pegawaiData->addYears(58)->toDateString();
        }
        $jenjangJabatanData->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $jenjangJabatanData = JenjangJabatan::findOrFail($id);
        $jenjangJabatanData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
