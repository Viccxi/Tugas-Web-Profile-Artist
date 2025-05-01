<?php
session_start();

// Cek apakah sudah login sebagai admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminstyle/admin_dashboard.css"> <!-- Menghubungkan dengan admin_dashboard.css -->
</head>
<body>
    <div class="container">
        <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['admin']); ?>!</h2>
        <p>Ini adalah halaman dashboard admin.</p>

        <ul class="menu">
            <!-- Path relatif ke file statistik.php -->
            <li><a href="statistik.php">Lihat Statistik Pengunjung</a></li>
            <!-- Path relatif ke file logout -->
            <li><a href="admin_login.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
