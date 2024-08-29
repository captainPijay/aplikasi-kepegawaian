<!-- Modal -->
<div class="modal fade modalForm modalSingleCol" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-dialog-centered" role="document" style="display: flex; justify-content:center">
        <div class="modal-content">
            <div class="modal-body" style="display: flex; flex-direction:column; justify-content:space-between">
                <form action="{{ route($storeUrl) }}" class="wrapperForm" method="POST" id="formData" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="select-container">
                            <label class="labelText" for="pegawai_id">Nama Pegawai</label>
                            <select class="form-select mb-0" name="pegawai_id" id="pegawai_id" required>
                                <option value="" selected disabled>Pilih Nama Pegawai</option>
                                @foreach ($pegawaiDatas as $pegawaiData)
                                    <option value="{{ $pegawaiData->id }}" {{ old('pegawai_id') == $pegawaiData->id ? 'selected' : ''}}>{{ $pegawaiData->name }}</option>
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
                        <label class="labelText" for="jabatan_name">Jabatan</label>
                        <input value="{{ old('jabatan_name') }}" name="jabatan_name" type="text"
                            class="form-control {{ $errors->has('jabatan_name') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Jabatan" required>
                        @error('jabatan_name')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="labelText" for="jabatan_started_at">Tanggal Mulai Jabatan</label>
                        <input value="{{ old('jabatan_started_at') }}" name="jabatan_started_at" type="date"
                            class="form-control {{ $errors->has('jabatan_started_at') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Jabatan" required>
                        @error('jabatan_started_at')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="select-container">
                            <label class="labelText" for="bidang">Bidang</label>
                            <select class="form-select mb-0" name="bidang" id="bidang" required>
                                <option value="" selected disabled>Pilih Nama Pegawai</option>
                                <option value="Struktural" {{ old('bidang') == 'Struktural' ? 'selected' : '' }}>Struktural</option>
                                <option value="Fungsional Tertentu" {{ old('bidang') == 'Fungsional Tertentu' ? 'selected' : '' }}>Fungsional Tertentu</option>
                                <option value="Fungsional Umum" {{ old('bidang') == 'Fungsional Umum' ? 'selected' : '' }}>Fungsional Umum</option>
                                @error('bidang')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
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
