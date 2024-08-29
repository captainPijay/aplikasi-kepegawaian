@extends('back_office.layouts.index')
@section('content')
<div class="container-fluid bg-white wrapperDataTableBackOffice">
    <table class="stripe table-back-office" id="serverSide">
        <thead>
            <tr>
                <th>NAMA PEGAWAI</th>
                <th>NAMA PENDIDIKAN</th>
                <th>TAHUN LULUS</th>
                <th>JENJANG</th>
                <th>NAMA SEKOLAH</th>
                <th>LOKASI</th>
                <th>NO. IJAZAH</th>
                <th>TANGGAL IJAZAH</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
    @include('back_office.layouts.modal_hapus')
    @include('back_office.pendidikan.modal_tambah')
    @include('back_office.pendidikan.modal_edit')
@endsection

@section('custom_js')
<script type="text/javascript">
    $(document).ready(function(){
        loadData();
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
                url: "{{ route('pendidikan.index') }}"
            },
            columns:[
                {
                    data: 'name',
                    name: 'name',
                    searchable: true
                },
                {
                    data: 'pendidikan_name',
                    name: 'pendidikan_name',
                    searchable: true
                },
                {
                    data: 'pass_date',
                    name: 'pass_date',
                    searchable: true
                },
                {
                    data: 'jenjang',
                    name: 'jenjang',
                    searchable: true
                },
                {
                    data: 'school',
                    name: 'school',
                    searchable: true
                },
                {
                    data: 'school_location',
                    name: 'school_location',
                    searchable: true
                },
                {
                    data: 'ijazah_number',
                    name: 'ijazah_number',
                    searchable: true
                },
                {
                    data: 'ijazah_date',
                    name: 'ijazah_date',
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
                    '<div class="icon-info"><i class="ri-building-4-line"></i></div><div class="text-info"><span>Total Data Pendidikan</span><h5>200</h5></div>'
                );

                $('.section-table-info').append(infoSection);

                $('.section-table-info h5').text("{{ $getData->count() }}");

            },
        })
    }

    function deleteData(id) {
        $('#formDelete').attr('action', "{{ route($deleteUrl, '') }}" + '/' + id);
        $('#ModalDelete').modal('show');
    }

    function editData({id,pegawai_id,name,pass_date,jenjang,school,school_location,ijazah_number,ijazah_date}) {
        console.log(school);
        $("#formEdit input[name='id']").val(id);
        $("#formEdit select[name='pegawai_id']").val(pegawai_id);
        $("#formEdit input[name='name']").val(name);
        $("#formEdit input[name='pass_date']").val(pass_date);
        $("#formEdit select[name='jenjang']").val(jenjang);
        $("#formEdit input[name='school']").val(school);
        $("#formEdit input[name='school_location']").val(school_location);
        $("#formEdit input[name='ijazah_number']").val(ijazah_number);
        $("#formEdit input[name='ijazah_date']").val(ijazah_date);
        $('#formEdit').attr('action', "{{ route($updateUrl, '') }}" + '/' + id);
        $('#ModalEdit').modal('show');
    }
</script>
@endsection
