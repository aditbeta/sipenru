    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sistem Penggunaan Ruang Rapat</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Menu Utama</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Daftar Ruangan
      </div>

      <!-- Melihat Daftar Ruangan -->
      <li class="nav-item" id="user">
        <a class="nav-link" href="daftar_ruangan.php">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Lihat Ruangan</span></a>
      </li>

      <!-- Menambah, Menghapus, atau Mengubah Ruangan -->
      <li class="nav-item admin-item">
        <a class="nav-link" href="atur_ruangan.php">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Atur Ruangan</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pengajuan
      </div>

      <!-- Nav Item - Pengajuan Ruangan Belum Diproses -->
      <li class="nav-item admin-item">
        <a class="nav-link" href="pengajuan_ruangan.php">
          <i class="fas fa-fw fa-edit"></i>
          <span>Pengajuan Baru</span></a>
      </li>

      <!-- Nav Item - Pengajuan Ruangan Sudah Diproses -->
      <li class="nav-item admin-item">
        <a class="nav-link" href="pengajuan_terproses.php">
          <i class="fas fa-fw fa-check-circle"></i>
          <span>Pengajuan Sudah Diproses</span></a>
      </li>

      <!-- Nav Item - Daftar Pengajuan -->
      <li class="nav-item">
        <a class="nav-link" href="daftar_pengajuan.php">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Daftar Pengajuan</span></a>
      </li>

      <!-- Nav Item - Mengajukan Penggunaan Ruangan -->
      <li class="nav-item">
        <a class="nav-link" href="ajukan_penggunaan.php">
          <i class="fas fa-fw fa-plus-circle"></i>
          <span>Ajukan Penggunaan Ruangan</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->