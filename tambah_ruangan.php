<!DOCTYPE html>
<html lang="en">

<?php $title = "Input Ruangan Baru"; include 'head.php';?>

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
          <h1 class="h3 mb-4 text-gray-800">Input Ruangan</h1>

          <!-- Table data ruangan -->
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="nama_ruangan">Nama Ruangan</label>
                <input class="form-control" type="text" name="nama_ruangan" id="nama_ruangan" required>
              </div>
              <div class="form-group">
                <label for="kode_ruangan">Kode Ruangan</label>
                <input class="form-control" type="text" name="kode_ruangan" id="kode_ruangan" required>
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" required></textarea>
              </div>
              <a class="btn btn-primary" onclick="simpanRuangan()">Simpan</a>
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
