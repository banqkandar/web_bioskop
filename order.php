<?php 
require_once "config.php";
session_start();
    if (!isset($_SESSION['username'])) {
        echo '
            <script>
                window.alert("Anda Harus Login Dahulu");
                window.location = "login.php";
            </script>
        ';
    }
    if (!isset($_GET['id'])) {
        echo '
            <script>
                window.alert("Anda Harus Memilih Film Dahulu");
                window.location = "index.php";
            </script>
        ';
    }
if(isset($_SESSION['admin'])){
    header("location:home");
}elseif(isset($_SESSION['kasir'])){
    header("location:home");
}
$id = $_GET['id'];
$username       = $_SESSION['username'];
$id_konsumen    = $_SESSION['id_konsumen'];
$judul = $conn->query("SELECT judul FROM tayang JOIN film WHERE CURDATE() BETWEEN tanggal_awal AND tanggal_akhir AND film.id_film = '$id'");
$judul = $judul->fetch_assoc();
$studio = $conn->query("SELECT studio.id as studio_id,nama, harga FROM tayang JOIN film JOIN studio WHERE CURDATE() BETWEEN tanggal_awal AND tanggal_akhir AND film.id_film = '$id' AND tayang.id_studio = studio.id ");
$studio = $studio->fetch_assoc();
$jam = $conn->query("SELECT jam1,jam2,jam3 FROM tayang JOIN film WHERE tayang.id_film = film.id_film");
$jam = $jam->fetch_assoc();
    ?>
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
<style type="text/css">
.evenRow{
            background-color: red;
        }
.cuanki{
            background-color: green;
        }
