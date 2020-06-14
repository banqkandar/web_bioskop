<?php 
require_once "../config.php";
session_start();
if (isset($_SESSION['username'])) {
  $username   = $_SESSION['username'];
  $id_kasir = $_SESSION['kasir'];
}
if (!isset($_SESSION['kasir'])) {
        echo '
            <script>
                window.alert("Anda Tidak Berhak Mengakses Halaman Ini Karena Anda Belum Login Sebagai Kasir");
                window.location = "../login.php";
            </script>
        ';
}
$qyu = $conn->query("SELECT * FROM kasir WHERE id_kasir='$id_kasir'");
$hasil = $qyu->fetch_assoc();
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
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php"><?=nama;?></a>
        </li>
        <li class="breadcrumb-item active">Ubah Data Saya</li>
      </ol>
      <!-- Icon Cards-->
       <div class="row">
        <div class="col-lg-6">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
            <i class="fa fa-bar-chart"></i> Ubah Data Saya</div>
            <div class="card-body">
              <form action="" method="post">
              <?php if($_POST['user']){
                  $nama      = ucfirst($_POST['nama']);
                  $username = $_POST['user'];
                  $email     = $_POST['email'];
                  $password = $_POST['password'];
                  $jk = $_POST['jk'];
                  $alamat = $_POST['alamat'];
                  $update = "UPDATE kasir SET nama_kasir='$nama', password_kasir='$password', username_kasir='$username', email_kasir='$email', jk_kasir='$jk', alamat_kasir='$alamat' WHERE id_kasir='$id_kasir'";
                  $submit = $conn->query($update);
                  echo '<script>window.alert("Sukses ubah data diri Kasir");window.location = "editsaya.php";</script>';
              }
                ?>

              <div class="form-group">
                <label for="nama" class="col-sm-6 control-label">Nama Lengkap</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="nama" value="<?php echo $hasil['nama_kasir'];?>" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-6 control-label">Username</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="user" value="<?php echo $hasil['username_kasir'];?>" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-6 control-label">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="password" value="<?php echo $hasil['password_kasir'];?>" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-6 control-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" name="email" value="<?php echo $hasil['email_kasir'];?>" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-6 control-label">Jenis Kelamin</label>
                <div class="col-sm-8">
                <?php if($hasil['jk_kasir']=="L"){?>
                  <label><input type="radio" name="jk" value="L" checked> Laki - laki</label>
                  <label><input type="radio" name="jk" value="P"> Perempuan</label>
                <?php }else{?>
                  <label><input type="radio" name="jk" value="L"> Laki - laki</label>
                  <label><input type="radio" name="jk" value="P" checked> Perempuan</label>
                <?php }?>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-6 control-label">Alamat</label>
                <div class="col-sm-8">
                  <textarea class="form-control" name="alamat" required=""><?php echo $hasil['alamat_kasir'];?></textarea>
                </div>
              </div>
              <center><button type="submit" class="btn btn-success">Submit</button></center>
            </form>
            </div>
            <div class="card-footer small text-muted"><?=nama;?> 2018</div>
          </div>
        </div>
      </div>
    <!-- /.container-fluid-->
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
