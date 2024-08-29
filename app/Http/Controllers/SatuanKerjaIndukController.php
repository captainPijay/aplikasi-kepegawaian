<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SatuanKerjaInduk;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SatuanKerjaIndukController extends Controller
{
    public function index(Request $request)
    {
        $data = SatuanKerjaInduk::latest();
        $counter = 1;
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('id', function ($data) use (&$counter) {
                    return $counter++;
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
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
                ->rawColumns(['action'])
                ->make(true);
        }
        $getData = $data->get();
        $storeUrl = 'satuanKerjaInduk.store';
        $deleteUrl = 'satuanKerjaInduk.destroy';
        $updateUrl = 'satuanKerjaInduk.update';
        $title = "OPD";
        $formTitle = "OPD";
        return view('back_office.satuan_kerja_induk.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        SatuanKerjaInduk::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $satuanKerjaIndukData = SatuanKerjaInduk::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $satuanKerjaIndukData->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $satuanKerjaIndukData = SatuanKerjaInduk::findOrFail($id);
        $satuanKerjaIndukData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
