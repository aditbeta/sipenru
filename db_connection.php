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

	function formatTanggal($tanggal) {
		return date('j M Y', strtotime($tanggal));
	}

	function formatJam($jam) {
		return substr($jam, 0, 5);
	}

	function getCountPengajuanBaru() {
		$conn = connectDB();
		$sql = "SELECT * FROM PenggunaanRuangan WHERE status=0";
		
        $result = $conn->query($sql);
		$count = $result->num_rows;
		return $count;
	}
?>