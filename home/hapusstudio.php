<?php
// buka koneksi dengan MySQL
  include("../config.php");
  session_start();
  if (!isset($_SESSION['kasir'])) {
        echo '
            <script>
                window.alert("Anda Tidak Berhak Mengakses Halaman Ini Karena Anda Belum Login Sebagai kasir");
                window.location = "../login.php";
            </script>
        ';
  }else{
  //mengecek apakah di url ada GET id
  if (isset($_GET["id"])) {
    // menyimpan variabel id dari url ke dalam variabel $id
    $id = $_GET["id"];

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM studio WHERE id='$id' ";
    $hasil_query = $conn->query($query);
    $querys = $conn->query("SELECT id_studio from tayang where id_studio='$id'");
    
    //periksa query, apakah ada kesalahan
    if ($querys->num_rows>0) {
      echo '<script>window.alert("Gagal.");</script>';
      echo '<script>window.alert("Hapus Film dari jadwal tayang yang menggunakan studio ini terlebih dahulu.");</script>';
      echo "<script>window.location.href='studio.php';</script>";
    }else{
      echo '<script>window.alert("Studio Telah di hapus.");</script>';
      header("location:studio.php");
    }
  }
  }
?>
