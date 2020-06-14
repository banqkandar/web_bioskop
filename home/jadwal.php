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
        <li class="breadcrumb-item active">Tambah Jadwal</li>
      </ol>
      <!-- Icon Cards-->
       <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Total Film</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Judul Film</th>
                  <th>Tanggal Rilis</th>
                  <th>Durasi Film</th>
                  <th>Rating</th>
                  <th>Negara</th>
                  <th>Produksi</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Judul Film</th>
                  <th>Tanggal Rilis</th>
                  <th>Durasi Film</th>
                  <th>Rating</th>
                  <th>Negara</th>
                  <th>Produksi</th>
                </tr>
              </tfoot>
              <tbody>
              <?php $qyu = $conn->query("SELECT * FROM tayang INNER JOIN film WHERE CURDATE() BETWEEN tanggal_awal AND tanggal_akhir AND tayang.id_film = film.id_film");
                while($datanya = $qyu->fetch_array()){ ?>
                <tr>
                  <td><?php echo $datanya['judul']; ?></td>
                  <td><?php echo $datanya['tgl_rilis']; ?></td>
                  <td><?php echo $datanya['durasi']." menit"; ?></td>
                  <td><?php echo $datanya['rating']; ?></td>
                  <td><?php echo $datanya['negara']; ?></td>
                  <td><?php echo $datanya['produksi']; ?></td>
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
              <i class="fa fa-pie-chart"></i> Tambah Jadwal</div>
            <div class="card-body">
              <form action="" method="post">
              <?php if($_POST['film']){
                  $title      = ucfirst($_POST['film']);
                  $date_first = $_POST['awal'];
                  $date_last  = $_POST['akhir'];
                  $studio     = ucfirst($_POST['studio']);
                  $schedule_1 = $_POST['jam1'];
                  $schedule_2 = $_POST['jam2'];
                  $schedule_3 = $_POST['jam3'];
                  date_default_timezone_set("Asia/Jakarta");
                  $time       = date("d m Y", time());
                  if ($date_first < $time ) {
                    echo '<div class="alert alert-danger">Tanggal Main Awal Tidak Boleh Kurang Dari Tanggal Sekarang!</div>';
                  }
                  $daftar = "INSERT INTO tayang (id,tanggal_awal,tanggal_akhir,id_film,id_studio,jam1,jam2,jam3) VALUES (NULL,'$date_first','$date_last',$title,$studio,'$schedule_1','$schedule_2','$schedule_3')";
                  $submit = $conn->query($daftar);
                      echo '<script>window.alert("Sukses..");window.location = "jadwal.php";</script>';
              }
              $films = $conn->query("SELECT * FROM film WHERE CURDATE() BETWEEN tgl_rilis AND DATE_ADD(tgl_rilis, INTERVAL 7 DAY)");
              $studi = $conn->query("SELECT * FROM studio");
              if ($films->num_rows < 1) {
                    echo "<h3 style='text-align:center;margin-top:100px;'>Tidak ada film yang dirilis hari ini</h3>";
                    } else {  
                ?>
             <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Judul Film :</label>
                <div class="col-sm-12">
                    <select class="form-control" name="film" required>
                      <?php while($datanyo = $films->fetch_array()){  ?>
                        <option value="<?php echo $datanyo['id_film'];?>"><?php echo $datanyo['judul'];?></option>
                      <?php } ?>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Tanggal Main Awal :</label>
                <div class="col-sm-12">
                  <input class="form-control" type="date" name="awal" required>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Tanggal Main Akhir :</label>
                <div class="col-sm-12">
                  <input class="form-control" type="date" name="akhir" required>
                </div>
              </div>
             <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Pilih Studio :</label>
                <div class="col-sm-12">
                    <select class="form-control" name="studio" required>
                      <?php while($xz = $studi->fetch_array()){  ?>
                        <option value="<?php echo $xz['id'];?>"><?php echo $xz['nama'];?></option>
                      <?php } ?>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Jam Tayang Pertama :</label>
                <div class="col-sm-12">
                  <input type="time" class="form-control" placeholder="Jam Tayang Pertama" name="jam1" required>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Jam Tayang Kedua :</label>
                <div class="col-sm-12">
                  <input type="time" class="form-control" placeholder="Jam Tayang Kedua." name="jam2" required>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Jam Tayang Ketiga :</label>
                <div class="col-sm-12">
                  <input type="time" class="form-control" placeholder="Jam Tayang Ketiga" name="jam3" required>
                </div>
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
            <?php } ?>
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
