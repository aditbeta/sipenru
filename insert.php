<?php
    function getRuangan($conn, $id) {
        $sql = "SELECT * FROM Ruangan WHERE id='".$id."'";
        $resultRuangan = $conn->query($sql);
        $rowRuangan = $resultRuangan->fetch_assoc();
        return $rowRuangan;
    }

    function tambahUser($conn) {
        echo "Hello world!";
    }

    function tambahRuangan($conn) {
        $kode = $_POST['kode_ruangan'];
        $nama = $_POST['nama_ruangan'];
        $deskripsi = $_POST['deskripsi'];
        $sql = "INSERT INTO Ruangan (kode, nama, deskripsi) VALUES ('".$kode."', '".$nama."', '".$deskripsi."');";

        if ($conn->multi_query($sql) === TRUE) {
            // Mengembalikan id terakhir yg diinput
            echo mysqli_insert_id($conn);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    function tambahKetersediaan($conn) {
        $ruangan = getRuangan($conn, $_POST['id_ruangan']);
        $tanggal = $_POST['tanggal'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];
        $sql = "INSERT INTO KetersediaanRuangan (kode_ruangan, tanggal, jam_mulai, jam_selesai, status) VALUES ";

        for ($i = 0; $i < count($tanggal); $i++) {
            $sql .= "('".$ruangan["kode"]."', '".$tanggal[$i]."', '".$jam_mulai[$i]."', '".$jam_selesai[$i]."', 0)";
            $sql .= ($i == count($tanggal)-1) ? ";" : ",";
        }

        if ($conn->multi_query($sql) === TRUE) {
            echo mysqli_insert_id($conn);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    function tambahPenggunaan($conn) {
        $id_ketersediaan = $_POST['id_ketersediaan'];
        $id_user = $_POST['id_user'];
        $tanggal_pengajuan = gmdate('Y-m-d h:i:s');
        $keterangan = $_POST['keterangan'];
        $sql = "INSERT INTO PenggunaanRuangan (id_ketersediaan, id_user, tanggal_pengajuan, keterangan, status) VALUES ('".$id_ketersediaan."', '".$id_user."', '".$tanggal_pengajuan."', '".$keterangan."', 0);";

        if ($conn->multi_query($sql) === TRUE) {
            echo mysqli_insert_id($conn);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    function prosesPengajuan($conn) {
        $id_penggunaan = $_POST['id_penggunaan'];
        $id_ketersediaan = $_POST['id_ketersediaan'];
        $proses = $_POST['proses'];

        if ($proses == 1) {
            $sql = "UPDATE PenggunaanRuangan SET status=1 WHERE id='".$id_penggunaan."';";
            if ($conn->multi_query($sql) === TRUE) {
                $sql = "UPDATE KetersediaanRuangan SET status=1 WHERE id='".$id_ketersediaan."';";
                if ($conn->multi_query($sql) === TRUE) {
                    echo $id_penggunaan;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $sql = "UPDATE PenggunaanRuangan SET status=2 WHERE id='".$id_penggunaan."';";
            if ($conn->multi_query($sql) === TRUE) {
                echo $id_penggunaan;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    include 'db_connection.php';
    $conn = connectDB();

    switch ($_POST['action']) {
        case 'user':
            tambahUser($conn);
            break;
        
        case 'ruangan':
            tambahRuangan($conn);
            break;
        
        case 'ketersediaan':
            tambahKetersediaan($conn);
            break;
        
        case 'penggunaan':
            tambahPenggunaan($conn);
            break;
        
        case 'proses':
            prosesPengajuan($conn);
            break;
        
        // case 'register':
        //     register($conn);
        //     break;
        
        default:
            # code...
            break;
    }
?>