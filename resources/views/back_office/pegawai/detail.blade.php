@extends('back_office.layouts.index')
@section('content')
<div class="container-fluid bg-white detailPegawaiContainer">
    <div class="row">
        <div class="col">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-anak-tab" data-bs-toggle="pill" data-bs-target="#pills-anak"
                    type="button" role="tab" aria-controls="pills-anak" aria-selected="false"><i class="ri-group-fill"></i>Anak</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-jabatan-tab" data-bs-toggle="pill" data-bs-target="#pills-jabatan"
                    type="button" role="tab" aria-controls="pills-jabatan" aria-selected="true"><i class="ri-building-fill"></i>Jabatan</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-cuti-tab" data-bs-toggle="pill" data-bs-target="#pills-cuti"
                    type="button" role="tab" aria-controls="pills-cuti" aria-selected="false"><i class="ri-refresh-fill"></i>Cuti</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-kenaikan-gaji-tab" data-bs-toggle="pill" data-bs-target="#pills-kenaikan-gaji"
                    type="button" role="tab" aria-controls="pills-kenaikan-gaji" aria-selected="false"><i class="ri-money-dollar-circle-fill"></i>Kenaikan Gaji</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-tunjangan-tab" data-bs-toggle="pill" data-bs-target="#pills-tunjangan"
                    type="button" role="tab" aria-controls="pills-tunjangan" aria-selected="false"><i class="ri-wallet-3-fill"></i>Tunjangan</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profil" role="tabpanel" aria-labelledby="pills-profil-tab">
                    <div class="container profil-container">
                        <div class="row card-box text-center justify-content-center align-items-center">
                            <div class="photo-profil text-center">
                                <img src="{{ asset('upload/'. $pegawaiData->image) }}" alt="Belum Photo Profil">
                            </div>
                            <h1 id="name">{{ $pegawaiData->name }}</h1>
                            <h5 id="jabatan_name">Nama Jabatan</h5>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 ps-0 pe-3">
                                <div class="card card-box">
                                    <div class="card-header">Informasi Pegawai</div>
                                    <div class="card-body">
                                        <table class="table table-borderless table-profil" id="table-1">
                                            <tbody>
                                                <tr>
                                                    <td class="title-data">Nama</td>
                                                    <td class="value-data" id="name_val">{{ $pegawaiData->name ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Gelar Depan</td>
                                                    <td class="value-data" id="gelar_depan">{{ $pegawaiData->gelar_depan ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Gelar Belakang</td>
                                                    <td class="value-data" id="gelar_belakang">{{ $pegawaiData->gelar_belakang ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Tempat Lahir</td>
                                                    <td class="value-data" id="tempat_lahir">{{ $pegawaiData->place_of_birth ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Tanggal Lahir</td>
                                                    <td class="value-data" id="tanggal_lahir">{{ $pegawaiData->date_of_birth ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Jenis Kelamin</td>
                                                    <td class="value-data" id="jenis_kelamin">{{ $pegawaiData->gender ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Agama</td>
                                                    <td class="value-data" id="agama_name">{{ $pegawaiData->religion ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Jenis Kawin</td>
                                                    <td class="value-data" id="jenis_kawin">{{ $pegawaiData->married_type ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">NIK</td>
                                                    <td class="value-data" id="nik">{{ $pegawaiData->nik_number ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">No. HP</td>
                                                    <td class="value-data" id="no_hp">{{ $pegawaiData->phone_number ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Email</td>
                                                    <td class="value-data" id="email">{{ $pegawaiData->email ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Tanggal Pensiun</td>
                                                    <td class="value-data" id="pensiun_date">{{ $pegawaiData->pensiun_date ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Alamat</td>
                                                    <td class="value-data" id="alamat">{{ $pegawaiData->address ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">NPWP</td>
                                                    <td class="value-data" id="npwp">{{ $pegawaiData->npwp_number ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">BPJS</td>
                                                    <td class="value-data" id="bpjs">{{ $pegawaiData->bpjs_number ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 ps-3 pe-0">
                                <div class="card card-box">
                                    <div class="card-header">Informasi Lainnya</div>
                                    <div class="card-body">
                                        <table class="table table-borderless table-profil" id="table-3">
                                            <tbody>
                                                <tr>
                                                    <td class="title-data">ID PNS/PPPK</td>
                                                    <td class="value-data" id="id_pns">{{ $pegawaiData->id ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">NIP/NIPPPK Baru</td>
                                                    <td class="value-data" id="nip_baru">{{ $pegawaiData->username ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">NIP/NIPPPK Lama</td>
                                                    <td class="value-data" id="nip_lama">{{ $pegawaiData->old_username ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Jenis Pegawai</td>
                                                    <td class="value-data" id="jenis_pegawai">{{ $pegawaiData->employee_type ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Status CPNS</td>
                                                    <td class="value-data" id="status_cpns">{{ $pegawaiData->cpns_type ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Kartu ASN Visual</td>
                                                    <td class="value-data" id="kartu_asn_visual">{{ $pegawaiData->virtual_asn_card ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Nomor SKCK</td>
                                                    <td class="value-data" id="nomor_skck">{{ $pegawaiData->skck_number ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Tanggal SK CPNS</td>
                                                    <td class="value-data" id="tanggal_sk_cpns">{{ $pegawaiData->sk_cpns_date ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">TMT CPNS</td>
                                                    <td class="value-data" id="tmt_cpns">{{ $pegawaiData->tmt_cpns ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Nomor SK PNS</td>
                                                    <td class="value-data" id="nomor_sk_pns">{{ $pegawaiData->pns_sk_number ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Tanggal SK PNS</td>
                                                    <td class="value-data" id="tanggal_sk_pns">{{ $pegawaiData->sk_pns_date ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">TMT PNS</td>
                                                    <td class="value-data" id="tmt_pns">{{ $pegawaiData->tmt_pns ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Golongan Awal</td>
                                                    <td class="value-data" id="golongan_awal">{{ ($pegawaiData->golongan_awal ?? $pegawaiData->golongan_awal_pppk) ??'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">Golongan Akhir</td>
                                                    <td class="value-data" id="golongan_akhir">{{ ($pegawaiData->golongan_akhir ?? $pegawaiData->golongan_akhir_pppk) ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">TMT Golongan</td>
                                                    <td class="value-data" id="tmt_golongan">{{ $pegawaiData->tmt_golongan ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">MK Tahun</td>
                                                    <td class="value-data" id="mk_tahun">{{ $pegawaiData->mk_year ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="title-data">MK Bulan</td>
                                                    <td class="value-data" id="mk_bulan">{{ $pegawaiData->mk_month ?? 'Belum Ada Data' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-jabatan" role="tabpanel" aria-labelledby="pills-jabatan-tab">
                    <table class="stripe table-back-office w-100" id="jabatan_table">
                        <thead>
                            <tr>
                                <th>NAMA PEGAWAI</th>
                                <th>JABATAN</th>
                                @can('superAdmin')
                                <th>AKSI</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-cuti" role="tabpanel" aria-labelledby="pills-cuti-tab">
                    <table class="stripe table-back-office w-100" id="cuti_table">
                        <thead>
                            <tr>
                                <th>NAMA PEGAWAI</th>
                                <th>JENIS</th>
                                <th>NO. SURAT CUTI</th>
                                <th>TANGGAL CUTI</th>
                                <th>LAMA CUTI</th>
                                <th>LAMPIRAN</th>
                                @can('superAdmin')
                                <th>AKSI</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-kenaikan-gaji" role="tabpanel" aria-labelledby="pills-kenaikan-gaji-tab">
                    <table class="stripe table-back-office w-100" id="kenaikan_gaji_table">
                        <thead>
                            <tr>
                                <th>NAMA PEGAWAI</th>
                                <th>GAJI POKOK</th>
                                <th>TANGGAL GAJI</th>
                                <th>LAMPIRAN</th>
                                @can('superAdmin')
                                <th>AKSI</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-tunjangan" role="tabpanel" aria-labelledby="pills-tunjangan-tab">
                    <table class="stripe table-back-office w-100" id="tunjangan_table">
                        <thead>
                            <tr>
                                <th>NAMA PEGAWAI</th>
                                <th>SUAMI/ISTRI</th>
                                <th>ANAK</th>
                                <th>TANGGAL TERHITUNG</th>
                                <th>AKTA PERKAWINAN</th>
                                <th>AKTA LAHIR</th>
                                @can('superAdmin')
                                <th>AKSI</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('back_office.pegawai.modal.modal_edit_jabatan')
@include('back_office.pegawai.modal.modal_edit_cuti')
@include('back_office.pegawai.modal.modal_edit_kenaikan_gaji')
@include('back_office.pegawai.modal.modal_edit_tunjangan')
@include('back_office.suami_istri.modal_edit')
@include('back_office.layouts.modal_hapus')
@endsection

@section('custom_js')
<script type="text/javascript">
    var domDatatable = '<"row"<"col-sm-6"<"div"><"div">><"col-sm-6"<"div"><"div">>><"row"<"col-sm-12"tr>><"row"<"col-sm-8 d-flex align-items-center"i><"col-sm-4 d-flex justify-content-end"p>>';
    var paginateDatatable = {
        first: '<div class="icon"><i class="ri-arrow-left-double-line"></i></div>',
        previous: '<div class="icon"><i class="ri-arrow-left-s-line"></i></div>',
        next: '<div class="icon"><i class="ri-arrow-right-s-line"></i></div>',
        last: '<div class="icon"><i class="ri-arrow-right-double-line"></i></div>',
    };

    $(document).ready(function(){
        loadDataJabatan();
        loadDataCuti();
        loadDataKenaikanGaji();
        loadDataTunjangan();
    })

    function loadDataJabatan(){
        var urlPath = window.location.pathname;
        var id = urlPath.match(/\/detail\/(\d+)/)[1];
    $.ajax({
        url: "{{ route('pegawai.detail', '') }}/" + id,
        method: 'GET',
        success: function(response) {
            $('#jabatan_table').DataTable({
                processing: true,
                paging: true,
                responsive: true,
                serverSide: false,
                searching: true,
                ordering: false,
                data: response.jabatanData,
                columns: [
                    {
                        data: 'pegawai.name',
                        name: 'pegawai.name'
                    },
                    {
                        data: 'jabatan_name',
                        name: 'jabatan_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function(data, type, row) {
                            if (!response.canEditOrDelete) {
                            const { id, pegawai_id, jabatan_name } = row;
                            return `<div class='dropdown btn-aksi'>
                                <button class='btn btn-sm btn-outline-info' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                                    <i class='ri-more-line'></i>
                                </button>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <li><button onclick='editDataJabatan(${id}, ${pegawai_id}, "${jabatan_name}")' aria-expanded='false' class='btn'><i class='ri-pencil-line'></i> Ubah Data</button></li>
                                    <li><button onclick='deleteData(${id},"data-kepegawaian/jabatan/destroy")' aria-expanded='false' class='btn'><i class='ri-close-line'></i> Hapus Data</button></li>
                                </ul>
                            </div>`;
                        }else{
                            return '';
                        }
                    }
                    }
                ],
                language: {
                    paginate: paginateDatatable
                },
                pagingType: 'full_numbers',
                dom: domDatatable
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    }

    function loadDataCuti(){
        var urlPath = window.location.pathname;
        var id = urlPath.match(/\/detail\/(\d+)/)[1];
    $.ajax({
        url: "{{ route('pegawai.detail', '') }}/" + id,
        method: 'GET',
        success: function(response) {
            $('#cuti_table').DataTable({
                processing: true,
                paging: true,
                responsive: true,
                serverSide: false,
                searching: true,
                ordering: false,
                data: response.cutiData,
                columns: [
                    {
                        data: 'pegawai.name',
                        name: 'pegawai.name'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
                    },
                    {
                        data: 'surat_cuti_number',
                        name: 'surat_cuti_number'
                    },
                    {
                        data: 'cuti_date',
                        name: 'cuti_date'
                    },
                    {
                        data: 'cuti_time',
                        name: 'cuti_time'
                    },
                    {
                        data: 'lampiran',
                        name: 'lampiran',
                        render: function(data, type, row) {
                            return `<a href="{{ asset('upload/') }}/${row.lampiran}" target="_blank"><i class='ri-file-list-3-line' style='color:#556FF6;font-size:30px;'></i></a>`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function(data, type, row) {
                            if (!response.canEditOrDelete) {
                            const { id, pegawai_id, jenis,surat_cuti_number,cuti_date,cuti_time } = row;
                            return `<div class='dropdown btn-aksi'>
                                <button class='btn btn-sm btn-outline-info' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                                    <i class='ri-more-line'></i>
                                </button>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <li><button onclick='editDataCuti(${id}, ${pegawai_id}, "${jenis}","${surat_cuti_number}","${cuti_date}","${cuti_time}")' aria-expanded='false' class='btn'><i class='ri-pencil-line'></i> Ubah Data</button></li>
                                    <li><button onclick='deleteData(${id},"data-kepegawaian/cuti/destroy")' aria-expanded='false' class='btn'><i class='ri-close-line'></i> Hapus Data</button></li>
                                </ul>
                            </div>`;
                        }else{
                            return '';
                        }
                        }
                    }
                ],
                language: {
                    paginate: paginateDatatable
                },
                pagingType: 'full_numbers',
                dom: domDatatable
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    }

    function loadDataKenaikanGaji(){
        var urlPath = window.location.pathname;
        var id = urlPath.match(/\/detail\/(\d+)/)[1];
    $.ajax({
        url: "{{ route('pegawai.detail', '') }}/" + id,
        method: 'GET',
        success: function(response) {
            $('#kenaikan_gaji_table').DataTable({
                processing: true,
                paging: true,
                responsive: true,
                serverSide: false,
                searching: true,
                ordering: false,
                data: response.kenaikanGaji,
                columns: [
                    {
                        data: 'pegawai.name',
                        name: 'pegawai.name'
                    },
                    {
                        data: 'gaji_pokok',
                        name: 'gaji_pokok',
                        render: function(data, type, row) {
                            // Memformat gaji_pokok menjadi 500.000
                            return parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'calculated_date',
                        name: 'calculated_date',
                    },
                    {
                        data: 'akta_lahir',
                        name: 'akta_lahir',
                        render: function(data, type, row) {
                            return `<a href="{{ asset('upload/') }}/${row.akta_lahir}" target="_blank"><i class='ri-file-list-3-line' style='color:#556FF6;font-size:30px;'></i></a>`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function(data, type, row) {
                            if (!response.canEditOrDelete) {
                            const { id, pegawai_id, gaji_pokok, calculated_date, akta_lahir } = row;
                            return `<div class='dropdown btn-aksi'>
                                <button class='btn btn-sm btn-outline-info' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                                    <i class='ri-more-line'></i>
                                </button>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <li><button onclick='editDataKenaikanGaji(${id}, ${pegawai_id},"${gaji_pokok}", "${calculated_date}", "${akta_lahir}")' aria-expanded='false' class='btn'><i class='ri-pencil-line'></i> Ubah Data</button></li>

                                    <li><button onclick='deleteData(${id},"data-kepegawaian/kenaikan-gaji/destroy")' aria-expanded='false' class='btn'><i class='ri-close-line'></i> Hapus Data</button></li>
                                </ul>
                            </div>`;
                        }else{
                            return '';
                        }
                        }
                    }
                ],
                language: {
                    paginate: paginateDatatable
                },
                pagingType: 'full_numbers',
                dom: domDatatable
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    }

    function loadDataTunjangan(){
        var urlPath = window.location.pathname;
        var id = urlPath.match(/\/detail\/(\d+)/)[1];
    $.ajax({
        url: "{{ route('pegawai.detail', '') }}/" + id,
        method: 'GET',
        success: function(response) {
            $('#tunjangan_table').DataTable({
                processing: true,
                paging: true,
                responsive: true,
                serverSide: false,
                searching: true,
                ordering: false,
                data: response.tunjangan,
                columns: [
                    {
                        data: 'pegawai.name',
                        name: 'pegawai.name'
                    },
                    {
                        data: 'suami_atau_istri',
                        name: 'suami_atau_istri',
                    },
                    {
                        data: 'anak',
                        name: 'anak',
                    },
                    {
                        data: 'calculated_date',
                        name: 'calculated_date',
                    },
                    {
                        data: 'akta_perkawinan',
                        name: 'akta_perkawinan',
                        render: function(data, type, row) {
                            return `<a href="{{ asset('upload/') }}/${row.akta_perkawinan}" target="_blank">Akta Perkawinan ${row.pegawai.name}</a>`;
                        }
                    },
                    {
                        data: 'akta_lahir',
                        name: 'akta_lahir',
                        render: function(data, type, row) {
                            return `<a href="{{ asset('upload/') }}/${row.akta_lahir}" target="_blank">Akta Lahir ${row.pegawai.name}</a>`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function(data, type, row) {
                            const {id,pegawai_id,suami_atau_istri,anak,calculated_date} = row;

                            if (!response.canEditOrDelete) {
                                return `<div class='dropdown btn-aksi'>
                                    <button class='btn btn-sm btn-outline-info' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <i class='ri-more-line'></i>
                                    </button>
                                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <li><button onclick='editDataTunjangan(${id}, ${pegawai_id},"${suami_atau_istri}","${anak}", "${calculated_date}")' aria-expanded='false' class='btn'><i class='ri-pencil-line'></i> Ubah Data</button></li>
                                        <li><button onclick='deleteData(${id},"data-kepegawaian/tunjangan/destroy")' aria-expanded='false' class='btn'><i class='ri-close-line'></i> Hapus Data</button></li>
                                    </ul>
                                </div>`;
                            } else {
                                return '';
                            }
                        }
                    }
                ],
                language: {
                    paginate: paginateDatatable
                },
                pagingType: 'full_numbers',
                dom: domDatatable
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    }
    function deleteData(id, route) {
        let url = `/back-office/${route}/${id}`
        $('#formDelete').attr('action', url);
        $('#ModalDelete').modal('show');
    }
    function editDataJabatan(id,pegawai_id,jabatan_name) {
        $("#formEditJabatan input[name='id']").val(id);
        $("#formEditJabatan select[name='pegawai_id']").val(pegawai_id);
        $("#formEditJabatan input[name='jabatan_name']").val(jabatan_name);
        $('#formEditJabatan').attr('action', "{{ route('jabatan.update', '') }}" + '/' + id);
        $('#ModalEditJabatan').modal('show');
    }
    function editDataCuti(id,pegawai_id,jenis,surat_cuti_number,cuti_date,cuti_time) {
        $("#formEditCuti input[name='id']").val(id);
        $("#formEditCuti select[name='pegawai_id']").val(pegawai_id);
        $("#formEditCuti select[name='jenis']").val(jenis);
        $("#formEditCuti input[name='surat_cuti_number']").val(surat_cuti_number);
        $("#formEditCuti input[name='cuti_date']").val(cuti_date);
        $("#formEditCuti input[name='cuti_time']").val(cuti_time);
        $('#formEditCuti').attr('action', "{{ route('cuti.update', '') }}" + '/' + id);
        $('#ModalEditCuti').modal('show');
    }
    function editDataKenaikanGaji(id,pegawai_id,gaji_pokok,calculated_date,akta_lahir) {
        $("#formEditKenaikanGaji input[name='id']").val(id);
        $("#formEditKenaikanGaji select[name='pegawai_id']").val(pegawai_id);
        $("#formEditKenaikanGaji input[name='gaji']").val(gaji_pokok);
        $("#formEditKenaikanGaji input[name='calculated_date']").val(calculated_date);
        $("#formEditKenaikanGaji select[name='akta_lahir']").val(akta_lahir);
        $('#formEditKenaikanGaji').attr('action', "{{ route('kenaikanGaji.update', '') }}" + '/' + id);
        $('#ModalEditKenaikanGaji').modal('show');
    }
    function editDataTunjangan(id,pegawai_id,suami_atau_istri,anak,calculated_date) {
        $("#formEditTunjangan input[name='id']").val(id);
        $("#formEditTunjangan select[name='pegawai_id']").val(pegawai_id);
        $("#formEditTunjangan select[name='suami_atau_istri']").val(suami_atau_istri);
        $("#formEditTunjangan select[name='anak']").val(anak);
        $("#formEditTunjangan input[name='calculated_date']").val(calculated_date);
        $('#formEditTunjangan').attr('action', "{{ route('tunjangan.update', '') }}" + '/' + id);
        $('#ModalEditTunjangan').modal('show');
    }
</script>
@endsection
