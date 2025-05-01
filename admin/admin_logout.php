<?php
session_start();
session_destroy(); // Menghapus semua sesi
header("Location: admin_login.php"); // Redirect ke halaman login
exit;
?>