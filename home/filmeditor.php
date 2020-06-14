<?php 
require_once "../config.php";
session_start();
if (isset($_SESSION['username'])) {
  $username   = $_SESSION['username'];
  $id_admin = $_SESSION['kasir'];
}
if (!isset($_SESSION['kasir'])) {
        echo '
            <script>
                window.alert("Anda Tidak Berhak Mengakses Halaman Ini Karena Anda Belum Login Sebagai Admin");
                window.location = "login.php";
            </script>
        ';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?=deskripsi;?>">
  <meta name="author" content="<?=admin;?>">
  <title><?=nama;?></title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php include 'header.phtml'; ?>
<style type="text/css">
.dataTables_filter,.dataTables_length {
  display: none; 
}
</style>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php"><?=nama;?></a>
        </li>
        <li class="breadcrumb-item active">Film Editor</li>
      </ol>
      <!-- Icon Cards-->
       <div class="row">
        <div class="col-lg-12">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Edit Tayangan</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Judul Film</th>
                  <th>Sinopsis</th>
                  <th>Perintah</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Judul Film</th>
                  <th>Sinopsis</th>
                  <th>Perintah</th>
                </tr>
              </tfoot>
              <tbody>
              <?php $qyu = $conn->query("SELECT * FROM tayang INNER JOIN film WHERE CURDATE() BETWEEN tanggal_awal AND tanggal_akhir AND tayang.id_film = film.id_film");
                while($datanya = $qyu->fetch_array()){ ?>
                <tr>
                  <td><?php echo $datanya['judul']; ?></td>
                  <td><?php echo $datanya['sinopsis']; ?></td>
                  <td><a href="#deltay<?php echo $datanya['id']; ?>" data-toggle="modal" class="btn btn-danger">Hapus</a></td>
                </tr>
                <?php include "editay.php"; }?>
              </tbody>
            </table>
          </div>
          <?php 
          if($_GET['deltay']){
            $deltay = $_GET['deltay'];
            $tiket = $conn->query("DELETE FROM tayang WHERE id='$deltay'");
                    echo '
            <script>
                window.alert("Sukses hapus tayangan");
                window.location = "filmeditor.php";
            </script>
        ';
          }
          ?>
        </div>
            <div class="card-footer small text-muted"><?=nama;?> 2018</div>
          </div>
        </div>
      </div>
       <div class="row">
        <div class="col-lg-12">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Edit Film</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Judul Film</th>
                  <th>Sinopsis</th>
                  <th>Perintah</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Judul Film</th>
                  <th>Sinopsis</th>
                  <th>Perintah</th>
                </tr>
              </tfoot>
              <tbody>
              <?php $as = $conn->query("SELECT * FROM film");
                while($x = $as->fetch_array()){ ?>
                <tr>
                  <td><?php echo $x['judul']; ?></td>
                  <td><?php echo $x['sinopsis']; ?></td>
                  <td><a href="#edfilm<?php echo $x['id_film']; ?>" data-toggle="modal" class="btn btn-success"> Edit</a>
                </tr>              
              <?php include "updelfilm.php"; }?>
              </tbody>
            </table>
          </div>
                    <?php 
          if($_GET['gud']){

                  $idsaya    = $_GET['gud'];
                  $title      = ucwords($_POST['judul']);
                  $release    = $_POST['rilis'];
                  $cast       = ucwords($_POST['artis']);
                  $story      = ucfirst($_POST['sinopsis']);
                  $trailer    = $_POST['link'];
                  $duration   = $_POST['durasi'];
                  $restricted = strtoupper($_POST['batas']);
                  $company    = ucwords($_POST['perusahaan']);
                      $update = "UPDATE film SET judul='$title', artis='$cast', sinopsis='$story', trailer='$trailer', rating='$restricted', durasi='$duration', produksi='$company' WHERE id_film='$idsaya'";
                      $submit = $conn->query($update);
                      echo '            <script>
                window.alert("Sukses edit film");
                window.location = "filmeditor.php";
            </script>';
                 echo $title;
          }
          ?>
        </div>
            <div class="card-footer small text-muted"><?=nama;?> 2018</div>
          </div>
        </div>
      </div>
    <!-- Logout Modal-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © <?=nama;?> 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <!-- Bootstrap core JavaScript-->

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
