<!DOCTYPE html>
<html lang="en">

<?php $title = "Daftar Pengajuan terproses"; include 'head.php';?>
<?php
  if ($_SESSION["user_role"] > 0){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include 'navigasi.php';?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include 'topbar.php';?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Daftar Pengajuan Telah Diproses</h1>

          <!-- Table data ruangan -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Ruangan [Kode]</th>
                    <th>Waktu Penggunaan</th>
                    <th>Peminjam</th>
                    <th>Tanggal Pengajuan</th>
                    <th width="20%">Keterangan</th>
                    <th width="10%">Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Nama Ruangan [Kode]</th>
                    <th>Waktu Penggunaan</th>
                    <th>Peminjam</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  include 'db_connection.php';
                  $conn = connectDB();

                  $sql = "SELECT * FROM PenggunaanRuangan WHERE status>0";
                  $resultPenggunaan = $conn->query($sql);

                  if ($resultPenggunaan->num_rows > 0) {
                    while($rowPenggunaan = $resultPenggunaan->fetch_assoc()) {
                      $sql = "SELECT * FROM KetersediaanRuangan WHERE id='".$rowPenggunaan["id_ketersediaan"]."'";
                      $resultKetersediaan = $conn->query($sql);
                      $rowKetersediaan = $resultKetersediaan->fetch_assoc();

                      $sql = "SELECT * FROM Ruangan WHERE kode='".$rowKetersediaan["kode_ruangan"]."'";
                      $resultRuangan = $conn->query($sql);
                      $rowRuangan = $resultRuangan->fetch_assoc();
                      $ruangan = $rowRuangan["nama"]." [".$rowRuangan["kode"]."]";

                      $sql = "SELECT * FROM User WHERE id='".$rowPenggunaan["id_user"]."'";
                      $resultUser = $conn->query($sql);
                      $rowUser = $resultUser->fetch_assoc();

                      $waktu = $rowKetersediaan["tanggal"]." |<br />".$rowKetersediaan["jam_mulai"]."-".$rowKetersediaan["jam_selesai"];
                      if ($rowPenggunaan["status"] == 1) {
                        $status = "<button class='btn btn-success' style='width:100%' disabled>Diterima</button>";
                      } else {
                        $status = "<button class='btn btn-danger' style='width:100%' disabled>Ditolak</button>";
                      }

                      echo "<tr><td>".$rowKetersediaan["id"]."</td><td>".$ruangan."</td><td>".$waktu."</td><td>".$rowUser["nama"]."</td><td>".$rowPenggunaan["tanggal_pengajuan"]."</td><td>".$rowPenggunaan["keterangan"]."</td><td>".$status."</td></tr>";
                    }
                  } else {
                    echo "<tr><td colspan='7' align='center'>- Tidak ada pengajuan terproses -</td></tr>";
                  }

                  closeDB($conn);
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <?php include 'cetak_halaman.php';?>

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

</body>

</html>
