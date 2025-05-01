<?php
session_start();
require_once('C:\xampp\htdocs\webku\includes\db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan inputan user
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php"); // <-- INI YANG BENAR
        exit;
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="adminstyle/admin_login.css"> <!-- Menghubungkan dengan admin_login.css -->
</head>
<body>
    <div class="container">
        <h1>Login Admin</h1>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="admin/adminstyle/admin_login.css">Forgot Password?</a>
    </div>
</body>
</html>
