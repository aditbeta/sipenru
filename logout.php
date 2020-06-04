<?php
	session_start();

	if(isset($_SESSION["user_id"])){
		unset($_SESSION["user_id"]);
		unset($_SESSION["username"]);
		unset($_SESSION["user_email"]);
		unset($_SESSION["user_nama"]);
		unset($_SESSION["user_no_handphone"]);
		unset($_SESSION["user_bagian"]);
		unset($_SESSION["user_role"]);
		session_destroy();
		header( "Location: index.php" );
	}
	else{
		header( "Location: daftar_ruangan.php" );
	}
?>