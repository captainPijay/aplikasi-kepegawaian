<!-- Modal -->
<div class="modal fade modalDelete" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width: 403px; height:365px;">
            <div class="modal-body" style="width: 403px; height:365px">
                <div class="d-flex" style="justify-content: center; flex-direction:column; margin:50px;">
                    <div class="centered-item">
                        <p class="text-icon text-center">i</p>
                    </div>
                    <p class="text-header text-center">Yakin ingin Menghapus?</p>
                    <p class="text-child text-center">Data yang dihapus tidak dapat kembalikan seperti semula</p>
                    <form action="" method="POST" id="formDelete">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex" style="justify-content: center">
                            <button class="btn-batal-delete" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn-submit-delete" type="submit">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>