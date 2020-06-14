<?php 
require_once "config.php";
session_start();
$id      = $_GET['id'];
$tanggal = date("m/d/y",time()); ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?=deskripsi;?>">
    <meta name="author" content="<?=admin;?>">

    <title>
            <?php
                $q = $conn->query("SELECT judul, YEAR(tgl_rilis) AS tahun FROM film WHERE id_film='$id'");
                $f = $q->fetch_assoc();
                echo $f['judul'],'&nbsp;','('.$f['tahun'].')';           
            ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
 <?php include "header.phtml"; ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3"><?php echo $f['judul'].' ('.$f['tahun'].')';?>
        <small>Sinopsis</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $f['judul'].' ('.$f['tahun'].')';?></li>
      </ol>
<?php
$a = $conn->query("SELECT * FROM film WHERE id_film = '$id'");
$x = $a->fetch_assoc();
$idadmin = $x['id_admin'];
$s = $conn->query("SELECT * FROM admin WHERE id_admin = '$idadmin'");
$z = $s->fetch_assoc();
?>
      <!-- Project One -->
      <div class="row">
        <div class="col-md-7">
            <img class="img-fluid rounded mb-3 mb-md-0" src="<?php echo "asset/".$x['image'].""; ?>" alt="">
        </div>
        <div class="col-md-5">
          <h3><?php echo $f['judul'].' ('.$f['tahun'].')';?></h3>
          <h6>Posted By : <?php echo $z['nama_admin']; ?></h6>
          <p>                    <?php
                        echo '
                            <p>'.$x['kategori1'].' | '.$x['kategori2'].' | '.$x['kategori3'].' | '.$x['rating'].' | '.$x['durasi'].' menit</p>
                            <label>Tanggal Rilis</label>
                            <p>'.$x['tgl_rilis'].'</p>
                            <label>Sinopsis</label>
                            <p>'.$x['sinopsis'].'</p>
                            <label>Pemain</label>
                            <p>'.$x['artis'].'</p>
                            <label>Negara</label>
                            <p>'.$x['negara'].'</p>
                            <label>Produksi</label>
                            <p>'.$x['produksi'].'</label>
                        ';
                    ?></p>
          <a class="btn btn-primary" href="<?php echo $x['trailer']?>">Trailer
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
      </div>
    </div>
<hr>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>