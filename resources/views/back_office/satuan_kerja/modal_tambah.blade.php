<!-- Modal -->
<div class="modal fade modalForm modalSingleCol" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-dialog-centered" role="document" style="display: flex; justify-content:center">
        <div class="modal-content">
            <div class="modal-body" style="display: flex; flex-direction:column; justify-content:space-between">
                <form action="{{ route($storeUrl) }}" class="wrapperForm" method="POST" id="formData" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="labelText text-gray-900 fs-bold" for="nama">{{ strtoupper($formTitle) }}</label>
                        <input value="{{ old('name') }}" name="name" type="text"
                            class="form-control {{ $errors->has('name') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Nama {{ $formTitle }}" style="width: 100%" required>
                        @error('name')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="select-container">
                            <label for="satuan_kerja_induk_id" class="labelText text-gray-900 fs-bold">SATUAN KERJA INDUK</label>
                            <select class="form-select mb-0" name="satuan_kerja_induk_id" required>
                                <option value="" selected disabled>Pilih OPD</option>
                                @foreach ($satuanKerjaIndukDatas as $satuanKerjaIndukData)
                                <option value="{{ $satuanKerjaIndukData->id }}">{{ $satuanKerjaIndukData->name }}</option>
                                @endforeach
                                @error('satuan_kerja_induk_id')
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