</style>
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
?>
      <!-- Project One -->
      <div class="row">
        <div class="col-md-7">
            <img class="img-fluid rounded mb-3 mb-md-0" src="<?php echo "asset/".$x['image'].""; ?>" alt="">
        </div>
      <form method="post" action="">
                <?php
        if($_POST){
          $saldo = $conn->query("SELECT saldo_konsumen FROM konsumen WHERE username_konsumen = '$username' OR email_konsumen = '$username'");
            while($saldox = $saldo->fetch_assoc()) {
                $saldosaya = $saldox['saldo_konsumen'];
            }
          $chk            = "";
          $select= $_POST['seat'];
          $hitung = count($select);
          $total_harga    = $hitung * $studio['harga'];
          foreach($select as $chk1) {
            $chk.=$chk1." ";
          }
          if ($saldosaya < $total_harga) {
            echo '<div class="alert alert-danger">Maaf Saldo Anda Kurang!<p>Saldo anda : '.$saldoo['saldo_konsumen'].'</div>';
          }elseif(!$select){
            echo '<div class="alert alert-danger">Kursi Belum di isi!</div>';
          }else{
            $inifilm = $judul['judul'];
            $idstudio = $studio['studio_id'];
            $namastudio = $studio['nama'];
            $jamsaya = $_POST['jam'];
            $hargastudio = $studio['harga'];
            $kodebooking = "BCERIA".substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 5);
            $a = $conn->query("INSERT INTO tiket (id,tanggal,tanggal_tonton,id_konsumen,film_id,judul,id_studio,nama_studio,seat,jam_tonton,jumlah_orang,harga,total_harga,kodebooking,status) VALUES (NULL,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'$id_konsumen','$id','$inifilm','$idstudio','$namastudio','$chk','$jamsaya','$hitung','$hargastudio','$total_harga','$kodebooking','Ready To Watch')");
            if ($a) {
              $update = $conn->query("UPDATE konsumen SET saldo_konsumen = saldo_konsumen - $total_harga WHERE username_konsumen = '$username' OR email_konsumen = '$username'");
              if ($update) {
                  echo '<div class="alert alert-success">Pemesanan Tiket Sukses!</div>';
                  echo '<script> window.location = "akunsaya.php";</script>';
              }else{
                  echo '<div class="alert alert-danger">Pengurangan Saldo Gagal. Silahkan Lakukan Pemesanan Ulang!</div>';
                  echo '<script> window.location = "order.php?id='.$id.'";</script>';
              }
          }else{
            echo '<div class="alert alert-danger">Pemesanan Tiket Gagal!</div>';

          }
        }
      }
        ?>
          <div class="form-group">
              <label for="nama" class="col-sm-12 control-label">Judul Film :</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="film" readonly value="<?php echo $judul['judul'];?>">
              </div>
          </div>
          <div class="form-group">
              <label for="nama" class="col-sm-12 control-label">Studio :</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="studio" readonly value="<?php echo $studio['nama'];?>">
              </div>
          </div>
          <div class="form-group">
              <label for="nama" class="col-sm-12 control-label">Harga/Tiket :</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="harga" readonly value="<?php echo $studio['harga'];?>">
              </div>
          </div>
          <div class="form-group">
              <label for="nama" class="col-sm-12 control-label">Kursi Terisi :</label>
              <div class="col-sm-12">
                <label for="nama" class="col-sm-12 control-label">
                  <?php 
                  $seat = $conn->query("SELECT * FROM tiket where film_id='$id'");
                  $kursi = $seat->fetch_assoc();
                  if($seat->num_rows<1){
                    echo "Kursi Masih Kosong";
                  }else{
                    $sass = $conn->query("SELECT * FROM tiket where film_id='$id' AND status='Ready To Watch'");
                    while($data = $sass->fetch_array()){
                    echo $data['seat'];
                    $arr2 = str_split($data['seat'], 3);
                    foreach($arr2 as $arr1){
                    $myArray[$arr1] = $arr1;
                    }
                  }
                  }
                  ?>
                    
                </label>
              </div>
          </div>
          <div class="form-group">
              <label for="nama" class="col-sm-12 control-label">Harga/Tiket :</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="harga" readonly value="<?php echo $studio['harga'];?>">
              </div>
          </div>
          <div class="form-group">
              <label for="nama" class="col-sm-12 control-label">Jam Tayang :</label>
              <div class="col-sm-12">
                <select name="jam" class="form-control" required>
                  <option value="<?php echo $jam['jam1'];?>"><?php echo $jam['jam1'];?></option>
                  <option value="<?php echo $jam['jam2'];?>"><?php echo $jam['jam2'];?></option>
                  <option value="<?php echo $jam['jam3'];?>"><?php echo $jam['jam3'];?></option>
                </select>
              </div>
          </div>
          <div class="form-group">
              <label for="nama" class="col-sm-12 control-label">Pilih Kursi :</label>
              <div class="col-sm-12">
                <label><?php if($myArray['A1 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="A1" disabled="">A1</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="A1">A1</div><?php } ?></label>
                <label><?php if($myArray['B1 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="B1" disabled="">B1</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="B1">B1</div><?php } ?></label>
                <label><?php if($myArray['C1 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="C1" disabled="">C1</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="C1">C1</div><?php } ?></label>
                <label><?php if($myArray['D1 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="D1" disabled="">D1</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="D1">D1</div><?php } ?></label>
                <label><?php if($myArray['E1 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="E1" disabled="">E1</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="E1">E1</div><?php } ?></label>
                <label><?php if($myArray['F1 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="F1" disabled="">F1</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="F1">F1</div><?php } ?></label>
              </div>
              <div class="col-sm-12">
                <label><?php if($myArray['A2 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="A2" disabled="">A2</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="A2">A2</div><?php } ?></label>
                <label><?php if($myArray['B2 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="B2" disabled="">B2</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="B2">B2</div><?php } ?></label>
                <label><?php if($myArray['C2 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="C2" disabled="">C2</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="C2">C2</div><?php } ?></label>
                <label><?php if($myArray['D2 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="D2" disabled="">D2</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="D2">D2</div><?php } ?></label>
                <label><?php if($myArray['E2 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="E2" disabled="">E2</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="E2">E2</div><?php } ?></label>
                <label><?php if($myArray['F2 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="F2" disabled="">F2</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="F2">F2</div><?php } ?></label>
              </div>
              <div class="col-sm-12">
                <label><?php if($myArray['A3 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="A3" disabled="">A3</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="A3">A3</div><?php } ?></label>
                <label><?php if($myArray['B3 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="B3" disabled="">B3</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="B3">B3</div><?php } ?></label>
                <label><?php if($myArray['C3 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="C3" disabled="">C3</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="C3">C3</div><?php } ?></label>
                <label><?php if($myArray['D3 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="D3" disabled="">D3</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="D3">D3</div><?php } ?></label>
                <label><?php if($myArray['E3 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="E3" disabled="">E3</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="E3">E3</div><?php } ?></label>
                <label><?php if($myArray['F3 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="F3" disabled="">F3</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="F3">F3</div><?php } ?></label>
              </div>
              <div class="col-sm-12">
                <label><?php if($myArray['A4 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="A4" disabled="">A4</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="A4">A4</div><?php } ?></label>
                <label><?php if($myArray['B4 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="B4" disabled="">B4</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="B4">B4</div><?php } ?></label>
                <label><?php if($myArray['C4 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="C4" disabled="">C4</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="C4">C4</div><?php } ?></label>
                <label><?php if($myArray['D4 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="D4" disabled="">D4</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="D4">D4</div><?php } ?></label>
                <label><?php if($myArray['E4 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="E4" disabled="">E4</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="E4">E4</div><?php } ?></label>
                <label><?php if($myArray['F4 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="F4" disabled="">F4</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="F4">F4</div><?php } ?></label>
              </div>
              <div class="col-sm-12">
                <label><?php if($myArray['A5 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="A5" disabled="">A5</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="A5">A5</div><?php } ?></label>
                <label><?php if($myArray['B5 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="B5" disabled="">B5</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="B5">B5</div><?php } ?></label>
                <label><?php if($myArray['C5 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="C5" disabled="">C5</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="C5">C5</div><?php } ?></label>
                <label><?php if($myArray['D5 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="D5" disabled="">D5</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="D5">D5</div><?php } ?></label>
                <label><?php if($myArray['E5 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="E5" disabled="">E5</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="E5">E5</div><?php } ?></label>
                <label><?php if($myArray['F5 ']){?><div class="evenRow"><input type="checkbox" name="seat[]" value="F5" disabled="">F5</div><?php }else{?><div class="cuanki"><input type="checkbox" name="seat[]" value="F5">F5</div><?php } ?></label>
              </div>
          </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Pesan</button>
          </div>
        </div>
        </form>
    </div>
<hr>

  
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>