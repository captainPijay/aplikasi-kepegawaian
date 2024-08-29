@extends('back_office.layouts.index')
@section('content')
<div class="container-fluid bg-white wrapperDataTableBackOffice">
    <table class="stripe table-back-office" id="serverSide">
        <thead>
            <tr>
                <th>NAMA PEGAWAI</th>
                <th>TANGGAL GAJI</th>
                <th>LAMPIRAN</th>
                <th>GAJI POKOK</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
    @include('back_office.layouts.modal_hapus')
    @include('back_office.kenaikan_gaji.modal_tambah')
    @include('back_office.kenaikan_gaji.modal_edit')
@endsection

@section('custom_js')
<script type="text/javascript">
    $(document).ready(function(){
        loadData()
    })

    function loadData(){
        $('.table-back-office').DataTable({
            processing: true,
            pagination: true,
            responsive: true,
            serverSide: true,
            searching: true,
            ordering: false,
            ajax:{
                url: "{{ route('kenaikanGaji.index') }}"
            },
            columns:[
                {
                    data: 'name',
                    name: 'name',
                    searchable: true
                },
                {
                    data: 'calculated_date',
                    name: 'calculated_date',
                    searchable: true
                },
                {
                    data: 'akta_lahir',
                    name: 'akta_lahir',
                    searchable: true
                },
                {
                    data: 'gaji_pokok',
                    name: 'gaji_pokok',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: true,
                },
            ],
            language: {
                search: '',
                searchPlaceholder: "Search...",
                lengthMenu: "_MENU_ entries per page",
                paginate: {
                    first: '<div class="icon"><i class="ri-arrow-left-double-line"></i></div>',
                    previous: '<div class="icon"><i class="ri-arrow-left-s-line"></i></div>',
                    next: '<div class="icon"><i class="ri-arrow-right-s-line"></i></div>',
                    last: '<div class="icon"><i class="ri-arrow-right-double-line"></i></div>',
                }
            },
            pagingType: 'full_numbers',
            dom: '<"row"<"col-sm-6 section-table-tl"<"div section-table-length"l><"div section-table-info"Z>><"col-sm-6 section-table-tr"<"div section-table-search"f><"div section-table-button"B>>><"row"<"col-sm-12"tr>><"row"<"col-sm-8 d-flex align-items-center"i><"col-sm-4 d-flex justify-content-end"p>>',
            initComplete: function () {
                var addButton = $(
                    '<button class="btn btn-primary btn-add" data-bs-target="#ModalTambah" data-bs-toggle="modal"><i class="ri-add-line"></i>&nbsp;Tambah Data</button>'
                );

                $('.section-table-button').append(addButton).css("text-align", "end");

                var infoSection = $(
                    '<div class="icon-info"><i class="ri-building-4-line"></i></div><div class="text-info"><span>Total Data Kenaikan Gaji</span><h5>0</h5></div>'
                );

                $('.section-table-info').append(infoSection);
            },
        })
    }

    function deleteData(id) {
        $('#formDelete').attr('action', "{{ route($deleteUrl, '') }}" + '/' + id);
        $('#ModalDelete').modal('show');
    }

    function editData({id,pegawai_id,calculated_date,akta_lahir,gaji_pokok}) {
        $("#formEdit input[name='id']").val(id);
        $("#formEdit select[name='pegawai_id']").val(pegawai_id);
        $("#formEdit input[name='calculated_date']").val(calculated_date);
        $("#formEdit input[name='gaji']").val(formatNumber(gaji_pokok));
        $("#formEdit select[name='akta_lahir']").val(akta_lahir);
        $('#formEdit').attr('action', "{{ route($updateUrl, '') }}" + '/' + id);
        $('#ModalEdit').modal('show');
    }
</script>
@endsection
