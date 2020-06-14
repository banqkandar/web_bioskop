<?php
// buka koneksi dengan MySQL
  include("../config.php");
  session_start();
  if (!isset($_SESSION['admin'])) {
        echo '
            <script>
                window.alert("Anda Tidak Berhak Mengakses Halaman Ini Karena Anda Belum Login Sebagai Admin");
                window.location = "../login.php";
            </script>
        ';
  }else{
  //mengecek apakah di url ada GET id
  if (isset($_GET["id"])) {
    // menyimpan variabel id dari url ke dalam variabel $id
    $id = $_GET["id"];

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM kasir WHERE id_kasir='$id' ";
    $hasil_query = $conn->query($query);

    //periksa query, apakah ada kesalahan
    if ($conn->errno) {
      echo 'window.alert("Gagal.");';
    }else{
      echo 'window.alert("Kasir Telah di hapus.");';
    }
  }
  // melakukan redirect ke halaman index.php
  header("location:kasir.php");
  }
?>
