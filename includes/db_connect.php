<?php
$host = "localhost";      // ganti jika server beda
$user = "root";           // username MySQL kamu
$pass = "";               // password MySQL (kosongkan jika default di localhost)
$db   = "webku";   // ganti dengan nama database kamu
$port = 3306;             // port MySQL

$conn = new mysqli($host, $user, $pass, $db, $port);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>