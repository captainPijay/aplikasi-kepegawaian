@include('back_office.layouts.modal_konfirmasi')
<div class="sidebar pb-3" id="sidebar" style="overflow-y: auto;">
  <div class="sidebar-header container-fluid">
    <img src="{{ asset('/assets/logo/logo-bengkulu-selatan.png') }}">
    <div class="text-wrapper">
      <div class="title mb-0">Aplikasi Kepegawaian</div>
      <div class="title">Dinkes Bengkulu Utara</div>
    </div>
  </div>
  <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-title active">MAIN MENU</li>
    @can('superAdmin')
    <li class="nav-item {{ Request::is('back-office/dashboard') ? 'selected-list': '' }}">
      <a class="nav-link" href="/back-office/dashboard">
        <span class="{{ Request::is('back-office/dashboard') ? 'active-link': 'death-link' }}"><i class="ri-home-smile-2-line iconSidebarList"></i>Dashboard</span>
      </a>
    </li>
    <li class="nav-group {{ request()->is("back-office/data-master/*") ? 'show selected-list': '' }}" aria-expanded="false">
      <a class="nav-link nav-group-toggle" href="#">
        <i class="ri-apps-line iconSidebarList"></i>Data Master
      </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('back-office/data-master/kpkn') ? 'selected-list': '' }}"
            href="/back-office/data-master/kpkn" target="_top">
            KPKN
          </a>
          <a class="nav-link {{ Request::is('back-office/data-master/data-instansi') ? 'selected-list': '' }}"
            href="/back-office/data-master/data-instansi" target="_top">
            Data Instansi
          </a>
          <a class="nav-link {{ Request::is('back-office/data-master/work-location') ? 'selected-list': '' }}"
          href="/back-office/data-master/work-location" target="_top">
          Lokasi Kerja
        </a>
        </li>
      </ul>
    </li>
    @endcan
    <li class="nav-item {{ request()->is("back-office/pegawai/*") || Request::is('back-office/pegawai') ? 'selected-list': '' }}">
      <a class="nav-link" href="/back-office/pegawai">
        <span class="{{ Request::is('back-office/pegawai') ? 'active-link': 'death-link' }}"><i class="ri-id-card-line iconSidebarList"></i>Pegawai</span>
      </a>
    </li>
    @can('superAdmin')
    <li class="nav-item {{ Request::is('back-office/pendidikan') ? 'selected-list': '' }}">
      <a class="nav-link" href="/back-office/pendidikan">
        <span class="{{ Request::is('back-office/pendidikan') ? 'active-link': 'death-link' }}"><i class="ri-community-line iconSidebarList"></i>Pendidikan</span>
      </a>
    </li>
    <li class="nav-group {{ request()->is("back-office/keluarga/*") ? 'show selected-list': '' }}" aria-expanded="false">
      <a class="nav-link nav-group-toggle" href="#">
        <i class="ri-group-line iconSidebarList"></i>Keluarga
      </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('back-office/keluarga/suami-istri') ? 'selected-list': '' }}"
            href="/back-office/keluarga/suami-istri" target="_top">
            Suami/Istri
          </a>
          <a class="nav-link {{ Request::is('back-office/keluarga/anak') ? 'selected-list': '' }}"
            href="/back-office/keluarga/anak" target="_top">
            Anak
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-group {{ request()->is("back-office/data-kepegawaian/*") ? 'show selected-list': '' }}" aria-expanded="false">
      <a class="nav-link nav-group-toggle" href="#">
        <i class="ri-newspaper-line iconSidebarList"></i>Data Kepegawaian
      </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('back-office/data-kepegawaian/jabatan') ? 'selected-list': '' }}"
            href="/back-office/data-kepegawaian/jabatan" target="_top">
            Jabatan
          </a>
          <a class="nav-link {{ Request::is('back-office/data-kepegawaian/jenjang-jabatan') ? 'selected-list': '' }}"
            href="/back-office/data-kepegawaian/jenjang-jabatan" target="_top">
            Jenjang Jabatan
          </a>
          <a class="nav-link {{ Request::is('back-office/data-kepegawaian/cuti') ? 'selected-list': '' }}"
            href="/back-office/data-kepegawaian/cuti" target="_top">
            Cuti
          </a>
          <a class="nav-link {{ Request::is('back-office/data-kepegawaian/kenaikan-gaji') ? 'selected-list': '' }}"
            href="/back-office/data-kepegawaian/kenaikan-gaji" target="_top">
            Kenaikan Gaji
          </a>
          <a class="nav-link {{ Request::is('back-office/data-kepegawaian/tunjangan') ? 'selected-list': '' }}"
            href="/back-office/data-kepegawaian/tunjangan" target="_top">
            Tunjangan
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item {{ Request::is('back-office/user') ? 'selected-list': '' }}">
        <a class="nav-link" href="/back-office/user">
            <span class="{{ Request::is('back-office/user') ? 'active-link': 'death-link' }}"><i class="ri-settings-4-line iconSidebarList"></i>Pengaturan</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('back-office/cetak-laporan') ? 'selected-list': '' }}">
        <a class="nav-link" href="/back-office/cetak-laporan">
            <span class="{{ Request::is('back-office/cetak-laporan') ? 'active-link': 'death-link' }}"><i class="ri-file-excel-2-fill iconSidebarList"></i>Cetak Laporan</span>
        </a>
    </li>
    @endcan
    <li class="nav-item">
      <div>
        <button onclick="formKonfirmasi()" class="nav-link btn-logout">
          <span class="death-link"><i class="ri-logout-box-line iconSidebarList"></i>Logout</span>
        </button>
      </div>
    </li>
  </ul>
  <div class="wrapperButtonLogout w-100 px-3"></div>
  {{-- <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button> --}}
</div>
<script>
    function formKonfirmasi() {
        $('#formKonfirmasi').attr('action', "{{ route('logout') }}");
        $('#ModalKonfirmasi').modal('show');
    }
</script>
