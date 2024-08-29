<!-- Modal -->
<div class="modal fade modalForm modalDoubleCol" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="display: flex; justify-content:center">
        <div class="modal-content">
            <div class="modal-body" style="display: flex; flex-direction:column; justify-content:space-between">
                <form action="" method="POST" id="formEdit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelText" for="name">Nama</label>
                                <input value="{{ old('name') }}" name="name" type="text"
                                    class="form-control {{ $errors->has('name') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Nama" required>

                                @error('name')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="labelText" for="username">Username</label>
                                <input value="{{ old('username') }}" name="username" type="text"
                                    class="form-control {{ $errors->has('username') ? 'border-danger' : 'border-none' }}"
                                    placeholder="Masukkan Username" required>

                                @error('username')
                                <div class="text-danger">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group" name="data_instansi_id">
                                <label for="data_instansi_id" class="labelText" id="labelText">Nama Instansi</label>
                                <select name="data_instansi_id">
                                    @foreach ($dataInstansis as $dataInstansi)
                                    <option value="{{ $dataInstansi->id }}">{{ $dataInstansi->name }}</option>
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
                                <label class="labelText" for="role">Jenis Akun</label>
                                <select class="form-select mb-0" name="role">
                                    <option value="Operator Rumah Sakit">Operator Rumah Sakit</option>
                                    <option value="Operator Puskesmas">Operator Puskesmas</option>
                                    <option value="Super Admin">Super Admin</option>
                                    @error('role')
                                    <div class="text-danger">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="labelText" for="password">Password</label>
                                <div class="input-group">
                                    <input value="{{ old('password') }}" name="password" type="password"
                                        class="form-control password-input {{ $errors->has('password') ? 'border-danger' : 'border-none' }}"
                                        placeholder="Masukkan Password">
                                    <button class="btn toggle-password" type="button" onclick="togglePasswordVisibility()">
                                        <i class="ri-eye-off-line toggle-icon" id="toggleIcon"></i>
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
                    <div class="d-flex" style="justify-content: end">
                        <button class="btn-batal" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn-submit" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('select[name="role"]').change(function() {
            const selectedRole = $(this).val();
            if (selectedRole == 'Super Admin') {
                $('#labelText').hide();
                $('select[name="data_instansi_id"], div[name="data_instansi_id"]').hide();
                $('select[name="data_instansi_id"] select,select[name="data_instansi_id"] input').val('');
            } else {
                $('#labelText').show();
                $('select[name="data_instansi_id"], div[name="data_instansi_id"]').show();
            }
        });
    });
    function togglePasswordVisibility() {
        var passwordInput = document.querySelector('.password-input');
        var toggleIcon = document.getElementById('toggleIcon');
        if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('ri-eye-off-line');
                toggleIcon.classList.add('ri-eye-line');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('ri-eye-line');
                toggleIcon.classList.add('ri-eye-off-line');
            }
    }
</script>
<style>
    .input-group {
        border: 1px solid var(--cui-input-border-color, #b1b7c1);
        border-radius: 0.375rem;
    }

    .input-group:focus-within {
        color: var(--cui-input-focus-color, rgba(44, 56, 74, 0.95));
        background-color: var(--cui-input-focus-bg, #fff);
        border-color: var(--cui-input-focus-border-color, #998fed);
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(50, 31, 219, 0.25);
    }

    .input-group input {
        border: none;
        width: fit-content !important;
        border-right: none;
    }

    .input-group input:focus-within {
        background-color: transparent;
        border-color: transparent;
        outline: 0;
        box-shadow: none;
    }

    .toggle-password {
        border-left: none !important;
        border: var(--bs-border-width) solid var(--bs-border-color);
    }

    .toggle-password:hover {
        border-color: var(--bs-border-color) !important;
    }

    .toggle-password:active {
        border-color: var(--bs-border-color) !important;
    }
</style>
