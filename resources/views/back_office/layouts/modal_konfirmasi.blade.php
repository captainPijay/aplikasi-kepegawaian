<!-- Modal -->
<div class="modal fade modalKonfirmasi" id="ModalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="ModalCreateLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width: 403px; height:365px;">
            <div class="modal-body" style="width: 403px; height:365px">
                <div class="d-flex" style="justify-content: center; flex-direction:column; margin:50px;">
                    <div class="centered-item">
                        <p class="text-icon text-center">i</p>
                    </div>
                    <p class="text-header text-center">Yakin ingin logout?</p>
                    <p class="text-child text-center">{{ auth()->user()->name }} Harus Kembali Login</p>
                    <form action="" method="POST" id="formKonfirmasi">
                        @csrf
                        <div class="d-flex" style="justify-content: center">
                            <button class="btn-batal-delete" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn-submit-delete" type="submit">Ya, Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .text-icon{
        font-size: 24px;
        color: #EB5757;
        text-align: center;
        width: 55px;
        height: 55px;
        border: #EB5757 solid 1px;
        border-radius: 50%;
        line-height: 55px;
    }
    .centered-item{
        display: flex;
        justify-content: center;
    }
    .text-header{
        color: #263238;
        font-size:24px;
        font-family: "Roboto", sans-serif;
    }
    .text-child{
        color: #263238;
        font-size:14px;
        font-family: "Roboto", sans-serif;
        opacity: 46%;
    }
    .btn-batal-delete{
        width: 115px;
        height: 44px;
        border-radius: 6px;
        margin-left: 5px;
        background-color: #0092AC;
        color: #fff;
        border: none;
        transition: background-color 0.3s;
    }
    .btn-batal-delete{
        background-color: #02b4d3;
    }
    .btn-submit-delete{
        width: 115px;
        height: 44px;
        border-radius: 6px;
        margin-left: 5px;
        background-color: #ffff;
        color: #EB5757;
        border: red solid 1px;
    }
    .btn-submit-delete:hover{
        background-color: #EB5757;
        color: #ffff;
        transition: background-color 0.5s ease;
    }
    .btn-batal-delete:hover{
        background-color: #017286;
        color: #ffff;
        transition: background-color 0.5s ease;
    }
</style>
