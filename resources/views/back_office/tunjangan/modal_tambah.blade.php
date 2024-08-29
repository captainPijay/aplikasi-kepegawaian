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
                                            <option value="{{ $pegawaiData->id }}">{{ $pegawaiData->name }}</option>
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
                                    <label class="labelText" for="suami_atau_istri">Suami Atau Istri</label>
                                    <select class="form-select mb-0" name="suami_atau_istri" id="suami_atau_istri" required>
                                        <option value="" selected disabled>Apakah Memiliki Suami/Istri?</option>
                                        <option value="Iya" {{ old('suami_atau_istri') == 'Iya' ? 'selected' : '' }}>Iya</option>
                                        <option value="Tidak" {{ old('suami_atau_istri') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                        @error('suami_atau_istri')
                                        <div class="text-danger">
                                            <span>{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="anak">Anak</label>
                                    <select class="form-select mb-0" name="anak" id="anak" required>
                                        <option value="" selected disabled>Apakah Memiliki Anak?</option>
                                        <option value="Iya" {{ old('anak') == 'Iya' ? 'selected' : '' }}>Iya</option>
                                        <option value="Tidak" {{ old('anak') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                        @error('anak')
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
                                <label class="labelText" for="calculated_date">Tanggal Terhitung</label>
                                <input value="{{ old('calculated_date') }}" name="calculated_date" type="date"
                                    class="form-control {{ $errors->has('calculated_date') ? 'border-danger' : 'border-none' }}" required>

                                @error('calculated_date')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="labelText" for="akta_perkawinan">Akta Perkawinan</label>
                                <input value="{{ old('akta_perkawinan') }}" name="akta_perkawinan" type="file" accept=".pdf"
                                    class="form-control {{ $errors->has('akta_perkawinan') ? 'border-danger' : 'border-none' }}">

                                @error('akta_perkawinan')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="labelText" for="akta_lahir">Akta Lahir</label>
                                <input value="{{ old('akta_lahir') }}" name="akta_lahir" type="file" accept=".pdf"
                                    class="form-control {{ $errors->has('akta_lahir') ? 'border-danger' : 'border-none' }}">

                                @error('akta_lahir')
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
