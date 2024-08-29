@extends('back_office.layouts.index')
@section('content')
<div class="container-fluid bg-white formPegawaiContainer">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-informasi-pribadi-tab" data-bs-toggle="tab" data-bs-target="#nav-informasi-pribadi" type="button" role="tab" aria-controls="nav-informasi-pribadi" aria-selected="true">Informasi Pegawai</button>
          <button class="nav-link" id="nav-informasi-lainnya-tab" data-bs-toggle="tab" data-bs-target="#nav-informasi-lainnya" type="button" role="tab" aria-controls="nav-informasi-lainnya" aria-selected="false">Informasi Lainnya</button>
        </div>
    </nav>
    <form action="{{ route($storeUrl) }}" class="wrapperForm" method="POST" id="formData" enctype="multipart/form-data">
        @csrf
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-informasi-pribadi" role="tabpanel" aria-labelledby="nav-informasi-pribadi-tab">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="nama">Nama <span class="text-danger">*</span></label>
                            <input value="{{ old('name') }}" name="name" type="text"
                                class="form-control {{ $errors->has('name') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Nama" >

                            @error('name')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="employee_type">Jenis Pegawai <span class="text-danger">*</span></label>
                            <select class="form-select mb-0" name="employee_type" id="employee_type" >
                                <option value="" selected disabled>Pilih Jenis Pegawai</option>
                                <option value="PNS" {{ old('employee_type') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                <option value="PPPK" {{ old('employee_type') == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                <option value="Non ASN" {{ old('employee_type') == 'Non ASN' ? 'selected' : '' }}>Non ASN</option>
                                @error('employee_type')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="image">Foto</label>
                                <input value="{{ old('image') }}" name="image" type="file" accept="image/*"
                                    class="form-control {{ $errors->has('image') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Tanggal Lahir">

                            @error('image')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="gelar_depan">Gelar Depan</label>
                            <input value="{{ old('gelar_depan') }}" name="gelar_depan" type="text"
                                class="form-control {{ $errors->has('gelar_depan') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Gelar Depan">

                            @error('gelar_depan')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="gelar_belakang">Gelar Belakang</label>
                            <input value="{{ old('gelar_belakang') }}" name="gelar_belakang" type="text"
                                class="form-control {{ $errors->has('gelar_belakang') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Gelar Belakang">

                            @error('gelar_belakang')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="place_of_birth">Tempat Lahir <span class="text-danger">*</span></label>
                            <input value="{{ old('place_of_birth') }}" name="place_of_birth" type="text"
                                class="form-control {{ $errors->has('place_of_birth') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Tempat Lahir" >

                            @error('place_of_birth')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="date_of_birth">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input value="{{ old('date_of_birth') }}" name="date_of_birth" type="date"
                                class="form-control {{ $errors->has('date_of_birth') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Tanggal Lahir" >

                            @error('date_of_birth')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select mb-0" name="gender" id="gender" >
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki" {{ old('gender') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>

                                @error('gender')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="religion">Agama <span class="text-danger">*</span></label>
                            <select class="form-select mb-0" name="religion" id="religion" >
                                <option value="" selected disabled>Pilih Agama</option>
                                <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Budha" {{ old('religion') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                <option value="Kong Hu Cu" {{ old('religion') == 'Kong Hu Cu' ? 'selected' : '' }}>Kong Hu Cu</option>
                                <option value="Lainnya" {{ old('religion') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>

                                @error('religion')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="married_type">Jenis Kawin</label>
                            <select class="form-select mb-0" name="married_type" id="married_type">
                                <option value="" selected disabled>Pilih Jenis Kawin</option>
                                <option value="Menikah" {{ old('married_type') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="Belum Menikah" {{ old('married_type') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>

                                @error('married_type')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="nik_number">Nomor NIK <span class="text-danger">*</span></label>
                            <input id="nik_number" value="{{ old('nik_number') }}" name="nik_number" type="text"
                                class="form-control {{ $errors->has('nik_number') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Nomor NIK" >

                            @error('nik_number')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="phone_number">Nomor HP <span class="text-danger">*</span></label>
                            <input value="{{ old('phone_number') }}" name="phone_number" type="text"
                                class="form-control {{ $errors->has('phone_number') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Nomor HP" >

                            @error('phone_number')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="email">Email <span class="text-danger">*</span></label>
                            <input value="{{ old('email') }}" name="email" type="email"
                                class="form-control {{ $errors->has('email') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Email" >

                            @error('email')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="address">Alamat <span class="text-danger">*</span></label>
                            <input value="{{ old('address') }}" name="address" type="text"
                                class="form-control {{ $errors->has('address') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Alamat" >

                            @error('address')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="npwp_number">Nomor NPWP</label>
                            <input value="{{ old('npwp_number') }}" name="npwp_number" type="text"
                                class="form-control {{ $errors->has('npwp_number') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Nomor NPWP">

                            @error('npwp_number')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="bpjs_number">Nomor BPJS</label>
                            <input value="{{ old('bpjs_number') }}" name="bpjs_number" type="text"
                                class="form-control {{ $errors->has('bpjs_number') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Nomor BPJS">

                            @error('bpjs_number')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex" style="justify-content: end;">
                    <button class="btn-selanjutnya" type="button">Selanjutnya</button>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-informasi-lainnya" role="tabpanel" aria-labelledby="nav-informasi-lainnya-tab">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="username" id="nip_baru_text">NIP Baru <span class="text-danger">*</span></label>
                            <input value="{{ old('username') }}" name="username" type="text"
                                class="form-control {{ $errors->has('username') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan NIP Baru" >

                            @error('username')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="old_username" id="nip_lama_text">NIP Lama</label>
                            <input value="{{ old('old_username') }}" name="old_username" type="text"
                                class="form-control {{ $errors->has('old_username') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan NIP Lama">

                            @error('old_username')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>

                    {{-- pppk details --}}
                    <div class="col-sm-6 pppkDetails" style="display:none">
                        <div class="form-group">
                            <label class="labelText" for="sk_pppk_date">Tanggal SK PPPK</label>
                            <input value="{{ old('sk_pppk_date') }}" name="sk_pppk_date" type="date"
                                class="form-control {{ $errors->has('sk_pppk_date') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan SK PPPK Berakhir">

                            @error('sk_pppk_date')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 pppkDetails" style="display:none">
                        <div class="form-group">
                            <label class="labelText" for="sk_pppk_date_end">Tanggal SK PPPK Berakhir</label>
                            <input value="{{ old('sk_pppk_date_end') }}" name="sk_pppk_date_end" type="date"
                                class="form-control {{ $errors->has('sk_pppk_date_end') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Tanggal Berakhir SK PPPK Berakhir">

                            @error('sk_pppk_date_end')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 pppkDetails" style="display:none">
                        <div class="form-group">
                            <label class="labelText" for="golongan_awal_pppk">Golongan Awal</label>
                            <select class="form-select mb-0" name="golongan_awal_pppk" id="golongan_awal_pppk">
                                <option value="" selected disabled>Pilih Golongan Awal</option>
                                @for ($i = 5; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('golongan_awal_pppk') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                                @error('golongan_awal_pppk')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 pppkDetails" style="display:none">
                        <div class="form-group">
                            <label class="labelText" for="golongan_akhir_pppk">Golongan Akhir</label>
                            <select class="form-select mb-0" name="golongan_akhir_pppk" id="golongan_akhir_pppk">
                                <option value="" selected disabled>Pilih Golongan Akhir</option>
                                @for ($i = 5; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('golongan_akhir_pppk') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor

                                @error('golongan_akhir_pppk')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    {{-- end pppk-details --}}

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="cpns_type">Jenis CPNS</label>
                            <select class="form-select mb-0" name="cpns_type" id="cpns_type">
                                <option value="" selected disabled>Pilih Jenis CPNS</option>
                                <option value="PNS Provinsi" {{ old('cpns_type') == 'PNS Provinsi' ? 'selected' : '' }}>PNS Provinsi</option>
                                <option value="PNS Kota" {{ old('cpns_type') == 'PNS Kota' ? 'selected' : '' }}>PNS Kota</option>
                                @error('cpns_type')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="virtual_asn_card">Nomor Kartu ASN Virtual</label>
                            <input value="{{ old('virtual_asn_card') }}" name="virtual_asn_card" type="text"
                                class="form-control {{ $errors->has('virtual_asn_card') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Nomor Kartu Asn Virtual">

                            @error('virtual_asn_card')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="skck_number">Nomor SKCK</label>
                            <input value="{{ old('skck_number') }}" name="skck_number" type="text"
                                class="form-control {{ $errors->has('skck_number') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Nomor SKCK">

                            @error('skck_number')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 pnsDetails">
                        <div class="form-group">
                            <label class="labelText" for="sk_cpns_date">Tanggal SK CPNS</label>
                            <input value="{{ old('sk_cpns_date') }}" name="sk_cpns_date" type="date"
                                class="form-control {{ $errors->has('sk_cpns_date') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Tanggal SK CPNS">

                            @error('sk_cpns_date')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 pnsDetails">
                        <div class="form-group">
                            <label class="labelText" for="tmt_cpns">TMT CPNS</label>
                            <input value="{{ old('tmt_cpns') }}" name="tmt_cpns" type="date"
                                class="form-control {{ $errors->has('tmt_cpns') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan TMT CPNS">

                            @error('tmt_cpns')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 pnsDetails">
                        <div class="form-group">
                            <label class="labelText" for="pns_sk_number">Nomor SK PNS</label>
                            <input value="{{ old('pns_sk_number') }}" name="pns_sk_number" type="text"
                                class="form-control {{ $errors->has('pns_sk_number') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan TMT CPNS">

                            @error('pns_sk_number')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 pnsDetails">
                        <div class="form-group">
                            <label class="labelText" for="sk_pns_date">Tanggal SK PNS</label>
                            <input value="{{ old('sk_pns_date') }}" name="sk_pns_date" type="date"
                                class="form-control {{ $errors->has('sk_pns_date') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan TMT CPNS">

                            @error('sk_pns_date')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 pnsDetails">
                        <div class="form-group">
                            <label class="labelText" for="tmt_pns">TMT PNS</label>
                            <input value="{{ old('tmt_pns') }}" name="tmt_pns" type="date"
                                class="form-control {{ $errors->has('tmt_pns') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan TMT CPNS">

                            @error('tmt_pns')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="kepangkatan">Kepangkatan</label>
                            <input value="{{ old('kepangkatan') }}" name="kepangkatan" type="text"
                                class="form-control {{ $errors->has('kepangkatan') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan Pangkat CPNS">
                            @error('kepangkatan')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6" id="golongan_awal_pns">
                        <div class="form-group">
                            <label class="labelText" for="golongan_awal">Golongan Awal</label>
                            <select class="form-select mb-0" name="golongan_awal" id="golongan_awal">
                                <option value="" selected disabled>Pilih Golongan Awal</option>
                                <option value="I-A" {{ old('golongan_awal') == 'I-A' ? 'selected' : '' }}>I-A</option>
                                <option value="I-B" {{ old('golongan_awal') == 'I-B' ? 'selected' : '' }}>I-B</option>
                                <option value="I-C" {{ old('golongan_awal') == 'I-C' ? 'selected' : '' }}>I-C</option>
                                <option value="I-D" {{ old('golongan_awal') == 'I-D' ? 'selected' : '' }}>I-D</option>
                                <option value="II-A" {{ old('golongan_awal') == 'II-A' ? 'selected' : '' }}>II-A</option>
                                <option value="II-B" {{ old('golongan_awal') == 'II-B' ? 'selected' : '' }}>II-B</option>
                                <option value="II-C" {{ old('golongan_awal') == 'II-C' ? 'selected' : '' }}>II-C</option>
                                <option value="II-D" {{ old('golongan_awal') == 'II-D' ? 'selected' : '' }}>II-D</option>
                                <option value="III-A" {{ old('golongan_awal') == 'III-A' ? 'selected' : '' }}>III-A</option>
                                <option value="III-B" {{ old('golongan_awal') == 'III-B' ? 'selected' : '' }}>III-B</option>
                                <option value="III-C" {{ old('golongan_awal') == 'III-C' ? 'selected' : '' }}>III-C</option>
                                <option value="III-D" {{ old('golongan_awal') == 'III-D' ? 'selected' : '' }}>III-D</option>
                                <option value="IV-A" {{ old('golongan_awal') == 'IV-A' ? 'selected' : '' }}>IV-A</option>
                                <option value="IV-B" {{ old('golongan_awal') == 'IV-B' ? 'selected' : '' }}>IV-B</option>
                                <option value="IV-C" {{ old('golongan_awal') == 'IV-C' ? 'selected' : '' }}>IV-C</option>
                                <option value="IV-D" {{ old('golongan_awal') == 'IV-D' ? 'selected' : '' }}>IV-D</option>
                                <option value="IV-E" {{ old('golongan_awal') == 'IV-E' ? 'selected' : '' }}>IV-E</option>
                                @error('golongan_awal')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6" id="golongan_akhir_pns">
                        <div class="form-group">
                            <label class="labelText" for="golongan_akhir">Golongan Akhir</label>
                            <select class="form-select mb-0" name="golongan_akhir" id="golongan_akhir">
                                <option value="" selected disabled>Pilih Golongan Akhir</option>
                                <option value="I-A" {{ old('golongan_awal') == 'I-A' ? 'selected' : '' }}>I-A</option>
                                <option value="I-B" {{ old('golongan_awal') == 'I-B' ? 'selected' : '' }}>I-B</option>
                                <option value="I-C" {{ old('golongan_awal') == 'I-C' ? 'selected' : '' }}>I-C</option>
                                <option value="I-D" {{ old('golongan_awal') == 'I-D' ? 'selected' : '' }}>I-D</option>
                                <option value="II-A" {{ old('golongan_awal') == 'II-A' ? 'selected' : '' }}>II-A</option>
                                <option value="II-B" {{ old('golongan_awal') == 'II-B' ? 'selected' : '' }}>II-B</option>
                                <option value="II-C" {{ old('golongan_awal') == 'II-C' ? 'selected' : '' }}>II-C</option>
                                <option value="II-D" {{ old('golongan_awal') == 'II-D' ? 'selected' : '' }}>II-D</option>
                                <option value="III-A" {{ old('golongan_awal') == 'III-A' ? 'selected' : '' }}>III-A</option>
                                <option value="III-B" {{ old('golongan_awal') == 'III-B' ? 'selected' : '' }}>III-B</option>
                                <option value="III-C" {{ old('golongan_awal') == 'III-C' ? 'selected' : '' }}>III-C</option>
                                <option value="III-D" {{ old('golongan_awal') == 'III-D' ? 'selected' : '' }}>III-D</option>
                                <option value="IV-A" {{ old('golongan_awal') == 'IV-A' ? 'selected' : '' }}>IV-A</option>
                                <option value="IV-B" {{ old('golongan_awal') == 'IV-B' ? 'selected' : '' }}>IV-B</option>
                                <option value="IV-C" {{ old('golongan_awal') == 'IV-C' ? 'selected' : '' }}>IV-C</option>
                                <option value="IV-D" {{ old('golongan_awal') == 'IV-D' ? 'selected' : '' }}>IV-D</option>
                                <option value="IV-E" {{ old('golongan_awal') == 'IV-E' ? 'selected' : '' }}>IV-E</option>
                                @error('golongan_akhir')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="tmt_golongan">TMT Golongan</label>
                            <input value="{{ old('tmt_golongan') }}" name="tmt_golongan" type="date"
                                class="form-control {{ $errors->has('tmt_golongan') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan TMT Golongan">

                            @error('tmt_golongan')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="mk_year">MK Tahun</label>
                            <input value="{{ old('mk_year') }}" name="mk_year" type="text"
                                class="form-control {{ $errors->has('mk_year') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan MK Tahun">

                            @error('mk_year')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="mk_month">MK Bulan</label>
                            <input value="{{ old('mk_month') }}" name="mk_month" type="Text"
                                class="form-control {{ $errors->has('mk_month') ? 'border-danger' : 'border-none' }}"
                                placeholder="Masukkan MK Bulan">

                            @error('mk_month')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="data_instansi_id">Data Instansi <span class="text-danger">*</span></label>
                            <select class="form-select mb-0" name="data_instansi_id" id="data_instansi_id" >
                                <option value="" selected disabled>Pilih Instansi</option>
                                @foreach ($dataInstansis as $dataInstansi)
                                <option value="{{ $dataInstansi->id }}" {{ old('data_instansi_id') == $dataInstansi->id ? 'selected' : ''}}>{{ $dataInstansi->name }}</option>
                                @endforeach
                                @error('data_instansi_id')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="kpkn_id">KPKN <span class="text-danger">*</span></label>
                            <select class="form-select mb-0" name="kpkn_id" >
                                <option value="" selected disabled>Pilih KPKN</option>
                                @foreach ($dataKpkns as $dataKpkn)
                                <option value="{{ $dataKpkn->id }}" {{ old('kpkn_id') == $dataKpkn->id ? 'selected' : ''}}>{{ $dataKpkn->name }}</option>
                                @endforeach
                                @error('kpkn_id')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="work_location_id">Lokasi Kerja <span class="text-danger">*</span></label>
                            <select class="form-select mb-0" name="work_location_id" >
                                <option value="" selected disabled>Pilih Lokasi Kerja</option>
                                @foreach ($dataWorkLocations as $dataWorkLocation)
                                <option value="{{ $dataWorkLocation->id }}" {{ old('work_location_id') == $dataWorkLocation->id ? 'selected' : ''}}>{{ $dataWorkLocation->name }}</option>
                                @endforeach
                                @error('work_location_id')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelText" for="password">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input value="{{ old('password') }}" name="password" type="password"
                                    class="form-control password-toggle {{ $errors->has('password') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Password" >
                                <button style="position: block" class="btn toggle-password" type="button">
                                    <i class="ri-eye-off-line toggle-icon"></i>
                                </button>
                            </div>
                            @error('password')
                            <div class="text-danger">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex" style="justify-content: end;">
                    <button class="btn btn-batal" type="button">Batal</button>
                    <button class="btn-submit" type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
<style>
    .formPegawaiContainer .form-control {
        height: 45px;
    }

    .formPegawaiContainer .form-group {
        margin-bottom: 20px;
    }

    .formPegawaiContainer input[type="file"] {
        height: 43px;
    }

    .formPegawaiContainer input[type="file"]::-webkit-file-upload-button {
        height: 43px;
    }

    .formPegawaiContainer .labelText {
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 14px;
    }

    .formPegawaiContainer .btn-submit,
    .formPegawaiContainer .btn-selanjutnya {
        width: 115px;
        height: 44px;
        border-radius: 6px;
        margin-left: 5px;
        background-color: #556FF6;
        color: #fff;
        border: none;
        transition: background-color 0.3s;
    }

    .formPegawaiContainer .btn-submit:hover,
    .formPegawaiContainer .btn-selanjutnya:hover {
        background-color: #02b4d3;
    }

    .formPegawaiContainer .btn-batal {
        width: 115px;
        height: 44px;
        border-radius: 6px;
        margin-left: 5px;
        background-color: #ffff;
        color: #EB5757;
        border: red solid 1px;
    }

    .formPegawaiContainer .input-group-text {
        cursor: pointer;
        height: 45px;
        background-color: #fff;
        border-left: none;
        color: #A1A9B8;
    }

    .formPegawaiContainer .input-select {
        width: 155px;
        height: 45px;
        border-radius: 6px;
        color: #000;
        border: #A1A9B8 solid 0.5px;
    }

    .formPegawaiContainer .form-group select {
        /* width: 320px; */
        height: 45px;
        padding: 0.375rem 0.5rem;
        margin-bottom: 1.5rem;
        border: #cdcdcd 1px solid;
        border-radius: 6px;
    }

    .formPegawaiContainer .select-container {
        display: flex;
        flex-direction: column;
    }

    .formPegawaiContainer .select-container select {
        width: 100%;
    }
    .input-group input{
        border-right: none;
    }
    .input-group button{
        border: #A1A9B8 solid 0.5px;
        border-left: none;
    }
    .input-group button:hover{
        border: #A1A9B8 solid 0.5px;
        border-left: none;
    }
</style>
@endsection

@section('custom_js')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".btn-selanjutnya").click(function(){
            $("#nav-informasi-pribadi-tab").removeClass("active");
            $("#nav-informasi-lainnya-tab").addClass("active");
            $("#nav-informasi-pribadi").removeClass("show active");
            $("#nav-informasi-lainnya").addClass("show active");
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });

        $(".btn-batal").click(function(){
            window.location.href = '{{ route("pegawai.index") }}';
        });
        $('input[name="nik_number"]').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    })
    const passwordInput = document.querySelector('.password-toggle');
        const toggleButton = document.querySelector('.toggle-password');

        toggleButton.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            if (type === 'password') {
                toggleButton.innerHTML = '<i class="ri-eye-off-line toggle-icon"></i>';
            } else {
                toggleButton.innerHTML = '<i class="ri-eye-line toggle-icon"></i>';
            }
        });
document.addEventListener('DOMContentLoaded', function() {
    const employeeTypeSelect = document.getElementById('employee_type');

    const nipBaru = document.getElementById('nip_baru_text');
    const nipLama = document.getElementById('nip_lama_text');

    const golonganAwalPns = document.getElementById('golongan_awal_pns');
    const golonganAkhirPns = document.getElementById('golongan_akhir_pns');

    const pppkDetails = document.querySelectorAll('.pppkDetails');
    const pnsDetails = document.querySelectorAll('.pnsDetails');

    employeeTypeSelect.addEventListener('change', function() {
        pppkDetails.forEach((element) => {
            if (employeeTypeSelect.value === 'PPPK') {
                element.style.display = 'block';
                golonganAwalPns.style.display = 'none';
                golonganAkhirPns.style.display = 'none';
                nipBaru.innerHTML = `NIPPPK Baru <span class="text-danger">*</span>`;
                nipLama.innerHTML = `NIPPPK Lama`;
                pnsDetails.forEach((e) => {
                    e.style.display = 'none';
                })
            } else {
                element.style.display = 'none';
                golonganAwalPns.style.display = 'block';
                golonganAkhirPns.style.display = 'block';
                nipBaru.innerHTML = `NIP Baru <span class="text-danger">*</span>`;
                nipLama.innerHTML = `NIP Lama`;
                pnsDetails.forEach((e) => {
                    e.style.display = 'block';
                })
            }
        });
    });
});
document.getElementById('nik_number').addEventListener('input', function (e) {
        let input = e.target;
        let value = input.value;

        if (value.length > 16) {
            input.value = value.slice(0, 16);
        }
    });
</script>
@endsection
