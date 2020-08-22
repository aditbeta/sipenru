<!DOCTYPE html>
<html lang="en">

<?php $title = "Bukti Pengajuan"; include 'head.php';?>

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
          <?php include 'header_laporan.php';?>

          <!-- Page Heading -->
          <div class="card-body" align="center">
              <h1 class="h3 mb-4 text-gray-800">Bukti Penggunaan Ruangan</h1>
          </div>

          <!-- Table data ruangan -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                      <?php
                      include 'db_connection.php';
                      $conn = connectDB();

                      $id_penggunaan = $_GET["id_penggunaan"];
                      $sql = "SELECT * FROM PenggunaanRuangan WHERE id='".$id_penggunaan."'";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          $row = $result->fetch_assoc();
                          $tanggal_pengajuan = date('j M Y', strtotime($row["tanggal_pengajuan"]));
                          $jam_pengajuan = date('H:i', strtotime($row["tanggal_pengajuan"]));

                          switch ($row["status"]) {
                            case 1:
                              $status = "<button class='btn btn-success' disabled>Disetujui</button>";
                              break;
                            case 2:
                              $status = "<button class='btn btn-danger' disabled>Ditolak</button>";
                              break;
                            default:
                              $status = "<button class='btn btn-warning' disabled>Diajukan</button>";
                              break;
                          }

                          echo "<tr><td colspan='2' align='center'><button type='button' class='btn btn-secondary' style='width:100%;' disabled>Detail Pengajuan</button></td></tr>";
                          echo "<tr><td>No Pengajuan</td><td>".$row["id"]."</td></tr>";
                          echo "<tr><td>Tanggal Pengajuan</td><td>".$tanggal_pengajuan." ".$jam_pengajuan."</td></tr>";
                          echo "<tr><td>Keterangan</td><td>".$row["keterangan"]."</td></tr>";
                          echo "<tr><td>Status</td><td>".$status."</td></tr>";

                          $ketersediaan = getData($conn, "SELECT * FROM KetersediaanRuangan WHERE id='".$row["id_ketersediaan"]."'");
                          $tanggal = date('j M Y', strtotime($ketersediaan["tanggal"]));
                          $jam = substr($ketersediaan["jam_mulai"], 0, 5)." - ".substr($ketersediaan["jam_selesai"], 0, 5);

                          $ruangan = getData($conn, "SELECT * FROM Ruangan WHERE kode='".$ketersediaan["kode_ruangan"]."'");

                          echo "<tr><td colspan='2' align='center'><button type='button' class='btn btn-secondary' style='width:100%;' disabled>Detail Ruangan</button></td></tr>";
                          echo "<tr><td>Ruangan</td><td>".$ruangan["nama"]." [".$ketersediaan["kode_ruangan"]."]"."</td></tr>";
                          echo "<tr><td>Tanggal</td><td>".$tanggal."</td></tr>";
                          echo "<tr><td>Jam</td><td>".$jam."</td></tr>";
                      } else {
                          echo "<tr><td colspan='5' align='center'>- Tidak ada bukti pengajuan -</td></tr>";
                      }

                      closeDB($conn);
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>
          </div>

          <?php include 'cetak_halaman.php';?>
          <?php include 'footer_laporan.php';?>

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
