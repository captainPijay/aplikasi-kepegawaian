<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AnakController extends Controller
{
    public function index(Request $request)
    {
        $data = Anak::with('pegawai')->latest();
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('name', function ($data) {
                    return $data->pegawai->name;
                })
                ->addColumn('children_name', function ($data) {
                    return $data->children_name;
                })
                ->addColumn('latest_education', function ($data) {
                    return $data->latest_education;
                })
                ->addColumn('job', function ($data) {
                    return $data->job;
                })
                ->addColumn('status', function ($data) {
                    return $data->status;
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
        $pegawaiDatas = Pegawai::latest()->get();
        $storeUrl = 'anak.store';
        $deleteUrl = 'anak.destroy';
        $updateUrl = 'anak.update';
        $title = "Anak";
        $formTitle = "Anak";
        return view('back_office.anak.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl', 'pegawaiDatas'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'children_name' => 'required',
            'latest_education' => 'required',
            'job' => 'required',
            'status' => 'required',
        ], [
            'pegawai_id.required' => 'Id Pegawai Diperlukan',
            'children_name.required' => 'Nama Anak Diperlukan',
            'latest_education.required' => 'Pendidikan Terakhir Diperlukan',
            'job.required' => 'Pekerjaan Diperlukan',
            'status.required' => 'Status Diperlukan',
        ]);

        // Jalankan validasi
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        Anak::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $anakData = Anak::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'children_name' => 'required',
            'latest_education' => 'required',
            'job' => 'required',
            'status' => 'required',
        ], [
            'pegawai_id.required' => 'Id Pegawai Diperlukan',
            'children_name.required' => 'Nama Anak Diperlukan',
            'latest_education.required' => 'Pendidikan Terakhir Diperlukan',
            'job.required' => 'Pekerjaan Diperlukan',
            'status.required' => 'Status Diperlukan',
        ]);

        // Jalankan validasi
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $anakData->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataAnak = Anak::findOrFail($id);
        $dataAnak->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
