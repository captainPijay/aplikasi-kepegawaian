<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PendidikanController extends Controller
{
    public function index(Request $request)
    {
        $data = Pendidikan::with('pegawai')->latest();
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('name', function ($data) {
                    return $data->pegawai->name;
                })
                ->addColumn('pendidikan_name', function ($data) {
                    return $data->name;
                })
                ->addColumn('pass_date', function ($data) {
                    return $data->pass_date;
                })
                ->addColumn('jenjang', function ($data) {
                    return $data->jenjang;
                })
                ->addColumn('school', function ($data) {
                    return $data->school;
                })
                ->addColumn('school_location', function ($data) {
                    return $data->school_location;
                })
                ->addColumn('ijazah_number', function ($data) {
                    return $data->ijazah_number;
                })
                ->addColumn('ijazah_date', function ($data) {
                    return $data->ijazah_date;
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
        $pegawaiDatas = Pegawai::doesntHave('pendidikan')->get();
        $storeUrl = 'pendidikan.store';
        $deleteUrl = 'pendidikan.destroy';
        $updateUrl = 'pendidikan.update';
        $title = "pendidikan";
        $formTitle = "pendidikan";
        return view('back_office.pendidikan.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl', 'pegawaiDatas'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'name' => 'required',
            'pass_date' => 'required',
            'jenjang' => 'required',
            'school' => 'required',
            'school_location' => 'required',
            'ijazah_number' => 'required|unique:pendidikans',
            'ijazah_date' => 'required',
        ], [
            'pegawai_id.required' => 'Id Pegawai Diperlukan',
            'name.required' => 'Nama Pendidikan Diperlukan',
            'pass_date.required' => 'Tahun Lulus Diperlukan',
            'jenjang.required' => 'jenjang Diperlukan',
            'school.required' => 'Nama Sekolah Diperlukan',
            'school_location.required' => 'Lokasi Sekolah Diperlukan',
            'ijazah_number.required' => 'Nomor Ijazah Diperlukan',
            'ijazah_number.unique' => 'Nomor Ijazah Sudah Ada',
            'ijazah_date.required' => 'Nomor Ijazah Diperlukan',
        ]);

        // Jalankan validasi
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        Pendidikan::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $dataPendidikan = Pendidikan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'pass_date' => 'required',
            'jenjang' => 'required',
            'school' => 'required',
            'school_location' => 'required',
            'ijazah_number' => 'required|unique:pendidikans,ijazah_number,' . $id,
            'ijazah_date' => 'required',
        ], [
            'name.required' => 'Nama Pendidikan Diperlukan',
            'pass_date.required' => 'Tahun Lulus Diperlukan',
            'jenjang.required' => 'jenjang Diperlukan',
            'school.required' => 'Nama Sekolah Diperlukan',
            'school_location.required' => 'Lokasi Sekolah Diperlukan',
            'ijazah_number.required' => 'Nomor Ijazah Diperlukan',
            'ijazah_number.unique' => 'Nomor Ijazah Sudah Ada',
            'ijazah_date.required' => 'Nomor Ijazah Diperlukan',
        ]);

        // Jalankan validasi
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $dataPendidikan->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataPendidikan = Pendidikan::findOrFail($id);
        $dataPendidikan->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
