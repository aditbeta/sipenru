<!DOCTYPE html>
<html>
    <head></head>
    <body>

    <?php
    $kode_ruangan = $_GET['kode_ruangan'];
    $tanggal = $_GET['tanggal'];

    include 'db_connection.php';
    $conn = connectDB();

    $sql = "SELECT * FROM KetersediaanRuangan WHERE kode_ruangan='".$kode_ruangan."' AND tanggal='".$tanggal."'";
    $result = $conn->query($sql);

    echo "<label for='jam'>Jam</label>";
    echo "<select class='form-control' id='jam'>";

    $pilihanJam = "";
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $pilihanJam .= "<option value=".$row["id"].">".$row["jam_mulai"]." - ".$row["jam_selesai"]."</option>";
      }
    } else {
      $pilihanJam = "<option disabled>- Tidak ada pilihan jam tersedia -</option>";
    }
    echo $pilihanJam;
    echo "</select>";
    ?>

    </body>
</html>