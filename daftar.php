<?php
require_once "config.php";
session_start();
if (isset($_SESSION['username'])) {
  header("location:index.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?= deskripsi; ?>">
  <meta name="author" content="<?= admin; ?>">

  <title>Daftar</title>

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
    <h1 class="mt-4 mb-3">Daftar
      <small><?= nama; ?></small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Daftar</li>
    </ol>
    <form method="post" action="" class="form-horizontal">
      <?php
      if ($_POST) {
        $fname = ucwords($_POST['fname']);
        $lname = ucwords($_POST['lname']);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $encrypt = password_hash($password, PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $phone = $_POST['notelp'];
        $sex   = $_POST['sex'];
        $cek_email = $conn->query("SELECT * FROM konsumen WHERE email_konsumen ='" . $email . "'");
        $has    = $cek_email->fetch_array();
        $cek_username = $conn->query("SELECT * FROM konsumen WHERE username_konsumen ='" . $username . "'");
        $hasi    = $cek_username->fetch_array();
        if ($has) {
          echo '<div class="alert alert-danger">Email yang anda masukkan sudah di gunakan user lain!</div>';
        } elseif ($hasi) {
          echo '<div class="alert alert-danger">Username yang anda masukkan sudah di gunakan user lain!</div>';
        } else {
          echo '<div class="alert alert-success">Sukses...Silahkan ke halaman login</div>';
          $daftar = "INSERT INTO konsumen (id_konsumen,fname_konsumen,lname_konsumen,jk_konsumen,username_konsumen,password_konsumen,email_konsumen,phone_konsumen) VALUES (NULL,'$fname','$lname','$sex','$username','$encrypt','$email','$phone')";
          $submit = $conn->query($daftar);
        }
      }
      ?>
      <div class="form-group">
        <label for="nama" class="col-sm-2 control-label">Nama Depan</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="fname" placeholder="Aa" required="">
        </div>
      </div>
      <div class="form-group">
        <label for="nama" class="col-sm-2 control-label">Nama Belakang</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="lname" placeholder="Suhendar" required="">
        </div>
      </div>
      <div class="form-group">
        <label for="nama" class="col-sm-2 control-label">Username</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="username" placeholder="Username" required="">
        </div>
      </div>
      <div class="form-group">
        <label for="nama" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" name="password" placeholder="*********" required="">
        </div>
      </div>
      <div class="form-group">
        <label for="nama" class="col-sm-2 control-label">Jenis Kelamin</label>
        <div class="col-sm-4">
          <label><input type="radio" name="sex" value="L"> Laki - laki</label>
          <label><input type="radio" name="sex" value="P"> Perempuan</label>
        </div>
      </div>
      <div class="form-group">
        <label for="nama" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-4">
          <input type="email" class="form-control" name="email" placeholder="batem@gmail.com" required="">
        </div>
      </div>
      <div class="form-group">
        <label for="nama" class="col-sm-2 control-label">No Telepon</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="notelp" placeholder="081111111" required="">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Daftar</button>
        </div>
      </div>
    </form>
  </div>
  <!-- /.container -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>