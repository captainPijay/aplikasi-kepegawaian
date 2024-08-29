<!-- Modal -->
<div class="modal fade modalForm modalDoubleCol" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="display: flex; justify-content:center">
        <div class="modal-content">
            <div class="modal-body" style="display: flex; flex-direction:column; justify-content:space-between">
                <form action="" class="wrapperForm" method="POST" id="formEdit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input value="" name="id" id="id" type="text" hidden>
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
                                <label class="labelText" for="children_name">Nama Anak</label>
                                <input value="{{ old('children_name') }}" name="children_name" type="text"
                                    class="form-control {{ $errors->has('children_name') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Nama Anak" required>

                                @error('children_name')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="latest_education">Pendidikan Terakhir</label>
                                    <select class="form-select mb-0" name="latest_education" id="latest_education" required>
                                        <option value="" selected disabled>Pilih Pendidikan Terakhir</option>
                                        <option value="SD" {{ old('latest_education') == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('latest_education') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SLTA" {{ old('latest_education') == 'SLTA' ? 'selected' : '' }}>SLTA</option>
                                        <option value="S1" {{ old('latest_education') == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('latest_education') == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('latest_education') == 'S3' ? 'selected' : '' }}>S3</option>
                                        @error('latest_education')
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
                                <label class="labelText" for="job">Pekerjaan</label>
                                <input value="{{ old('job') }}" name="job" type="text"
                                    class="form-control {{ $errors->has('job') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Pekerjaan" required>

                                @error('job')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="labelText" for="status">Status</label>
                                    <select class="form-select mb-0" name="status" id="status" required>
                                        <option value="" selected disabled>Pilih Status</option>
                                        <option value="Anak Kandung" {{ old('status') == 'Anak Tiri' ? 'selected' : '' }}>Anak Kandung</option>
                                        <option value="Anak Tiri" {{ old('status') == 'Anak Kandung' ? 'selected' : '' }}>Anak Tiri</option>
                                        @error('status')
                                        <div class="text-danger">
                                            <span>{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex" style="justify-content: end">
                        <button class="btn-batal" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn-submit" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

