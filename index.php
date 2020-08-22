<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login - SIPENRU</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link href="css/login.css" rel="stylesheet">

</head>

<body id="page-top">

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <!-- <h5 class="card-title text-center">Sign In</h5> -->
            <h5 class="card-title text-center"><br>SISTEM PENGGUNAAN RUANG RAPAT</h5>
            <form class="form-signin" method="post" action="login.php">
              <div class="form-label-group">
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
                <label for="username">Username</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <label for="password">Password</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Ingat password</label>
              </div>
              <button class='btn btn-primary btn-user btn-block text-uppercase' id="simpan" onclick="login()">Masuk</button>
              <!-- <a class="btn btn-primary btn-user btn-block text-uppercase" href="#" data-toggle="modal" data-target="#invalidLoginModal">
                Popup Salah
              </a> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
    function login() {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      $.ajax({
         type: "POST",
         url: 'login.php',
         data:{ username: username, password: password },
         success:function(data) {
           alert(data);
           window.location.href = "daftar_ruangan.php";
         }
      });
    }
  </script>

</body>

</html>
