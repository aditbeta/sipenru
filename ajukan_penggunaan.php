<!DOCTYPE html>
<html lang="en">

<?php $title = "Ajukan Penggunaan Ruangan"; include 'head.php';?>

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
          <h1 class="h3 mb-4 text-gray-800">Ajukan Penggunaan Ruangan</h1>

          <!-- Table data ruangan -->
          <?php
            include 'db_connection.php';
            $conn = connectDB();
          ?>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="nama_ruangan">Nama Ruangan</label>
                <select class="form-control" id="nama_ruangan" onchange="ruanganChange(this.value)">
                  <?php
                    $sql = "SELECT * FROM Ruangan";
                    $result = $conn->query($sql);
                    $pilihanRuangan = "";

                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        $pilihanRuangan .= "<option value=".$row["kode"].">".$row["nama"]."</option>";
                      }
                    } else {
                      $pilihanRuangan = "<option disabled>- Tidak ada pilihan ruangan tersedia -</option>";
                    }
                    echo $pilihanRuangan;
                  ?>
                </select>
              </div>
              <div class="form-group" id="divTanggal">
              </div>
              <div class="form-group" id="divJam">
              </div>
              <div class="form-group" id="divKeterangan">
              </div>
              <a href='#' class='btn btn-primary' id="simpan" onclick="simpanPengajuan()">Simpan</a>
            </form>
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
    $(window).on('load', function(){
      var url = new URL(window.location.href);
      var nama_ruangan = url.searchParams.get("nama");
      var kode_ruangan = url.searchParams.get("kode");
      var tanggal = url.searchParams.get("tanggal");
      var jam_mulai = url.searchParams.get("mulai");
      if (jam_mulai != null) {
        ruanganChange(kode_ruangan);
        tanggalChange(tanggal);
        $("#nama_ruangan").val(nama_ruangan);
        $("#nama_ruangan").prop('disabled', true);
        $("#tanggal").val(tanggal);
        $("#tanggal").prop('disabled', true);
        // $("#jam").val(jam_mulai);
        $("#jam").prop('disabled', true);
        $("#simpan").show();
      }
    });

    function ruanganChange(kode_ruangan) {
      document.getElementById("divTanggal").innerHTML =
        "<label for='tanggal'>Tanggal</label>" +
        "<input class='form-control' type='date' name='tanggal' id='tanggal' onchange='tanggalChange(this.value)'>"
    }

    function tanggalChange(tanggal) {
      var e = document.getElementById("nama_ruangan");
      var kode_ruangan = e.options[e.selectedIndex].value;
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("divJam").innerHTML = this.responseText;
          document.getElementById("simpan").disabled = false;
        }
      };
      xmlhttp.open("GET","get_jam.php?kode_ruangan=" + kode_ruangan + "&tanggal=" + tanggal, true);
      xmlhttp.send();

      document.getElementById("divKeterangan").innerHTML =
        "<label for='keterangan'>Keterangan</label>" +
        "<input class='form-control' type='text' name='keterangan' id='keterangan' required autofocus>"
      $("#simpan").show();
    }

    function simpanPengajuan(){
      var id_ketersediaan = document.getElementById("jam").value;
      var id_user = "<?php echo $_SESSION['user_id'] ?>";
      var keterangan = document.getElementById("keterangan").value;
      $.ajax({
         type: "POST",
         url: 'insert.php',
         data:{ action:'penggunaan', id_ketersediaan: id_ketersediaan, id_user: id_user, keterangan: keterangan },
         success:function(data) {
           alert("Berhasil mengajukan penggunaan ruangan. Nomor pengajuan: " + data);
           window.location.href = "daftar_pengajuan.php";
         }
      });
    }
  </script>

</body>

</html>
