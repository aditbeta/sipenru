<?php
	function connectDB() {
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "";
		$db = "sipenru";
		$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

		return $conn;
	}

	function closeDB($conn) {
		$conn -> close();
	}

	function getData($conn, $sql) {
		$result = $conn->query($sql);
		return $result->fetch_assoc();
	}

	function hari($tanggal){
		$nama_hari = date("D", $tanggal);

		switch($nama_hari){
			case 'Sun':
				$nama_hari = "Minggu"; break;
			case 'Mon':			
				$nama_hari = "Senin"; break;
			case 'Tue':
				$nama_hari = "Selasa"; break;
			case 'Wed':
				$nama_hari = "Rabu"; break;
			case 'Thu':
				$nama_hari = "Kamis"; break;
			case 'Fri':
				$nama_hari = "Jumat"; break;
			case 'Sat':
				$nama_hari = "Sabtu"; break;
			default:
				$nama_hari = "Senin";		
			break;
		}
	 
		return $nama_hari;
	}

	function formatTanggal($tanggal) {
		$tanggal = date("Y-m-j", strtotime($tanggal));
		$bulan = array (1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		$split = explode('-', $tanggal);
		return hari(strtotime($tanggal)) . ' ' .  $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	}

	function formatJam($jam) {
		$jam = date('H:i', strtotime($jam));
		return substr($jam, 0, 5);
	}
?>
