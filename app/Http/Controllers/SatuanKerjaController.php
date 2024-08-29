<?php

namespace App\Http\Controllers;

use App\Models\SatuanKerja;
use App\Models\SatuanKerjaInduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SatuanKerjaController extends Controller
{
    public function index(Request $request)
    {
        $data = SatuanKerja::join('satuan_kerja_induks as b', 'satuan_kerjas.satuan_kerja_induk_id', '=', 'b.id')
            ->select('satuan_kerjas.*', 'b.name AS satuan_kerja_induk_name')
            ->latest();
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
                ->addColumn('satuan_kerja_induk_name', function ($data) {
                    return $data->satuan_kerja_induk_name;
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
        $satuanKerjaIndukDatas = SatuanKerjaInduk::latest()->get();
        $storeUrl = 'satuanKerja.store';
        $deleteUrl = 'satuanKerja.destroy';
        $updateUrl = 'satuanKerja.update';
        $title = "Bagian OPD";
        $formTitle = "Bagian OPD";
        return view('back_office.satuan_kerja.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl', 'satuanKerjaIndukDatas'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'satuan_kerja_induk_id' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'satuan_kerja_induk_id.required' => 'ID Satuan Kerja Wajib Diisi'
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        SatuanKerja::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $satuanKerjaData = SatuanKerja::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'satuan_kerja_induk_id' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'satuan_kerja_induk_id.required' => 'ID Satuan Kerja Wajib Diisi'
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $satuanKerjaData->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $satuanKerjaData = SatuanKerja::findOrFail($id);
        $satuanKerjaData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
