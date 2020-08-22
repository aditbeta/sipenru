<!DOCTYPE html>
<html lang="en">

<?php $title = "Daftar Pengajuan"; include 'head.php';?>

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
          <h1 class="h3 mb-4 text-gray-800">Daftar Pengajuan</h1>
          <!-- Table data ruangan -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th width="30%">Keperluan</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kode Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Keperluan</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  include 'db_connection.php';
                  $conn = connectDB();
                  $id = $_SESSION["user_id"];

                  $sql = "SELECT * FROM PenggunaanRuangan WHERE id_user=".$id." ORDER BY tanggal_pengajuan ASC";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {

                        $sql = "SELECT * FROM KetersediaanRuangan WHERE id=".$row["id_ketersediaan"];
                        $resultKetersediaan = $conn->query($sql);

                        if ($resultKetersediaan->num_rows > 0) {
                          $pengajuan = "<tr><td>";
                          while($rowKetersediaan = $resultKetersediaan->fetch_assoc()) {
                            $sql = "SELECT * FROM Ruangan WHERE kode='".$rowKetersediaan["kode_ruangan"]."'";
                            $resultRuangan = $conn->query($sql);
                            $rowRuangan = $resultRuangan->fetch_assoc();

                            switch ($row["status"]) {
                              case 1:
                                $status = "<a href='bukti_pengajuan.php?id_penggunaan=".$row["id"]."' class='btn btn-success' style='width:100%;'>Disetujui</a>";
                                break;
                              case 2:
                                $status = "<a href='bukti_pengajuan.php?id_penggunaan=".$row["id"]."' class='btn btn-danger' style='width:100%;'>Ditolak</a>";
                                break;
                              default:
                                $status = "<a href='bukti_pengajuan.php?id_penggunaan=".$row["id"]."' class='btn btn-warning' style='width:100%;'>Diajukan</a>";
                                break;
                            }

                            $pengajuan .= $row["id"]."</td><td>"
                            .$rowRuangan["kode"]."</td><td>"
                            .$rowKetersediaan["tanggal"]."</td><td>"
                            .$rowKetersediaan["jam_mulai"]." - ".$rowKetersediaan["jam_selesai"]."</td><td>"
                            .$row["keterangan"]."</td><td>"
                            .$row["tanggal_pengajuan"]."</td><td>"
                            .$status;
                          }
                          $pengajuan .= "</td></tr>";
                          echo $pengajuan;
                        } else {
                          echo "<tr><td colspan='7' align='center'>- Tidak ada pengajuan penggunaan ruangan -</td></tr>";
                        }
                      }
                  } else {
                      echo "<tr><td colspan='7' align='center'>- Tidak ada pengajuan penggunaan ruangan -</td></tr>";
                  }

                  closeDB($conn);
                  ?>
                </tbody>
              </table>
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
