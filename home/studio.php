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
        <li class="breadcrumb-item active">Tambah Studio</li>
      </ol>
      <!-- Icon Cards-->
       <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Total Studio</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama Studio</th>
                  <th>Kapasitas Orang</th>
                  <th>Harga</th>
                  <th>Pilihan</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nama Studio</th>
                  <th>Kapasitas Orang</th>
                  <th>Harga</th>
                  <th>Pilihan</th>
                </tr>
              </tfoot>
              <tbody>
              <?php $qyu = $conn->query("SELECT * FROM studio");
                while($datanya = $qyu->fetch_array()){ ?>
                <tr>
                  <td><?php echo $datanya['nama']; ?></td>
                  <td><?php echo $datanya['kapasitas']; ?></td>
                  <td><?php echo $datanya['harga']; ?></td>
                  <td><a href="editstudio.php?id=<?php echo $datanya['id'];?>">Ubah</a> /
                      <a href="hapusstudio.php?id=<?php echo $datanya['id'];?>" onclick="return confirm('Anda yakin akan menghapus data?')">Hapus</a>
                  </td>
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
              <i class="fa fa-pie-chart"></i> Tambah Studio</div>
            <div class="card-body">
              <form action="" method="post">
              <?php if($_POST['nama']){
                  $nama      = ucfirst($_POST['nama']);
                  $kapasitas = $_POST['kapasitas'];
                  $harga     = $_POST['harga'];
                  $cek_nama = $conn->query("SELECT * FROM studio WHERE nama ='".$nama."'");
                  $has    = $cek_nama->fetch_array();
                  if($has){
                    echo '<div class="alert alert-danger">Nama Studio sudah ada!</div>';
                  }else{
                  $daftar = "INSERT INTO studio VALUES (NULL, '$nama', '$kapasitas', '$harga')";
                  $submit = $conn->query($daftar);
                  if ($conn->errno) {
                    printf("Errormessage: %s\n", $conn->error);
                  }else{
                      echo '<script>window.alert("Sukses..");window.location = "studio.php";</script>';
                    }
                  }
              }
                ?>

              <div class="form-group">
                <label for="nama" class="col-sm-6 control-label">Nama Studio</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="nama" placeholder="Platinum" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-6 control-label">Kapasitas Orang</label>
                <div class="col-sm-12">
                  <input type="number" class="form-control" name="kapasitas" placeholder="40" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-6 control-label">Harga perOrang</label>
                <div class="col-sm-12">
                  <input type="number" class="form-control" name="harga" placeholder="35000" required="">
                </div>
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
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
