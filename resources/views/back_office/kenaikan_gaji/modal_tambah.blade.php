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
                        <label class="labelText" for="gaji_pokok">Gaji Pokok</label>
                        <input value="{{ old('gaji_pokok') }}" name="gaji_pokok" type="text"
                            class="form-control {{ $errors->has('gaji_pokok') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Gaji Pokok" required>
                        @error('gaji_pokok')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="labelText" for="calculated_date">Tanggal Terhitung</label>
                        <input value="{{ old('calculated_date') }}" name="calculated_date" type="date"
                            class="form-control {{ $errors->has('calculated_date') ? 'border-danger' : 'border-none' }}"
                            placeholder="Masukkan Tanggal Terhitung" required>
                        @error('calculated_date')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="labelText" for="akta_lahir">Dokumen Pendukung</label>
                        <input name="akta_lahir" type="file" accept=".pdf" class="form-control {{ $errors->has('akta_lahir') ? 'border-danger' : 'border-none' }}" required>

                        @error('akta_lahir')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
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
<script>
    function formatNumber(value) {
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function unformatNumber(value) {
        return value.replace(/\./g, '');
    }

    function handleInput(event) {
        let input = event.target;
        let value = input.value.replace(/\D/g, '');
        input.value = formatNumber(value);
    }

    function handleSubmit(event) {
        let form = event.target;
        let input = form.querySelector('input[name="gaji_pokok"]');
        input.value = unformatNumber(input.value);
    }

    document.addEventListener('DOMContentLoaded', function() {
        let input = document.querySelector('input[name="gaji_pokok"]');
        input.addEventListener('input', handleInput);

        let form = document.getElementById('formData');
        form.addEventListener('submit', handleSubmit);
    });
</script>
