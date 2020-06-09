<?php
	include 'db_connection.php';
	// include 'invalid_login.php';
	$conn = connectDB();

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM user WHERE username = '" . $username . "' AND password = '" . $password . "'";
	$result = mysqli_query($conn, $sql);
	$rowCheck = mysqli_num_rows($result);

	if ($rowCheck > 0) {
		$row = mysqli_fetch_array($result);
		session_start();
		$_SESSION['user_id'] = $row["id"];
		$_SESSION['username'] = $row["username"];
		$_SESSION['user_email'] = $row["email"];
		$_SESSION['user_nama'] = $row["nama"];
		$_SESSION['user_no_handphone'] = $row["no_handphone"];
		$_SESSION['user_bagian'] = $row["bagian"];
		$_SESSION['user_role'] = $row["role"];
        header( "Location: menu_utama.php" );
    } else {
        // header( "Location: index.php" );
        echo "<script>
		alert('Username atau Password tidak valid');
		window.location.href='index.php';
		</script>";
    }

    $conn->close();
?>