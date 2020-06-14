<?php 
require_once "config.php";
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
//hapus seat
$cektiket = $conn->query("SELECT * FROM tiket where tanggal_tonton < CURDATE()");
while($datatiket = $cektiket->fetch_assoc()){
  $update = "UPDATE tiket SET status='Out Of Date' WHERE id='$datatiket[id]'";
  $submit = $conn->query($update);
}
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


    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('asset/index.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3><?=nama;?></h3>
              <p><?=deskripsi;?></p>
            </div>
          </div>
          <?php $q = $conn->query("SELECT * FROM film limit 2");
            while($data = $q->fetch_array()){
            ?>
          <div class="carousel-item" style="<?php echo "background-image: url('asset/".$data['image']."')"; ?>">
            <div class="carousel-caption d-none d-md-block">
              <h3><?php echo $data['judul'];?></h3>
              <p><?php echo $data['sinopsis'];?></p>
            </div>
          </div>
        <?php } ?>
        </div>        
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4">Selamat Datang di <?=nama;?></h1>
      <!-- Portfolio Section -->
      <h2>Film Yang Sedang Tayang</h2>

      <div class="row">
      <?php $qyu = $conn->query("SELECT * FROM tayang INNER JOIN film WHERE CURDATE() BETWEEN tanggal_awal AND tanggal_akhir AND tayang.id_film = film.id_film limit 3");
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

      <!-- Features Section -->
      <div class="row">
        <div class="col-lg-6">
          <h2><?=nama;?></h2>
          <p>Nonton Bareng Keluarga Seru Hanya di <?=nama;?></p>
          <p>Keunggulan Bioskop Kami :</p>
          <ul>
            <li>
              <strong>Nyaman</strong>
            </li>
            <li>Murah</li>
            <li>Terdapat Banyak Cabang</li>
          </ul>
          <p><?=nama;?> merupakan salah satu jaringan bioskop di Indonesia yang menawarkan konsep baru untuk memberikan pengalaman yang berbeda saat menonton film.</p>
        </div>
        <div class="col-lg-6">
          <img class="img-fluid rounded" src="asset/bckrnd.jpg" alt="">
        </div>
      </div>
      <!-- /.row -->

      <hr>


    </div>
    <!-- /.container -->

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
