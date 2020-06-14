<?php 
require_once "config.php";
session_start();
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

      <h1 class="my-4">Selamat Datang di <?=nama;?></h1>
      <!-- Portfolio Section -->
      <h2>Film Yang Sedang Tayang</h2>

      <div class="row">
      <?php $qyu = $conn->query("SELECT * FROM tayang INNER JOIN film WHERE CURDATE() BETWEEN tanggal_awal AND tanggal_akhir AND tayang.id_film = film.id_film");
            while($datanya = $qyu->fetch_array()){
      ?>        
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href=<?php echo "order.php?id=".$datanya['id_film']."";?>><img class="card-img-top" src="<?php echo "asset/".$datanya['image'].""; ?>" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href=<?php echo "order.php?id=".$datanya['id_film']."";?>><?php echo "".$datanya['judul'].""; ?></a>
              </h4>
              <p class="card-text"><?php echo '<p class="time">'.$datanya['jam1'].' | '.$datanya['jam2'].' | '.$datanya['jam3'].'</p>';?>  <a href=<?php echo "detail.php?id=".$datanya['id_film']."";?>>Lihat Sinopsis</a></p>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
      <!-- /.row -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; <?=nama;?> 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
