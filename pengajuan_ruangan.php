<!DOCTYPE html>
<html lang="en">

<?php $title = "Daftar Pengajuan Belum Diproses"; include 'head.php';?>
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
          <h1 class="h3 mb-4 text-gray-800">Daftar Pengajuan Belum Diproses</h1>

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
                    <th width="25%">Proses</th>
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
                    <th>Proses</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  include 'db_connection.php';
                  $conn = connectDB();

                  $sql = "SELECT * FROM PenggunaanRuangan WHERE status=0";
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
                      $status = $rowKetersediaan["status"] == 2 ? "OK" : "X";

                      $idData = $rowPenggunaan["id"] . "," . $rowPenggunaan["id_ketersediaan"];

                      $terimaPengajuan = "<a href='#' class='btn btn-success btn-icon-split' onclick='prosesPengajuan(\"".$idData."\", 1)'><span class='icon text-white-50'><i class='fas fa-check'></i></span><span class='text'>Terima</span></a>";
                      $tolakPengajuan = "<a href='#' class='btn btn-danger btn-icon-split' onclick='prosesPengajuan(\"".$idData."\", 2)'><span class='icon text-white-50'><i class='fas fa-times'></i></span><span class='text'>Tolak</span></a>";

                      echo "<tr><td>".$rowKetersediaan["id"]."</td><td>".$ruangan."</td><td>".$waktu."</td><td>".$rowUser["nama"]."</td><td>".$rowPenggunaan["tanggal_pengajuan"]."</td><td>".$rowPenggunaan["keterangan"]."</td><td>".$tolakPengajuan." ".$terimaPengajuan."</td></tr>";
                    }
                  } else {
                    echo "<tr><td colspan='7' align='center'>- Tidak ada pengajuan baru -</td></tr>";
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

  <script>
    function prosesPengajuan(data, proses){
      // alert(data);
      var id_penggunaan = data.split(",")[0];
      var id_ketersediaan = data.split(",")[1];
      $.ajax({
         type: "POST",
         url: 'insert.php',
         data:{ action:'proses', id_penggunaan: id_penggunaan, id_ketersediaan: id_ketersediaan, proses: proses },
         success:function(data) {
           if (proses == 1) {
            alert("Berhasil menerima pengajuan dengan nomor: " + data);
           } else {
            alert("Berhasil menolak pengajuan dengan nomor: " + data);
           }
           location.reload()
         }
      });
    }
  </script>

</body>

</html>
