<?php
$host = "localhost";  // Nama host server database
$user = "user20232030";       // Username MySQL (default: root di XAMPP)
$pass = "z0vmOt";           // Password MySQL (biasanya kosong di XAMPP)
$db   = "user20232030"; // Nama database yang kamu buat di phpMyAdmin

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
