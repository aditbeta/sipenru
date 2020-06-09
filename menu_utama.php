<!DOCTYPE html>
<html lang="en">

<?php $title = "Menu Utama"; include 'head.php';?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include 'topbar.php';?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- Table untuk memperlihatkan data ruangan -->
          <div class="card-body" style="font-size: 40px;">

            <div class="row admin-item" style="margin-top:8%; margin-bottom:9%;">
              <div class="col-md-4 text-center">
                <a class="nav-link" href="atur_ruangan.php">
                  <i class="fas fa-fw fa-cogs"></i>
                  <span>Atur Ruangan</span></a>
              </div>
              <div class="col-md-4 text-center">
                <a class="nav-link" href="pengajuan_ruangan.php">
                  <i class="fas fa-fw fa-edit"></i>
                  <span>Pengajuan Baru</span></a>
              </div>
              <div class="col-md-4 text-center">
                <a class="nav-link" href="pengajuan_terproses.php">
                  <i class="fas fa-fw fa-check-circle"></i>
                  <span>Pengajuan Sudah Diproses</span></a>
              </div>
            </div>
            <hr class="row admin-item">

            <div class="row" style="margin-top:9%; margin-bottom:8%;">
              <div class="col-md-4 text-center">
                <a class="nav-link" href="daftar_ruangan.php">
                  <i class="fas fa-fw fa-clipboard-list"></i>
                  <span>Lihat Ruangan</span></a>
              </div>
              <div class="col-md-4 text-center">
                <a class="nav-link" href="daftar_pengajuan.php">
                  <i class="fas fa-fw fa-list-alt"></i>
                  <span>Daftar Pengajuan</span></a>
              </div>
              <div class="col-md-4 text-center">
                <a class="nav-link" href="ajukan_penggunaan.php">
                  <i class="fas fa-fw fa-plus-circle"></i>
                  <span>Ajukan Penggunaan Ruangan</span></a>
              </div>
            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php include 'footer.php';?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php include 'logout_and_script.php';?>

  <script>
    function simpanRuangan(){
      var kode_ruangan = $("#kode_ruangan").val();
      var nama_ruangan = $("#nama_ruangan").val();
      var deskripsi = $("#deskripsi").val();
      $.ajax({
         type: "POST",
         url: 'insert.php',
         data:{ action:'ruangan', kode_ruangan: kode_ruangan, nama_ruangan: nama_ruangan, deskripsi: deskripsi },
         success:function(data) {
           alert("Berhasil menambahkan ruangan");
           window.location.href = "detail_ruangan.php?id_ruangan=" + data;
         }
      });
    }
  </script>

</body>

</html>
