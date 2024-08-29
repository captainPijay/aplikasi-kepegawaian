@extends('back_office.layouts.index')
@section('content')
<div class="container-fluid bg-white wrapperDataTableBackOffice">
    <table class="stripe table-back-office" id="serverSide">
        <thead>
            <tr>
                <th>FOTO</th>
                <th>NAME</th>
                <th>NIP</th>
                <th>JENIS KELAMIN</th>
                <th>TEMPAT, TANGGAL LAHIR</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
    @include('back_office.layouts.modal_hapus')
    <style>
        @import url('https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css');

        .section-table-search {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .section-table-button {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
    </style>

@endsection

@section('custom_js')
<script type="text/javascript">
    $(document).ready(function(){

        $('.btnDelete').click(function() {
            var id = $(this).data('id');
            $('#ModalDelete').attr('data-id', id);
            $('#formDelete').attr('action', "{{ route($deleteUrl, '') }}" + '/' + id);
            $('#ModalDelete').modal('show');
        });

        loadData();

        // $('#serverSide tbody').on('click', 'tr', function () {
        //     var dataId = $(this).find('.photo-cell').data('id');
        //     var urlDetail = "{{ route('pegawai.detail', '') }}" + '/' + dataId;

        //     window.location.href = urlDetail;
        // });
    })

    function loadData(){
    $(document).ready(function() {
        let searchingEnabled = @json(auth('web')->check());
        let table = $('.table-back-office').DataTable({
        processing: true,
        pagination: searchingEnabled,
        responsive: true,
        serverSide: true,
        searching: searchingEnabled,
        ordering: false,
        ajax: {
            url: "{{ route('pegawai.index') }}",
        },
        columns: [
            { data: 'image', name: 'image', className: 'exclude' },
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'gender', name: 'gender' },
            { data: 'ttl', name: 'ttl',className: 'exclude' },
            {
                data: 'action',
                name: 'action',
                visible: true,
                className: 'exclude'
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
        dom: '<"row"<"col-sm-5 section-table-tl"<"div section-table-length"l><"div section-table-info"Z>><"col-sm-7 section-table-tr"<"div section-table-search"f><"div section-table-button"B>>><"row"<"col-sm-12"tr>><"row"<"col-sm-8 d-flex align-items-center"i><"col-sm-4 d-flex justify-content-end"p>>',
        initComplete: function () {
            var addButton = $(
                '@can('superAdmin') <button class="btn btn-primary btn-add" type="button" onclick="redirectCreate()"><i class="ri-add-line"></i>&nbsp;Tambah Data</button> @endcan'
            );

            $('.section-table-button').append(addButton).css("text-align", "end");

            var infoSection = $(
                '@can('superAdmin')<div class="icon-info"><i class="ri-building-4-line"></i></div><div class="text-info"><span>Total Data Pegawai</span><h5>200</h5></div>@endcan'
            );

            $('.section-table-info').append(infoSection);

            $('.section-table-info h5').text("{{ $getData->count() }}");

        },
    });
});
    }

    function redirectCreate() {
        window.location.href = '{{ route("pegawai.create") }}';
    }

    function redirectDetail(id) {
        window.location.href = '{{ route("pegawai.detail", "") }}' + '/' + id;
    }
    function redirectEdit(id) {
        window.location.href = '{{ route("pegawai.edit", "") }}' + '/' + id;
    }

    function deleteData(id) {
        $('#formDelete').attr('action', "{{ route($deleteUrl, '') }}" + '/' + id);
        $('#ModalDelete').modal('show');
    }

    function editData({id,image,nip,name,gender,place_of_birth,date_of_birth}) {
        $("#formEdit input[name='id']").val(id);
        $("#formEdit input[name='name']").val(name);
        $("#formEdit select[name='gender']").val(gender);
        $("#formEdit input[name='nip']").val(nip);
        $("#formEdit input[name='place_of_birth']").val(place_of_birth);
        $("#formEdit input[name='date_of_birth']").val(date_of_birth);
        // $("#formEdit input[name='image']").val(name);
        $('#formEdit').attr('action', "{{ route($updateUrl, '') }}" + '/' + id);
        $('#ModalEdit').modal('show');
    }
</script>
@endsection
