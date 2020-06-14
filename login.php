<?php
require_once "config.php";
session_start();
if (isset($_SESSION['username'])) {
  header("location:index.php");
} elseif (isset($_SESSION['admin'])) {
  header("location:home");
} elseif (isset($_SESSION['kasir'])) {
  header("location:home");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?= deskripsi; ?>">
  <meta name="author" content="<?= admin; ?>">

  <title>Masuk</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>

  <?php include "header.phtml"; ?>


  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Masuk
      <small><?= nama; ?></small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Masuk</li>
    </ol>
    <form method="post" action="" class="form-horizontal">
      <?php
      if ($_POST) {
        $username   = $_POST['username'];
        $userpass   = $_POST['pswd'];
        $cek_login = $conn->query("SELECT username_konsumen,email_konsumen,password_konsumen,id_konsumen FROM konsumen WHERE username_konsumen = '$username' OR email_konsumen = '$username'");
        $f = $cek_login->fetch_assoc();
        $user_password = $f['password_konsumen'];
        if ($cek_login->num_rows == 1) {
          if (password_verify($userpass, $user_password)) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $userpass;
            $_SESSION['id_konsumen'] = $f['id_konsumen'];
            $_SESSION['spy'] = "YA";
            header("location:index.php");
          } else {
            echo '<div class="alert alert-danger">Username atau Password anda salah!</div>';
          }
        } else {
          $cek_admin = $conn->query("SELECT email_admin,password_admin,id_admin FROM admin WHERE email_admin = '$username' AND password_admin = '$userpass'");
          $z = $cek_admin->fetch_assoc();
          $password = $z['password_admin'];
          if ($cek_admin->num_rows == 1) {
            if ($userpass == $password) {
              session_start();
              $_SESSION['username'] = $username;
              $_SESSION['password'] = $userpass;
              $_SESSION['admin']   = $z['id_admin'];
              header("location:home");
            } else {
              echo '<div class="alert alert-danger">Username atau Password anda salah!</div>';
            }
          } else {
            $cek_kasir = $conn->query("SELECT username_kasir,email_kasir,password_kasir,id_kasir FROM kasir WHERE username_kasir = '$username' AND password_kasir = '$userpass'");
            $s = $cek_kasir->fetch_assoc();
            $pass = $s['password_kasir'];
            if ($cek_kasir->num_rows == 1) {
              if ($userpass == $pass) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $userpass;
                $_SESSION['kasir']   = $s['id_kasir'];
                header("location:home");
              } else {
                echo '<div class="alert alert-danger">Username atau Password anda salah!</div>';
              }
            } else {
              echo '<div class="alert alert-danger">Username atau Password anda salah!</div>';
            }
          }
        }
      }
      ?>
      <div class="form-group">
        <label for="emailAdress" class="col-sm-2 control-label">Email atau Username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="username" placeholder="Email atau Username" required="">
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="pswd" placeholder="Password" required="">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </div>
    </form>
    <p>Belum punya akun ? <a href="daftar.php">klik disini</a> untuk daftar</p>
  </div>
  <!-- /.container -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>