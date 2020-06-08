<!DOCTYPE html>
<html lang="en">

<?php $title = "Atur Ruangan"; include 'head.php';?>
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
          <h1 class="h3 mb-4 text-gray-800">Daftar Ruangan Kampus Gedong</h1>

          <div class="card-body" align="right">
              <a href='tambah_ruangan.php' class='btn btn-success btn-icon-split print-hide'><span class='icon text-white-50'><i class='fas fa-plus'></i></span><span class='text'>Tambah Ruangan</span></a>
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
                        $lihatJam = "<a href='#' class='btn btn-secondary btn-icon-split jamButton' id='".$row["id"]."'><span class='icon text-white-50'><i class='fas fa-clock'></i></span><span class='text'>Lihat Jam</span></a>";
                        $detailRuangan = "<a href='detail_ruangan.php?id_ruangan=".$row["id"]."' class='btn btn-info btn-icon-split'><span class='icon text-white-50'><i class='fas fa-info-circle'></i></span><span class='text'>Detail</span></a>";
                        echo "<tr><td>".$row["id"]."</td><td>".$row["kode"]."</td><td>".$row["nama"]."</td><td>".$row["deskripsi"]."</td><td>".$lihatJam." ".$detailRuangan."</td></tr>";
                        $sql = "SELECT * FROM KetersediaanRuangan WHERE kode_ruangan=".$row["kode"]." ORDER BY jam_mulai asc";
                        $result1 = $conn->query($sql);
                        if ($result1->num_rows > 0) {
                          $pilihanJam = "<tr class='trJam jam".$row["id"]."'><td colspan='5'>";
                          while($row1 = $result1->fetch_assoc()) {
                            if ($row1["status"] == 1) {
                              $pilihanJam .= "<button class='btn btn-google' disabled>".$row1["jam_mulai"]." - ".$row1["jam_selesai"]."</button> ";
                            } else {
                              $pilihanJam .= "<button class='btn btn-success' disabled>".$row1["jam_mulai"]." - ".$row1["jam_selesai"]."</button> ";
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
    $(window).on('load', function(){
      $(".trJam").hide();
    });

    $(".jamButton").click(function(){
      $(".jam"+this.id).toggle()
    });
  </script>

</body>

</html>
