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

?>