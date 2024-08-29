<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Cuti;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Tunjangan;
use App\Models\SuamiIstri;
use App\Models\DataInstansi;
use App\Models\KenaikanGaji;
use App\Models\Kpkn;
use App\Models\SatuanKerja;
use App\Models\SatuanKerjaInduk;
use App\Models\UnitOrganisasi;
use App\Models\WorkLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        if (auth('pegawai')->check()) {
            $data = Pegawai::with(['datainstansi', 'kpkn', 'worklocation', 'pendidikan', 'jabatan', 'satuankerjainduk', 'satuankerja'])->where('id', auth('pegawai')->user()->id);
        } elseif (auth('web')->check()) {
            $data = Pegawai::with(['datainstansi', 'kpkn', 'worklocation', 'pendidikan', 'jabatan', 'satuankerjainduk', 'satuankerja'])->latest();
        } elseif (auth('web')->check() && auth()->user()->role == 'Operator Rumah Sakit') {
            $data = Pegawai::with(['datainstansi', 'kpkn', 'worklocation', 'pendidikan', 'jabatan', 'satuankerjainduk', 'satuankerja'])->where('data_instansi_id', auth()->user()->data_instansi_id);
        } elseif (auth('web')->check() && auth()->user()->role == 'Operator Puskesmas') {
            $data = Pegawai::with(['datainstansi', 'kpkn', 'worklocation', 'pendidikan', 'jabatan', 'satuankerjainduk', 'satuankerja'])->where('data_instansi_id', auth()->user()->data_instansi_id);
        }
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('image', function ($data) {
                    return "<div class='photo-cell'><img src='" . asset("upload/" . $data->image) . "' alt='photo profile'></div>";
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('username', function ($data) {
                    return $data->username;
                })
                ->addColumn('jenis_kelamin', function ($data) {
                    return $data->gender;
                })
                ->addColumn('ttl', function ($data) {
                    $formatted_date = date('d/m/Y', strtotime($data->date_of_birth));
                    return "<div>$data->place_of_birth, $formatted_date</div>";
                })
                ->addColumn('action', function ($data) {
                    $detailsButton = "<button onclick='redirectDetail($data->id)' aria-expanded='false' class='btn'><i class='ri-zoom-in-line'></i> Detail</button>";
                    $editButton = "<button onclick='redirectEdit($data->id)' aria-expanded='false' class='btn'><i class='ri-pencil-line'></i> Ubah Data</button>";
                    $deleteButton = "<button onclick='deleteData($data->id)' aria-expanded='false' class='btn'><i class='ri-close-line'></i> Hapus Data</button>";

                    $actionButtons = "<div class='dropdown btn-aksi'>
                                        <button class='btn btn-sm btn-outline-info' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <i class='ri-more-line'></i>
                                        </button>
                                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <li>$detailsButton</li>
                                        <li>$editButton</li>";

                    if (Gate::allows('superAdmin')) {
                        $actionButtons .= "<li>$deleteButton</li>";
                    }

                    $actionButtons .= "</ul></div>";

                    return $actionButtons;
                })
                ->addColumn('pendidikan_name', function ($data) {
                    return $data->pendidikan->name ?? 'Data Pendidikan Belum Di Input';
                })
                ->addColumn('jabatan_name', function ($data) {
                    return $data->jabatan->jabatan_name ?? 'Data Jabatan Belum Di Input';
                })
                ->rawColumns(['action', 'image', 'ttl'])
                ->make(true);
        }
        $getData = $data->get();
        $storeUrl = 'pegawai.store';
        $deleteUrl = 'pegawai.destroy';
        $updateUrl = 'pegawai.update';
        $title = "Pegawai";
        $formTitle = "Pegawai";
        return view('back_office.pegawai.index', compact('request', 'getData', 'deleteUrl', 'updateUrl', 'title', 'formTitle', 'storeUrl'));
    }
    public function create()
    {
        $storeUrl = 'pegawai.store';
        $title = "Tambah Pegawai";
        $formTitle = "Tambah Pegawai";
        $dataInstansis = DataInstansi::latest()->get();
        $satuanKerjaDatas = SatuanKerja::latest()->get();
        $dataKpkns = Kpkn::latest()->get();
        $dataWorkLocations = WorkLocation::latest()->get();
        return view('back_office.pegawai.create', compact('storeUrl', 'title', 'formTitle', 'dataInstansis', 'satuanKerjaDatas', 'dataKpkns', 'dataWorkLocations'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'virtual_asn_card' => 'nullable|unique:pegawais,virtual_asn_card',
            'username' => 'required|unique:pegawais,username|unique:users,username',
            'nik_number' => 'required|unique:pegawais,nik_number|numeric|digits:16',
            'phone_number' => 'required|unique:pegawais,phone_number',
            'email' => 'required|unique:pegawais,email',
            'npwp_number' => 'nullable|unique:pegawais,npwp_number',
            'bpjs_number' => 'nullable|unique:pegawais,bpjs_number',
            'skck_number' => 'nullable|unique:pegawais,skck_number',
            'pns_sk_number' => 'nullable|unique:pegawais,pns_sk_number',
            'gelar_depan' => 'nullable',
            'gelar_belakang' => 'nullable',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'religion' => 'nullable',
            'married_type' => 'nullable',
            'address' => 'required',
            'old_username' => 'nullable',
            'employee_type' => 'required',
            'cpns_type' => 'nullable',
            'sk_cpns_date' => 'nullable',
            'tmt_cpns' => 'nullable',
            'tmt_pns' => 'nullable',
            'sk_pns_date' => 'nullable',
            'golongan_awal' => 'nullable',
            'golongan_akhir' => 'nullable',
            'golongan_awal_pppk' => 'nullable',
            'golongan_akhir_pppk' => 'nullable',
            'tmt_golongan' => 'nullable',
            'mk_year' => 'nullable',
            'mk_month' => 'nullable',
            'data_instansi_id' => 'nullable',
            'kepangkatan' => 'nullable',
            'kpkn_id' => 'nullable',
            'work_location_id' => 'nullable',
            'sk_pppk_date' => 'nullable',
            'sk_pppk_date_end' => 'nullable',
            'password' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'image.*.nullable' => 'Gambar bersifat opsional.',
            'image.*.image' => 'File harus berupa gambar.',
            'image.*.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
            'image.*.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'virtual_asn_card.nullable' => 'Kartu ASN virtual bersifat opsional.',
            'virtual_asn_card.unique' => 'Kartu ASN virtual sudah digunakan.',
            'username.required' => 'NIP/NIPPPK wajib diisi.',
            'username.unique' => 'NIP/NIPPPK sudah digunakan.',
            'nik_number.required' => 'Nomor NIK wajib diisi.',
            'nik_number.unique' => 'Nomor NIK sudah digunakan.',
            'nik_number.numeric' => 'Nomor NIK harus berupa angka.',
            'nik_number.digits' => 'Nomor NIK harus terdiri dari 16 digit.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.unique' => 'Nomor telepon sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'npwp_number.nullable' => 'Nomor NPWP bersifat opsional.',
            'npwp_number.unique' => 'Nomor NPWP sudah digunakan.',
            'bpjs_number.nullable' => 'Nomor BPJS bersifat opsional.',
            'bpjs_number.unique' => 'Nomor BPJS sudah digunakan.',
            'skck_number.nullable' => 'Nomor SKCK bersifat opsional.',
            'skck_number.unique' => 'Nomor SKCK sudah digunakan.',
            'pns_sk_number.nullable' => 'Nomor SK PNS bersifat opsional.',
            'pns_sk_number.unique' => 'Nomor SK PNS sudah digunakan.',
            'gelar_depan.nullable' => 'Gelar depan bersifat opsional.',
            'gelar_belakang.nullable' => 'Gelar belakang bersifat opsional.',
            'place_of_birth.required' => 'Tempat lahir wajib diisi.',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib diisi.',
            'religion.nullable' => 'Agama bersifat opsional.',
            'married_type.nullable' => 'Status pernikahan bersifat opsional.',
            'address.required' => 'Alamat wajib diisi.',
            'old_username.nullable' => 'Username lama bersifat opsional.',
            'employee_type.required' => 'Tipe pegawai wajib diisi.',
            'cpns_type.nullable' => 'Tipe CPNS bersifat opsional.',
            'sk_cpns_date.nullable' => 'Tanggal SK CPNS bersifat opsional.',
            'tmt_cpns.nullable' => 'TMT CPNS bersifat opsional.',
            'tmt_pns.nullable' => 'TMT PNS bersifat opsional.',
            'sk_pns_date.nullable' => 'Tanggal SK PNS bersifat opsional.',
            'golongan_awal.nullable' => 'Golongan awal bersifat opsional.',
            'golongan_akhir.nullable' => 'Golongan akhir bersifat opsional.',
            'golongan_awal_pppk.nullable' => 'Golongan awal PPPK bersifat opsional.',
            'golongan_akhir_pppk.nullable' => 'Golongan akhir PPPK bersifat opsional.',
            'tmt_golongan.nullable' => 'TMT golongan bersifat opsional.',
            'mk_year.nullable' => 'Masa kerja (tahun) bersifat opsional.',
            'mk_month.nullable' => 'Masa kerja (bulan) bersifat opsional.',
            'data_instansi_id.nullable' => 'ID data instansi bersifat opsional.',
            'kepangkatan.nullable' => 'Kepangkatan bersifat opsional.',
            'kpkn_id.nullable' => 'ID KPKN bersifat opsional.',
            'work_location_id.nullable' => 'ID lokasi kerja bersifat opsional.',
            'sk_pppk_date.nullable' => 'Tanggal SK PPPK bersifat opsional.',
            'sk_pppk_date_end.nullable' => 'Tanggal berakhir SK PPPK bersifat opsional.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        if ($request->employee_type == 'PPPK') {
            $validatedData['golongan_awal'] = null;
            $validatedData['golongan_akhir'] = null;
        }
        if ($request->employee_type == 'PNS' || $request->employee_type == 'Non ASN') {
            $validatedData['golongan_awal_pppk'] = null;
            $validatedData['golongan_akhir_pppk'] = null;
            $validatedData['sk_pppk_date'] = null;
            $validatedData['sk_pppk_date_end'] = null;
        }
        $uploadPath = 'upload';
        if ($request->hasFile('image')) {
            $uploadPath = 'upload';
            $localDriver = Storage::createLocalDriver(['root' => $uploadPath]);
            $pathImage = $localDriver->put('images', $request->file('image'));
            $validatedData['image'] = $pathImage;
        }
        $validatedData['password'] = bcrypt($validatedData['password']);
        Pegawai::create($validatedData);

        flash('Berhasil Menambah Data');
        return redirect()->route('pegawai.index');
    }
    public function edit($id)
    {
        $pegawaiData = Pegawai::findOrFail($id);
        $updateUrl = 'pegawai.update';
        $title = "Edit Pegawai";
        $formTitle = "Edit Pegawai";
        $dataInstansis = DataInstansi::latest()->get();
        $dataKpkns = Kpkn::latest()->get();
        $dataWorkLocations = WorkLocation::latest()->get();
        $satuanKerjaDatas = SatuanKerja::latest()->get();
        return view('back_office.pegawai.edit', compact('id', 'pegawaiData', 'updateUrl', 'title', 'formTitle', 'dataInstansis', 'dataKpkns', 'dataWorkLocations', 'satuanKerjaDatas'));
    }
    public function update(Request $request, $id)
    {
        $pegawaiData = Pegawai::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'virtual_asn_card' => 'nullable|unique:pegawais,virtual_asn_card,' . $id,
            'username' => "required|unique:pegawais,username,$id|unique:users,username," . $id,
            'nik_number' => "required|unique:pegawais,nik_number,$id|numeric|digits:16",
            'phone_number' => 'required|unique:pegawais,phone_number,' . $id,
            'email' => 'required|unique:pegawais,email,' . $id,
            'npwp_number' => 'nullable|unique:pegawais,npwp_number,' . $id,
            'bpjs_number' => 'nullable|unique:pegawais,bpjs_number,' . $id,
            'skck_number' => 'nullable|unique:pegawais,skck_number,' . $id,
            'pns_sk_number' => 'nullable|unique:pegawais,pns_sk_number,' . $id,
            'gelar_depan' => 'nullable',
            'gelar_belakang' => 'nullable',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'religion' => 'nullable',
            'married_type' => 'nullable',
            'address' => 'required',
            'old_username' => 'nullable',
            'employee_type' => 'required',
            'cpns_type' => 'nullable',
            'sk_cpns_date' => 'nullable',
            'tmt_cpns' => 'nullable',
            'tmt_pns' => 'nullable',
            'sk_pns_date' => 'nullable',
            'golongan_awal' => 'nullable',
            'golongan_akhir' => 'nullable',
            'golongan_awal_pppk' => 'nullable',
            'golongan_akhir_pppk' => 'nullable',
            'tmt_golongan' => 'nullable',
            'mk_year' => 'nullable',
            'mk_month' => 'nullable',
            'data_instansi_id' => 'nullable',
            'kepangkatan' => 'nullable',
            'kpkn_id' => 'nullable',
            'work_location_id' => 'nullable',
            'sk_pppk_date' => 'nullable',
            'sk_pppk_date_end' => 'nullable',
            'password' => 'nullable',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'image.*.nullable' => 'Gambar bersifat opsional.',
            'image.*.image' => 'File harus berupa gambar.',
            'image.*.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
            'image.*.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'virtual_asn_card.nullable' => 'Kartu ASN virtual bersifat opsional.',
            'virtual_asn_card.unique' => 'Kartu ASN virtual sudah digunakan.',
            'username.required' => 'NIP/NIPPPK wajib diisi.',
            'username.unique' => 'NIP/NIPPPK sudah digunakan.',
            'nik_number.required' => 'Nomor NIK wajib diisi.',
            'nik_number.unique' => 'Nomor NIK sudah digunakan.',
            'nik_number.numeric' => 'Nomor NIK harus berupa angka.',
            'nik_number.digits' => 'Nomor NIK harus terdiri dari 16 digit.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.unique' => 'Nomor telepon sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'npwp_number.nullable' => 'Nomor NPWP bersifat opsional.',
            'npwp_number.unique' => 'Nomor NPWP sudah digunakan.',
            'bpjs_number.nullable' => 'Nomor BPJS bersifat opsional.',
            'bpjs_number.unique' => 'Nomor BPJS sudah digunakan.',
            'skck_number.nullable' => 'Nomor SKCK bersifat opsional.',
            'skck_number.unique' => 'Nomor SKCK sudah digunakan.',
            'pns_sk_number.nullable' => 'Nomor SK PNS bersifat opsional.',
            'pns_sk_number.unique' => 'Nomor SK PNS sudah digunakan.',
            'gelar_depan.nullable' => 'Gelar depan bersifat opsional.',
            'gelar_belakang.nullable' => 'Gelar belakang bersifat opsional.',
            'place_of_birth.required' => 'Tempat lahir wajib diisi.',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib diisi.',
            'religion.nullable' => 'Agama bersifat opsional.',
            'married_type.nullable' => 'Status pernikahan bersifat opsional.',
            'address.required' => 'Alamat wajib diisi.',
            'old_username.nullable' => 'Username lama bersifat opsional.',
            'employee_type.required' => 'Tipe pegawai wajib diisi.',
            'cpns_type.nullable' => 'Tipe CPNS bersifat opsional.',
            'sk_cpns_date.nullable' => 'Tanggal SK CPNS bersifat opsional.',
            'tmt_cpns.nullable' => 'TMT CPNS bersifat opsional.',
            'tmt_pns.nullable' => 'TMT PNS bersifat opsional.',
            'sk_pns_date.nullable' => 'Tanggal SK PNS bersifat opsional.',
            'golongan_awal.nullable' => 'Golongan awal bersifat opsional.',
            'golongan_akhir.nullable' => 'Golongan akhir bersifat opsional.',
            'golongan_awal_pppk.nullable' => 'Golongan awal PPPK bersifat opsional.',
            'golongan_akhir_pppk.nullable' => 'Golongan akhir PPPK bersifat opsional.',
            'tmt_golongan.nullable' => 'TMT golongan bersifat opsional.',
            'mk_year.nullable' => 'Masa kerja (tahun) bersifat opsional.',
            'mk_month.nullable' => 'Masa kerja (bulan) bersifat opsional.',
            'data_instansi_id.nullable' => 'ID data instansi bersifat opsional.',
            'kepangkatan.nullable' => 'Kepangkatan bersifat opsional.',
            'kpkn_id.nullable' => 'ID KPKN bersifat opsional.',
            'work_location_id.nullable' => 'ID lokasi kerja bersifat opsional.',
            'sk_pppk_date.nullable' => 'Tanggal SK PPPK bersifat opsional.',
            'sk_pppk_date_end.nullable' => 'Tanggal berakhir SK PPPK bersifat opsional.',
            'password.nullable' => 'Password Boleh Kosong.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        if ($request->employee_type == 'PPPK') {
            $validatedData['golongan_awal'] = null;
            $validatedData['golongan_akhir'] = null;
        }
        if ($request->employee_type == 'PNS' || $request->employee_type == 'Non ASN') {
            $validatedData['golongan_awal_pppk'] = null;
            $validatedData['golongan_akhir_pppk'] = null;
            $validatedData['sk_pppk_date'] = null;
            $validatedData['sk_pppk_date_end'] = null;
        }

        $uploadPath = 'upload';
        if ($request->hasFile('image')) {
            $imagePath = public_path('upload/' . $pegawaiData->image);

            if (file_exists($imagePath) && !is_dir($imagePath)) {
                unlink($imagePath);
            }

            $localDriver = Storage::createLocalDriver(['root' => $uploadPath]);
            $pathImage = $localDriver->put('images', $request->image);

            $validatedData['image'] = $pathImage;
        }

        if ($validatedData['password'] == null) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        $pegawaiData->update($validatedData);
        flash('Berhasil Mengubah Data');
        return redirect()->route('pegawai.index');
    }
    public function destroy($id)
    {
        $pegawaiData = Pegawai::findOrFail($id);
        $imagePath = public_path('upload/' . $pegawaiData->image);

        if (file_exists($imagePath) && !is_dir($imagePath)) {
            unlink($imagePath);
        }
        $pegawaiData->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }

    public function detail(Request $request, $id)
    {
        $pegawaiData = Pegawai::findOrFail($id);
        $pegawaiDatas = Pegawai::latest()->get();
        if ($request->ajax()) {
            $jabatanData = Jabatan::with('pegawai')->where('pegawai_id', $id)->get();
            $cutiData = Cuti::with('pegawai')->where('pegawai_id', $id)->get();
            $kenaikanGaji = KenaikanGaji::with('pegawai')->where('pegawai_id', $id)->get();
            $tunjangan = Tunjangan::with('pegawai')->where('pegawai_id', $id)->get();
            $canEditOrDelete = auth('pegawai')->check();
            $data = [
                'pegawaiDatas' => $pegawaiDatas,
                'pegawai' => $pegawaiData,
                'jabatanData' => $jabatanData,
                'cutiData' => $cutiData,
                'kenaikanGaji' => $kenaikanGaji,
                'tunjangan' => $tunjangan,
                'canEditOrDelete' => $canEditOrDelete,
            ];

            return response()->json($data);
        }
        $title = "Pegawai";
        $formTitle = "Pegawai";
        return view('back_office.pegawai.detail', compact('title', 'formTitle', 'pegawaiData', 'pegawaiDatas'));
    }
    public function updateReadonlyInput(Request $request)
    {
        $selectedValue = $request->input('inputData');
        $satuanKerja = SatuanKerja::firstWhere('id', $selectedValue);
        $data = $satuanKerja->satuanKerjaInduk;

        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
