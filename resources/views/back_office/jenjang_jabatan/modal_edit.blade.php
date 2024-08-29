<!-- Modal -->
<div class="modal fade modalForm modalSingleCol" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-dialog-centered" role="document" style="display: flex; justify-content:center">
        <div class="modal-content">
            <div class="modal-body" style="display: flex; flex-direction:column; justify-content:space-between">
                <form action="" class="wrapperForm" method="POST" id="formEdit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input value="" name="id" id="id" type="text" hidden>
                    <div class="form-group">
                        <label class="labelText" for="jenjang_jabatan_name">Jenjang Jabatan</label>
                        <input value="{{ old('jenjang_jabatan_name') }}" name="jenjang_jabatan_name" type="text"
                            class="form-control {{ $errors->has('jenjang_jabatan_name') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Jabatan" required>
                        @error('jenjang_jabatan_name')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="select-container">
                            <label class="labelText" for="jabatan_pensiun">Tanggal Pensiun Sesuai Jabatan</label>
                            <select class="form-select mb-0" name="jabatan_pensiun" id="jabatan_pensiun" required>
                                <option value="" selected disabled>Pilih Jabatan</option>
                                <option value="Kadis" {{ old('jabatan_pensiun') == 'Kadis' ? 'seleceted' : '' }}>Kadis</option>
                                <option value="Sekretaris" {{ old('jabatan_pensiun') == 'Sekretaris' ? 'seleceted' : '' }}>Sekretaris</option>
                                <option value="Kasubag" {{ old('jabatan_pensiun') == 'Kasubag' ? 'seleceted' : '' }}>Kasubag</option>
                                <option value="Ahli Utama" {{ old('jabatan_pensiun') == 'Ahli Utama' ? 'seleceted' : '' }}>Ahli Utama</option>
                                <option value="Ahli Madya" {{ old('jabatan_pensiun') == 'Ahli Madya' ? 'seleceted' : '' }}>Ahli Madya</option>
                                <option value="Ahli Muda" {{ old('jabatan_pensiun') == 'Ahli Muda' ? 'seleceted' : '' }}>Ahli Muda</option>
                                <option value="Ahli Pertama" {{ old('jabatan_pensiun') == 'Ahli Pertama' ? 'seleceted' : '' }}>Ahli Pertama</option>
                                <option value="Penyelia" {{ old('jabatan_pensiun') == 'Penyelia' ? 'seleceted' : '' }}>Penyelia</option>
                                <option value="Terampil" {{ old('jabatan_pensiun') == 'Terampil' ? 'seleceted' : '' }}>Mahir</option>
                                <option value="Administrasi" {{ old('jabatan_pensiun') == 'Administrasi' ? 'seleceted' : '' }}>Administrasi</option>
                                @error('jabatan_pensiun')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </select>
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

