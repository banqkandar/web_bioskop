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
      <h1 class="mt-4 mb-3">Top Up Saldo
        <small><?=nama;?></small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item active">
          <a href="akunsaya.php">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="history.php">History Tiket</a></li>
        <li class="breadcrumb-item">Top Up Saldo</li>
        <li class="breadcrumb-item"><a href="ubah.php">Ubah Password</a></li>
        <li class="breadcrumb-item"><a href="edit.php">Edit Profil</a></li>
      </ol>
      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> History Top Up Saldo</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Nama konsumen</th>
                  <th>Nominal Saldo</th>
                  <th>Kode Top Up</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Tanggal</th>
                  <th>Nama konsumen</th>
                  <th>Nominal Saldo</th>
                  <th>Kode Top Up</th>
                  <th>Status</th>
                </tr>
              </tfoot>
              <tbody>
              <?php $qyu = $conn->query("SELECT * FROM topup INNER JOIN konsumen ON topup.id_konsumen = konsumen.id_konsumen WHERE topup.id_konsumen = '$id_konsumen'");
                while($datanya = $qyu->fetch_array()){ ?>
                <tr>
                  <td><?php echo $datanya['tanggal']; ?></td>
                  <td><?php echo $datanya['fname_konsumen']." ".$datanya['lname_konsumen']; ?></td>
                  <td><?php echo $datanya['uang']; ?></td>
                  <td><?php echo $datanya['kode_topup']; ?></td>
                  <td><?php echo $datanya['status']; ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
            <div class="card-footer small text-muted"><?=nama;?> 2018</div>
          </div>
        </div>

        <div class="col-lg-4">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Top Up Saldo</div>
            <div class="card-body">
      <form method="post" action="" class="form-horizontal">
        <?php
        if($_POST){
          $saldo = $_POST['saldo'];
          $kodeacak = "VOC".substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);
          echo '<div class="alert alert-success">Sukses...Tunggu Persetujuan Admin</div>';
          $daftar = "INSERT INTO topup (tanggal,id_konsumen,uang,kode_topup,status) VALUES (CURRENT_TIMESTAMP,'$id_konsumen','$saldo','$kodeacak','Waiting')";
          $submit = $conn->query($daftar);
        }
        ?>
        <div class="form-group">
          <label for="nama" class="col-sm-12 control-label">Jumlah Saldo</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" name="saldo" placeholder="12222">
          </div>
        </div>
        <center><button type="submit" class="btn btn-success">Submit</button></center>
      </form>
            </div>
            <div class="card-footer small text-muted">Saldo Saya <font color=green><?php echo $saldoo['saldo_konsumen'];?></font></div>
          </div>
        </div>


    </div>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
