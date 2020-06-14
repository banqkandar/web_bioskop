<?php
error_reporting(0);
session_start();
$servertim = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$usertim   = 'root'; // username database
$passtim   = ''; // password database
$dbtim   = 'bioskop'; // nama database
$conn = new mysqli($servertim, $usertim, $passtim, $dbtim);
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}
// Nama Website
define("nama","Bioskop Ceria");
// Deskripsi website (kalo ada)
define("deskripsi","Ceria Banget");
// Kata kata di homepage
define("headline","Bioskop Ceria Banget");
// Author
define("admin","Black");
?>