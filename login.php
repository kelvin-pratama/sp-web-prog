<?php
include "session_start.php";
include "koneksi.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $inputUsername = $_POST["username"];
  $inputPassword = $_POST["password"];

  $stmt = $koneksi->prepare("SELECT * FROM admin WHERE username = ?");
  $stmt->bind_param('s',$inputUsername);
  $stmt->execute();
  $stmt->store_result();
  if($stmt->num_rows == 1){
    $stmt->bind_result($id_admin, $nama_lengkap, $username, $password);
    while($stmt->fetch()){
      if(password_verify($inputPassword, $password)){
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["nama_lengkap"] = $nama_lengkap;
        $_SESSION["id_admin"] = $id_admin;

        header("Location: index.php");
        exit;
      } else {
        echo "Invalid cred!";
      }
    }
  } else{
    echo "Invalid cred";
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in | Perpustakaan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Perpustakaan</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="dist/js/jquery/jquery-3.7.1.js"></script>
<!-- Bootstrap 4 -->
<script src="dist/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte/adminlte.min.js"></script>
</body>
</html>
