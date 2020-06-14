<?php
require_once "../config.php";
session_start();
if (isset($_SESSION['username'])) {
  $username   = $_SESSION['username'];
  $id_admin = $_SESSION['admin'];
}
if (!isset($_SESSION['admin'])) {
  echo '
            <script>
                window.alert("Anda Tidak Berhak Mengakses Halaman Ini Karena Anda Belum Login Sebagai Admin");
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
  <meta name="description" content="<?= deskripsi; ?>">
  <meta name="author" content="<?= admin; ?>">
  <title><?= nama; ?></title>
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
    .dataTables_filter,
    .dataTables_length {
      display: none;
    }
  </style>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php"><?= nama; ?></a>
        </li>
        <li class="breadcrumb-item active">Tambah Kasir</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Total Kasir</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama Kasir</th>
                      <th>Username Kasir</th>
                      <th>Email Kasir</th>
                      <th>Alamat</th>
                      <th>Pilihan</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nama Kasir</th>
                      <th>Username Kasir</th>
                      <th>Email Kasir</th>
                      <th>Alamat</th>
                      <th>Pilihan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $qyu = $conn->query("SELECT * FROM kasir");
                    while ($datanya = $qyu->fetch_array()) { ?>
                      <tr>
                        <td><?php echo $datanya['nama_kasir']; ?></td>
                        <td><?php echo $datanya['username_kasir']; ?></td>
                        <td><?php echo $datanya['email_kasir']; ?></td>
                        <td><?php echo $datanya['alamat_kasir']; ?></td>
                        <td><a href="editkasir.php?id=<?php echo $datanya['id_kasir']; ?>">Ubah</a> /
                          <a href="hapuskasir.php?id=<?php echo $datanya['id_kasir']; ?>" onclick="return confirm('Anda yakin akan menghapus data?')">Hapus</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted"><?= nama; ?> 2018</div>
          </div>
        </div>

        <div class="col-lg-4">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Tambah Kasir</div>
            <div class="card-body">
              <form action="" method="post">
                <?php if ($_POST['user']) {
                  $nama      = ucfirst($_POST['nama']);
                  $username = $_POST['user'];
                  $password  = $_POST['password'];
                  $email     = $_POST['email'];
                  $jk = $_POST['jk'];
                  $alamat = $_POST['alamat'];
                  $cek_email = $conn->query("SELECT * FROM kasir WHERE username_kasir ='" . $username . "'");
                  $has    = $cek_email->fetch_array();
                  if ($has) {
                    echo '<div class="alert alert-danger">Username yang anda masukkan sudah di gunakan kasir lain!</div>';
                  } else {
                    $daftar = "INSERT INTO kasir(id_kasir, nama_kasir,username_kasir,password_kasir,email_kasir,jk_kasir,alamat_kasir,id_admin) VALUES (NULL, '$nama','$username','$password','$email','$jk','$alamat','$id_admin')";
                    $submit = $conn->query($daftar);
                    echo '<script>window.alert("Sukses..");window.location = "kasir.php";</script>';
                  }
                }
                ?>

                <div class="form-group">
                  <label for="nama" class="col-sm-12 control-label">Nama Lengkap</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama" placeholder="Aa" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama" class="col-sm-12 control-label">Username</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="user" placeholder="aasuhendar" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama" class="col-sm-12 control-label">Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" placeholder="*******" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama" class="col-sm-12 control-label">Email</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" placeholder="kasir@gmail.com" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama" class="col-sm-12 control-label">Jenis Kelamin</label>
                  <div class="col-sm-8">
                    <label><input type="radio" name="jk" value="L"> Laki - laki</label>
                    <label><input type="radio" name="jk" value="P"> Perempuan</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama" class="col-sm-12 control-label">Alamat</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="alamat" required=""></textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
              </form>
            </div>
            <div class="card-footer small text-muted"><?= nama; ?> 2018</div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid-->
      <!-- /.content-wrapper-->
      <footer class="sticky-footer">
        <div class="container">
          <div class="text-center">
            <small>Copyright © <?= nama; ?> 2018</small>
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