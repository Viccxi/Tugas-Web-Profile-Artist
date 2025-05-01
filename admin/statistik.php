<?php
require_once('C:\xampp\htdocs\webku\includes\db_connect.php');
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Dapatkan IP Address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Konversi ::1 ke 127.0.0.1
if ($ip_address === '::1') {
    $ip_address = '127.0.0.1';
}

// Query untuk menghitung total pengunjung berdasarkan periode waktu
$total_today = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengunjung WHERE DATE(created_at) = CURDATE()"))['total'];
$total_week = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengunjung WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)"))['total'];
$total_month = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengunjung WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())"))['total'];
$total_six_months = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengunjung WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)"))['total'];
$total_all_time = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengunjung"))['total'];

$sql = "SELECT * FROM pengunjung ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Pengunjung</title>
    <link rel="stylesheet" href="adminstyle/statistik.css"> <!-- Menghubungkan dengan statistik.css -->
</head>
<body>
    <div class="container">
        <h1>Statistik Pengunjung</h1>
        <ul>
            <li>Hari ini: <?= $total_today ?></li>
            <li>1 Minggu Terakhir: <?= $total_week ?></li>
            <li>1 Bulan Terakhir: <?= $total_month ?></li>
            <li>6 Bulan Terakhir: <?= $total_six_months ?></li>
            <li>Sepanjang Waktu: <?= $total_all_time ?></li>
        </ul>

        <h2>Log Pengunjung</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>IP Address</th>
                    <th>OS</th>
                    <th>Browser</th>
                    <th>User Agent</th>
                    <th>Waktu Kunjungan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['ip_address']) ?></td>
                    <td><?= htmlspecialchars($row['os']) ?></td>
                    <td><?= htmlspecialchars($row['browser']) ?></td>
                    <td><?= htmlspecialchars($row['user_agent']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
