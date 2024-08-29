<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\SuamiIstri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SuamiIstriController extends Controller
{
    public function index(Request $request)
    {
        $data = SuamiIstri::with('pegawai')->latest();
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('name', function ($data) {
                    return $data->pegawai->name;
                })
                ->addColumn('suami_istri_name', function ($data) {
                    return $data->suami_istri_name;
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
        $storeUrl = 'suamiIstri.store';
        $deleteUrl = 'suamiIstri.destroy';
        $updateUrl = 'suamiIstri.update';
        $title = "Suami Istri";
        $formTitle = "Suami Istri";
        return view('back_office.suami_istri.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl', 'pegawaiDatas'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'suami_istri_name' => 'required',
            'latest_education' => 'required',
            'job' => 'required',
            'status' => 'required',
        ], [
            'pegawai_id.required' => 'Id Pegawai Diperlukan',
            'suami_istri_name.required' => 'Nama Suami/Istri Diperlukan',
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
        SuamiIstri::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $suamiIstriData = SuamiIstri::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'suami_istri_name' => 'required',
            'latest_education' => 'required',
            'job' => 'required',
            'status' => 'required',
        ], [
            'pegawai_id.required' => 'Id Pegawai Diperlukan',
            'suami_istri_name.required' => 'Nama Suami/Istri Diperlukan',
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
        $suamiIstriData->update($validatedData);
        flash('Berhasil Merubah Data');
        return back();
    }
    public function destroy($id)
    {
        $suamiIstriData = SuamiIstri::findOrFail($id);
        $suamiIstriData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
