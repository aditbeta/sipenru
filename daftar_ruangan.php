<!DOCTYPE html>
<html lang="en">

<?php $title = "Daftar Ruangan"; include 'head.php';?>

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
          <div class="card-body">
              <h1 class="h3 mb-4 text-gray-800">Daftar Ruang Rapat</h1>
              <h1 class="h3 mb-4 text-gray-800">PT Angka Wijaya Sentosa</h1>
          </div>

          <!-- Table data ruangan -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Kode Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th width="30%">Deskripsi</th>
                    <th width="25%">Opsi</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Kode Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Deskripsi</th>
                    <th>Opsi</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  include 'db_connection.php';
                  $conn = connectDB();

                  $sql = "SELECT * FROM Ruangan";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        $lihatJam = "<a href='#' class='btn btn-secondary btn-icon-split jamButton' id='".$row["id"]."'><span class='icon text-white-50'><i class='fas fa-clock'></i></span><span class='text'>Lihat Jam</span></a> ";
                        $detailRuangan = "<a href='detail_ruangan.php?id_ruangan=".$row["id"]."' class='btn btn-info btn-icon-split'><span class='icon text-white-50'><i class='fas fa-info-circle'></i></span><span class='text'>Detail</span></a>";
                        echo "<tr><td>".$row["id"]."</td><td>".$row["kode"]."</td><td>".$row["nama"]."</td><td>".$row["deskripsi"]."</td><td>".$lihatJam." ".$detailRuangan."</td></tr>";
                        $sql = "SELECT * FROM KetersediaanRuangan WHERE kode_ruangan='".$row["kode"]."' ORDER BY jam_mulai asc";
                        $result1 = $conn->query($sql);
                        if (!$result1) {
                            trigger_error('Invalid query: ' . $conn->error);
                        }
                        if ($result1->num_rows > 0) {
                          $pilihanJam = "<tr class='trJam jam".$row["id"]."'><td colspan='5'>";
                          while($row1 = $result1->fetch_assoc()) {
                            $tanggal = formatTanggal($row1["tanggal"]);
                            $jam = $tanggal." | ".formatJam($row1["jam_mulai"])." - ".formatJam($row1["jam_selesai"]);
                            if ($row1["status"] == 1) {
                              $pilihanJam .= "<button class='btn btn-google' disabled>".$jam."</button> ";
                            } else {
                              $parameter = "\"".$row["nama"]."\",\"".$row["kode"]."\",\"".$row1["tanggal"]."\",\"".$row1["jam_mulai"]."\",\"".$row1["id"]."\"";
                              $pilihanJam .= "<button class='btn btn-success' onclick='ajukanRuangan(".$parameter.")'>".$jam."</button> ";
                            }
                          }
                          $pilihanJam .= "</td></tr>";
                          echo $pilihanJam;
                        } else {
                          echo "<tr class='trJam jam".$row["id"]."'><td colspan='5' align='center'>- Tidak ada jam tersedia -</td></tr>";
                        }
                      }
                  } else {
                      echo "<tr><td colspan='5' align='center'>- Tidak ada ruangan tersedia -</td></tr>";
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

  <script>
    $(".jamButton").click(function(){
      $(".jam"+this.id).toggle()
    });

    function ajukanRuangan(nama_ruangan, kode_ruangan, tanggal, jam_mulai, id_ketersediaan) {
      var parameter = "nama=" + nama_ruangan + "&kode=" + kode_ruangan + "&tanggal=" + tanggal + "&mulai=" + jam_mulai + "&id_ketersediaan=" + id_ketersediaan
      window.location.href = "ajukan_penggunaan.php?" + parameter;
    }
  </script>

</body>

</html>
