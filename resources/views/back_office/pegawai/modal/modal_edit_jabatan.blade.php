<!-- Modal -->
<div class="modal fade modalForm modalSingleCol" id="ModalEditJabatan" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-dialog-centered" role="document" style="display: flex; justify-content:center">
        <div class="modal-content">
            <div class="modal-body" style="display: flex; flex-direction:column; justify-content:space-between">
                <form action="" class="wrapperForm" method="POST" id="formEditJabatan" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input value="" name="id" id="id" type="text" hidden>
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
                    <div class="d-flex" style="justify-content: end">
                        <button class="btn-batal" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn-submit" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

