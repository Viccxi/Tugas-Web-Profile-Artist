<?php
session_start();
require_once('C:\xampp\htdocs\webku\includes\db_connect.php');

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Query untuk menghitung total pengunjung berdasarkan periode waktu
$total_today = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengunjung WHERE DATE(waktu) = CURDATE()"))['total'];
$total_week = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengunjung WHERE YEARWEEK(waktu, 1) = YEARWEEK(CURDATE(), 1)"))['total'];
$total_month = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengunjung WHERE MONTH(waktu) = MONTH(CURDATE()) AND YEAR(waktu) = YEAR(CURDATE())"))['total'];
$total_six_months = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengunjung WHERE waktu >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)"))['total'];
$total_all_time = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengunjung"))['total'];

// Query untuk mendapatkan log pengunjung
$sql = "SELECT * FROM pengunjung ORDER BY waktu DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Pengunjung</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Catatan Log Pengunjung</h2>

    <!-- Statistik Pengunjung -->
    <div>
        <h3>Statistik Pengunjung</h3>
        <ul>
            <li>Hari ini: <?= $total_today ?></li>
            <li>1 Minggu Terakhir: <?= $total_week ?></li>
            <li>1 Bulan Terakhir: <?= $total_month ?></li>
            <li>6 Bulan Terakhir: <?= $total_six_months ?></li>
            <li>Sepanjang Waktu: <?= $total_all_time ?></li>
        </ul>
    </div>

    <!-- Tabel Log Pengunjung -->
    <h3>Log Pengunjung</h3>
    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>IP Address</th>
                <th>Sistem Operasi</th>
                <th>Browser</th>
                <th>User Agent</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['waktu']) ?></td>
                <td><?= htmlspecialchars($row['ip_address']) ?></td>
                <td><?= htmlspecialchars($row['os']) ?></td>
                <td><?= htmlspecialchars($row['browser']) ?></td>
                <td><?= htmlspecialchars($row['user_agent']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
