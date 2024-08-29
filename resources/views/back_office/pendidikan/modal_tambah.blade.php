<!-- Modal -->
<div class="modal fade modalForm modalDoubleCol" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="display: flex; justify-content:center">
        <div class="modal-content">
            <div class="modal-body" style="display: flex; flex-direction:column; justify-content:space-between">
                <form action="{{ route($storeUrl) }}" class="wrapperForm" method="POST" id="formData" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="pegawai_id">Nama Pegawai</label>
                                    <select class="form-select mb-0" name="pegawai_id" id="pegawai_id" required>
                                        <option value="" selected disabled>Pilih Nama Pegawai</option>
                                        @foreach ($pegawaiDatas as $pegawaiData)
                                        <option value="{{ $pegawaiData->id }}" {{ old('pegawai_id') == $pegawaiData->id ? 'selected' : '' }}>{{ $pegawaiData->name }}</option>
                                        @endforeach
                                        @error('pegawai_id')
                                        <div class="text-danger">
                                            <span>{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="jenjang">Jenjang</label>
                                    <select class="form-select mb-0" name="jenjang" id="jenjang" required>
                                        <option value="" selected disabled>Pilih Nama Jenjang</option>
                                        <option value="SD" {{ old('jenjang') == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SLTP" {{ old('jenjang') == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                                        <option value="SLTA" {{ old('jenjang') == 'SLTA' ? 'selected' : '' }}>SLTA</option>
                                        <option value="D1" {{ old('jenjang') == 'D1' ? 'selected' : '' }}>D1</option>
                                        <option value="D2" {{ old('jenjang') == 'D2' ? 'selected' : '' }}>D2</option>
                                        <option value="D3" {{ old('jenjang') == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="D4" {{ old('jenjang') == 'D4' ? 'selected' : '' }}>D4</option>
                                        <option value="S1" {{ old('jenjang') == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('jenjang') == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('jenjang') == 'S3' ? 'selected' : '' }}>S3</option>
                                        @error('jenjang')
                                        <div class="text-danger">
                                            <span>{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="name">Nama Pendidikan</label>
                                    <input value="{{ old('name') }}" name="name" type="text"
                                    class="form-control {{ $errors->has('name') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Nama Pendidikan" required>
                                        @error('name')
                                        <div class="text-danger">
                                            <span>{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="pass_date">Tahun Lulus</label>
                                    <input value="{{ old('pass_date') }}" name="pass_date" type="text"
                                    class="form-control {{ $errors->has('pass_date') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Nama Sekolah" required>
                                        @error('pass_date')
                                        <div class="text-danger">
                                            <span>{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelText" for="school">Nama Sekolah</label>
                                <input value="{{ old('school') }}" name="school" type="text"
                                    class="form-control {{ $errors->has('school') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Nama Sekolah" required>

                                @error('school')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="labelText" for="school_location">Lokasi Sekolah</label>
                                <input value="{{ old('school_location') }}" name="school_location" type="text"
                                    class="form-control {{ $errors->has('school_location') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Lokasi Sekolah" required>

                                @error('school_location')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group" style="margin-bottom: 12.8px;">
                                <label class="labelText" for="ijazah_number">No. Ijazah</label>
                                <input value="{{ old('ijazah_number') }}" name="ijazah_number" type="text"
                                    class="form-control {{ $errors->has('ijazah_number') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan No. Ijazah" required>

                                @error('ijazah_number')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="labelText" for="ijazah_date">Tanggal Ijazah</label>
                                <input value="{{ old('ijazah_date') }}" name="ijazah_date" type="date"
                                    class="form-control {{ $errors->has('ijazah_date') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Tanggal Ijazah" required>

                                @error('ijazah_date')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex" style="justify-content: end;">
                        <button class="btn-batal" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn-submit" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
