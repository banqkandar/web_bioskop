<?php 
require_once "config.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}elseif(isset($_SESSION['admin'])){
    header("location:home");
}elseif(isset($_SESSION['kasir'])){
    header("location:home");
}
$username = $_SESSION['username'];
$id_konsumen = $_SESSION['id_konsumen'];
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?=deskripsi;?>">
    <meta name="author" content="<?=admin;?>">

    <title><?=nama;?></title>

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
      <h1 class="mt-4 mb-3">Ubah Password
        <small><?=nama;?></small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item active">
          <a href="akunsaya.php">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="history.php">History Tiket</a></li>
        <li class="breadcrumb-item"><a href="topup.php">Top Up Saldo</a></li>
        <li class="breadcrumb-item">Ubah Password</li>
        <li class="breadcrumb-item"><a href="edit.php">Edit Profil</a></li>
      </ol>
      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Ubah Password</div>
        <div class="card-body">
          <form action="" method="post">
          <?php if($_POST){
          $plama = $_POST['plama'];
          $pbaru = $_POST['pbaru'];
          $encryptplama = password_hash($plama,PASSWORD_DEFAULT);
          $encryptpbaru = password_hash($pbaru,PASSWORD_DEFAULT);
          $cek_password = $conn->query("SELECT * FROM konsumen WHERE id_konsumen ='$id_konsumen'");
          $cekp = $cek_password->fetch_assoc();
          $user_password = $cekp['password_konsumen'];
          if(password_verify($plama,$user_password)){
            $submit = $conn->query("UPDATE konsumen SET password_konsumen='$encryptpbaru' WHERE id_konsumen='$id_konsumen'");
             echo '<div class="alert alert-success">Sukses, Password baru anda adalah '.$pbaru.'</div>';
          }else{
            echo '<div class="alert alert-danger">Password Lama anda salah!</div>';
          }
          }
          ?>
          <div class="form-group">
            <label for="nama" class="col-sm-12 control-label">Password Lama :</label>
            <div class="col-sm-12">
              <input type="password" class="form-control" placeholder="*******" name="plama" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nama" class="col-sm-12 control-label">Password Baru :</label>
            <div class="col-sm-12">
              <input type="password" class="form-control" placeholder="*******" name="pbaru" required>
              <br>
              <button type="submit" class="btn btn-success col-sm-12">Ubah</button>
            </div>
          </div>
          </form>          
        </div>
            <div class="card-footer small text-muted"><?=nama;?> 2018</div>
          </div>
        </div>


    </div>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
