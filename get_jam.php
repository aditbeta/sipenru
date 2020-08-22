<!DOCTYPE html>
<html>
    <head></head>
    <body>

    <?php
        $kode_ruangan = $_GET['kode_ruangan'];
        $tanggal = $_GET['tanggal'];
        $id_ketersediaan = $_GET['id_ketersediaan'];

        include 'db_connection.php';
        $conn = connectDB();
        
        $pilihanJam = "";

        echo "<label for='jam'>Jam</label>";
        if ($id_ketersediaan != null && $id_ketersediaan > 0) {
            echo "<select class='form-control' id='jam' disabled>";

            $ketersediaan = getData($conn, "SELECT * FROM KetersediaanRuangan WHERE id='".$id_ketersediaan."'");
            $pilihanJam .= "<option value=".$ketersediaan["id"].">".substr($ketersediaan["jam_mulai"], 0, 5)." - ".substr($ketersediaan["jam_selesai"], 0, 5)."</option>";
        } else {
            echo "<select class='form-control' id='jam'>";

            $sql = "SELECT * FROM KetersediaanRuangan WHERE kode_ruangan='".$kode_ruangan."' AND tanggal='".$tanggal."'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $pilihanJam .= "<option value=".$row["id"].">".formatJam($row["jam_mulai"])." - ".formatJam($row["jam_selesai"])."</option>";
              }
            } else {
              $pilihanJam = "<option disabled>- Tidak ada pilihan jam tersedia -</option>";
            }
        }
        echo $pilihanJam;
        echo "</select>";
    ?>

    </body>
</html>