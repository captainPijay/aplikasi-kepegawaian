<?php

namespace App\Http\Controllers;

use App\Models\DataInstansi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = User::with('dataInstansi')->latest();
        if (auth()->user()->role == 'Operator Rumah Sakit' || auth()->user()->role == 'Operator Puskesmas') {
            $data = User::with('dataInstansi')
                ->where(function ($query) {
                    $query->where('role', 'Operator Rumah Sakit')
                        ->orWhere('role', 'Operator Puskesmas');
                })
                ->latest();
        }

        $counter = 1;
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('no', function ($data) use (&$counter) {
                    return $counter++;
                })
                ->addColumn('id', function ($data) {
                    return ($data->id < 10) ? '0' . $data->id : $data->id;
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('username', function ($data) {
                    return $data->username;
                })
                ->addColumn('instansi', function ($data) {
                    return $data->dataInstansi->name ?? 'Super Admin Tidak Memiliki Instansi';
                })
                ->addColumn('jenis akun', function ($data) {
                    return $data->role;
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
        $dataInstansis = DataInstansi::latest()->get();
        $storeUrl = 'user.store';
        $deleteUrl = 'user.destroy';
        $updateUrl = 'user.update';
        $title = 'Settings';
        return view('back_office.user.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'storeUrl', 'title', 'dataInstansis'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:pegawais,username|unique:users,username',
            'data_instansi_id' => 'nullable',
            'password' => 'required',
            'role' => 'required',
        ], [
            'name.required' => 'Nama Wajib Di Isi.',
            'username.required' => 'Username Wajib Di Isi',
            'username.unique' => 'Username Sudah Ada ',
            'data_instansi_id.nullable' => 'data_instansi_id boleh kosong',
            'password.required' => 'Password Wajib Di Isi',
            'role.required' => 'Role Dibutuhkan'
        ]);
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        if ($request->role == 'Super Admin') {
            $validatedData['role'] = '';
        }
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $userData = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => "required|unique:pegawais,username,$id|unique:users,username," . $id,
            'data_instansi_id' => 'nullable',
            'role' => 'required',
            'password' => 'nullable',
        ], [
            'name.required' => 'Nama Wajib Di Isi.',
            'username.required' => 'Username Wajib Di Isi',
            'data_instansi_id.nullable' => 'data_instansi_id Boleh Kosong',
            'role.required' => 'Role Wajib Di Isi',
            'password.nullable' => 'Password Boleh Kosong',
        ]);
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        if ($request->role == 'Super Admin') {
            $validatedData['role'] = '';
        }
        if ($validatedData['password'] == null) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        $userData->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $userData = User::findOrFail($id);
        if ($userData->id == 1) {
            flash()->addError('Tidak Dapat Menghapus Admin Ini');
            return back();
        }
        $userData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
