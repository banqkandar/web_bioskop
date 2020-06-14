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
      <h1 class="mt-4 mb-3">Dashboard
        <small><?=nama;?></small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item active">
          Home
        </li>
        <li class="breadcrumb-item"><a href="history.php">History Tiket</a></li>
        <li class="breadcrumb-item"><a href="topup.php">Top Up Saldo</a></li>
        <li class="breadcrumb-item"><a href="ubah.php">Ubah Password</a></li>
        <li class="breadcrumb-item"><a href="edit.php">Edit Profil</a></li>
      </ol>

<h2>Tiket Yang Berlaku</h2><hr>
      <div class="row">
<?php
$cektiket = $conn->query("SELECT * FROM tiket  where (tanggal_tonton >= CURDATE()) AND id_konsumen = '$id_konsumen'");
if($cektiket->num_rows<1){
    echo "Tidak ada Pemesanan Tiket";
}else{
while ($row = $cektiket->fetch_assoc()) {
    echo '
        <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
            <div class="transaction-content">
                <h3>'.$row['judul'].'</h3>
                <hr>
                <div class="row info">
                    <div class="col-md-2 col-xs-6 col-sm-6 col-lg-2">
                        <p><b>Tanggal</b></p>
                        <p>'.$row['tanggal_tonton'].'</p>
                    </div>
                    <div class="col-md-2 col-xs-6 col-sm-6 col-lg-2">
                        <p><b>Studio</b></p>
                        <p>'.$row['nama_studio'].'</p>
                    </div>
                    <div class="col-md-2 col-xs-6 col-sm-6 col-lg-2">
                        <p><b>Kursi</b></p>
                        <p>'.$row['seat'].'</p>
                    </div>
                    <div class="col-md-2 col-xs-6 col-sm-6 col-lg-2">
                        <p><b>Jam</b></p>
                        <p>'.$row['jam_tonton'].'</p>
                    </div>
                    <div class="col-md-2 col-xs-6 col-sm-6 col-lg-2">
                        <p><b>Jumlah Orang</b></p>
                        <p>'.$row['jumlah_orang'].'</p>
                    </div>
                    <div class="col-md-2 col-xs-6 col-sm-6 col-lg-2">
                        <p><b>Harga</b></p>
                        <p>'.$row['total_harga'].'</p>
                    </div>
                    Kode Booking : '.$row['kodebooking'].' 
                </div>
            </div>
            <hr>
        </div>';
}
}
?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
