<!DOCTYPE html>
<html lang="en">

<?php
include 'db_connection.php';
$conn = connectDB();

$sql = "SELECT * FROM Ruangan WHERE id = ".$_GET["id_ruangan"];
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$title = "Detail Ruangan ".$row["kode"];
include 'head.php';
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
          <div class="row">
            <div class="col-md-3"><h3>Kode Ruangan</h3></div>
            <div class="col-md-1"><h3>:</h3></div>
            <div class="col-md-7"><h3><?php echo $row["kode"] ?></h3></div>
          </div>
          <div class="row">
            <div class="col-md-3"><h3>Nama Ruangan</h3></div>
            <div class="col-md-1"><h3>:</h3></div>
            <div class="col-md-7"><h3><?php echo $row["nama"] ?></h3></div>
          </div>
          <div class="row">
            <div class="col-md-3"><h3>Deskripsi</h3></div>
            <div class="col-md-1"><h3>:</h3></div>
            <div class="col-md-7"><h3><?php echo $row["deskripsi"] ?></h3></div>
          </div>
          <div class="row">
            <div class="col-md-3"><h3>Ketersediaan</h3></div>
            <div class="col-md-1"><h3>:</h3></div>
            <div class="col-md-7">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Jam Mulai</th>
                      <th>Jam Selesai</th>
                      <th width="15%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM KetersediaanRuangan WHERE kode_ruangan = ".$row['kode']." ORDER BY jam_mulai asc";
                    $result1 = $conn->query($sql);
                    if ($result1->num_rows > 0) {
                      // output data of each row
                      $pilihanJam = "";
                      while($row1 = $result1->fetch_assoc()) {
                        switch ($row1["status"]) {
                          case 0:
                            $status = "<button class='btn btn-success' disabled>Tersedia</button>";
                            break;
                          case 1:
                            $status = "<button class='btn btn-danger' disabled>Digunakan</button>";
                            break;
                          default:
                            $status = "<button class='btn btn-success' disabled>Tersedia</button>";
                            break;
                        }
                        $pilihanJam .= "<tr><td>".$row1["tanggal"]."</td><td>".$row1["jam_mulai"]."</td><td>".$row1["jam_selesai"]."</td><td>".$status."</td></tr>";
                      }
                      echo $pilihanJam;
                    } else {
                      echo "<tr><td colspan='4' align='center'>- Tidak ada pilihan jam tersedia -</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
                <div class="row admin-item">
                  <div class="col-md-6">
                    <a href='#' class='btn btn-light btn-icon-split' id="tambah-ketersediaan"><span class='icon text-gray-600'><i class='fas fa-plus'></i></span><span class='text'>Tambah Ketersediaan Ruangan</span></a>
                  </div>
                  <div class="col-md-6" align="right">
                    <a href='#' class='btn btn-primary' id="simpan" onclick="simpanKetersediaan()">Simpan</a>
                  </div>
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
    var indexBaris = 1;

    // $(window).on('load', function(){
    //   var user_id = "<?php echo $_SESSION['user_id'] ?>";
    //   if (user_id > 0) {
    //     $("#admin").hide();
    //   }
    //   $("#simpan").hide();
    //   indexBaris = ($("#dataTable").find("tr").length);
    // });

    $("#tambah-ketersediaan").click(function () {
      var tds = "<tr><td><input class='form-control' type='date' id='tanggal' onchange='ketersediaanChange()' required></td>";
      tds += "<td><input placeholder='hh:mm:ss' class='form-control' type='text' id='jam_mulai' onchange='ketersediaanChange()' required></td>";
      tds += "<td><input placeholder='hh:mm:ss' class='form-control' type='text' id='jam_selesai' onchange='ketersediaanChange()' required></td>";
      tds += "<td><button class='btn btn-success' disabled>Tersedia</button></td></tr>";
      $("#dataTable > tbody:last-child").append(tds);
      $("#tambah-ketersediaan").hide();
      $("#simpan").hide();
    });

    function ketersediaanChange() {
      var tanggal = document.getElementById("tanggal").value
      var jam_mulai = document.getElementById("jam_mulai").value
      var jam_selesai = document.getElementById("jam_selesai").value
      if (tanggal == "" || jam_mulai == "" || jam_selesai == "") {
        $("#tambah-ketersediaan").hide();
        $("#simpan").hide();
      } else {
        $("#tambah-ketersediaan").show();
        $("#simpan").show();
      }
    }

    function simpanKetersediaan(){
      var id_ruangan = new URL(window.location.href).searchParams.get("id_ruangan");
      var table = document.getElementById("dataTable");
      var tanggal = [];
      var jam_mulai = [];
      var jam_selesai = [];
      for (var i = indexBaris, row; row = table.rows[i]; i++) {
        tanggal.push($(row.cells[0]).find("#tanggal").val());
        jam_mulai.push($(row.cells[1]).find("#jam_mulai").val());
        jam_selesai.push($(row.cells[2]).find("#jam_selesai").val());
      }
      $.ajax({
         type: "POST",
         url: 'insert.php',
         data:{ action:'ketersediaan', id_ruangan: id_ruangan, tanggal: tanggal, jam_mulai: jam_mulai, jam_selesai: jam_selesai },
         success:function(data) {
           alert("Berhasil menambahkan ketersediaan ruangan");
           location.reload();
         }
      });
    }
  </script>

</body>

</html>
