<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $data = Jabatan::with('pegawai')->latest();
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('name', function ($data) {
                    return $data->pegawai->name;
                })
                ->addColumn('jabatan_name', function ($data) {
                    return ucwords($data->jabatan_name);
                })
                ->addColumn('jabatan_started_at', function ($data) {
                    return $data->jabatan_started_at;
                })
                ->addColumn('bidang', function ($data) {
                    return $data->bidang;
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
        $pegawaiDatas = Pegawai::doesntHave('jabatan')->get();
        $storeUrl = 'jabatan.store';
        $deleteUrl = 'jabatan.destroy';
        $updateUrl = 'jabatan.update';
        $title = "Jabatan";
        $formTitle = "Jabatan";
        return view('back_office.jabatan.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl', 'pegawaiDatas'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'jabatan_name' => 'required',
            'jabatan_started_at' => 'required',
            'bidang' => 'required',
        ], [
            'pegawai_id.required' => 'Nama wajib diisi.',
            'jabatan_name.required' => 'Jabatan Diperlukan',
            'jabatan_started_at.required' => 'Tanggal Mulai Jabatan Wajib Diisi.',
            'bidang.required' => 'Bidang Diperlukan',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        Jabatan::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $jabatanData = Jabatan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'jabatan_name' => 'required',
            'jabatan_started_at' => 'required',
            'bidang' => 'required',
        ], [
            'jabatan_name.required' => 'Jabatan Diperlukan',
            'jabatan_started_at.required' => 'Tanggal Mulai Jabatan Wajib Diisi.',
            'bidang.required' => 'Bidang Diperlukan'
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $jabatanData->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $jabatanData = Jabatan::findOrFail($id);
        $jabatanData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
