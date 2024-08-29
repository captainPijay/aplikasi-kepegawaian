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
                                <div class="select-container">
                                    <label class="labelText" for="jenis">Jenis</label>
                                    <select id="editSelectInput" class="form-select mb-0" name="jenis" id="jenis" required>
                                        <option value="" selected disabled>Pilih Jenis</option>
                                        <option value="Bersalin" {{ old('jenis') == 'Bersalin' ? 'selected': ''}}>Bersalin</option>
                                        <option value="Acara Keluarga" {{ old('jenis') == 'Acara Keluarga' ? 'selected': ''}}>Acara Keluarga</option>
                                        <option value="Sakit" {{ old('jenis') == 'Sakit' ? 'selected': ''}}>Sakit</option>
                                        @error('jenis')
                                        <div class="text-danger">
                                            <span>{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="labelText" for="surat_cuti_number">No. Surat Cuti</label>
                                <input value="{{ old('surat_cuti_number') }}" name="surat_cuti_number" type="text"
                                    class="form-control {{ $errors->has('surat_cuti_number') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Nomor Surat Cuti" required>

                                @error('surat_cuti_number')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelText" for="cuti_date">Tanggal Cuti</label>
                                <input value="{{ old('cuti_date') }}" name="cuti_date" type="date"
                                    class="form-control {{ $errors->has('cuti_date') ? 'border-danger' : 'border-none' }}" required>

                                @error('cuti_date')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="labelText" for="cuti_time">Lama Cuti</label>
                                <input id="editReadOnlyInput" placeholder="DD/MM/YY" value="{{ old('cuti_time') }}" name="cuti_time" type="text"
                                    class="form-control {{ $errors->has('cuti_time') ? 'border-danger' : 'border-none' }}"
                                    required readonly>

                                @error('cuti_time')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="labelText" for="lampiran">Lampiran</label>
                                <input value="{{ old('lampiran') }}" name="lampiran" type="file" accept=".pdf" class="form-control {{ $errors->has('lampiran') ? 'border-danger' : 'border-none' }}">

                                @error('lampiran')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
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
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
$('#editSelectInput').change(function() {
    const selectedValue = $(this).val();
    const token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('cuti.updateReadonlyInput') }}",
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: {
            inputData: selectedValue
        },
        success: function(response) {
            $('#editReadOnlyInput').val(response.cutiTime);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
</script>
