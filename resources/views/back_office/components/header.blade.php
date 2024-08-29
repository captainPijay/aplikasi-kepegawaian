<header class="header header-sticky mb-4">
  <div class="header-row container-fluid d-flex">
    <div class="title">{{ $title ?? 'Aplikasi Pegawai Bengkulu Utara' }}</div>
    <div class="user-info">
      <div class="user-icon">
        <i class="ri-user-fill"></i>
      </div>
      <div class="user-name">
        {{ auth()->user()->username }}
      </div>
    </div>
  </div>
</header>
