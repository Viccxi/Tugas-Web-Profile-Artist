<?php
session_start();
require_once('includes/db_connect.php');

// Dapatkan IP dan User Agent
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Deteksi OS
function getOS($user_agent) {
    $os_array = array(
        '/windows nt 10/i'     => 'Windows 10',
        '/windows nt 6.3/i'    => 'Windows 8.1',
        '/windows nt 6.2/i'    => 'Windows 8',
        '/windows nt 6.1/i'    => 'Windows 7',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/linux/i'             => 'Linux',
        '/android/i'           => 'Android',
        '/iphone/i'            => 'iOS',
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            return $value;
        }
    }
    return "Unknown OS";
}

// Deteksi Browser
function getBrowser($user_agent) {
    $browser_array = array(
        '/msie/i'       => 'Internet Explorer',
        '/firefox/i'    => 'Firefox',
        '/chrome/i'     => 'Chrome',
        '/safari/i'     => 'Safari',
        '/opera/i'      => 'Opera',
        '/edg/i'        => 'Edge',
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            return $value;
        }
    }
    return "Unknown Browser";
}

$os = getOS($user_agent);
$browser = getBrowser($user_agent);

// Simpan ke database
$sql = "INSERT INTO pengunjung (ip_address, os, browser, user_agent) 
        VALUES ('$ip_address', '$os', '$browser', '$user_agent')";
mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="intro.css" />
  <title>Viccxi Artist Profile</title>
</head>
<body class="dark-mode">
  <div id="background"></div>

  <header class="container">
    <div class="page-header">
      <div class="logo">
        <a href="#">Viccxi Artist Profile</a>
      </div>
      <input type="checkbox" id="click" />
      <label for="click" class="mainicon">
        <div class="menu"><i class="bx bx-menu"></i></div>
      </label>
      <ul>
        <li><a href="#" class="active" style="--navAni:1">Home</a></li>
        <li><a href="about.html" style="--navAni:2">About</a></li>
        <li><a href="discography.html" style="--navAni:3">Discography</a></li>
        <li><a href="contact.html" style="--navAni:4">Contact</a></li>
      </ul>
    </div>
  </header>

  <section class="container">
    <div class="main">
      <div class="detail">
        <h3>Hi, I'm</h3>
        <h1><span style="color:#f9532d;">Viccxi</span></h1>
        <p>
          An independent artist from Central Java, Indonesia. He explores the world of music through the genres of pop and semi-rock, delivering honest and emotionally driven compositions.
        </p>
        <div class="social">
          <a href="https://open.spotify.com/artist/0OJlvllmVXpV8BZzf2oawU" style="--socialAni:1"><i class="bx bxl-spotify"></i></a>
          <a href="https://www.instagram.com/ovicprstma/?locale=en_US%2Cen_US" style="--socialAni:2"><i class="bx bxl-instagram"></i></a>
          <a href="https://www.youtube.com/@viccxiartist" style="--socialAni:3"><i class="bx bxl-youtube"></i></a>
          <a href="https://music.apple.com/ug/artist/viccxi/1610223077" style="--socialAni:4"><i class="bx bxl-apple"></i></a>
        </div>
      </div>
      <div class="img-sec">
        <div class="images">
          <img src="assets/viccxi.png" alt="Viccxi" class="img-w" />
        </div>
      </div>
    </div>
  </section>

  <video autoplay muted loop id="bg-video">
    <source src="assets/video.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>

  <div class="content">
    <div class="welcome-box">
      <h1>Welcome to My World</h1>
      <p>Discover the music inside.</p>
    </div>
  </div>
  <div class="cursor"></div>
<div class="cursor-trail"></div>
<script src="js/cursor.js" defer></script>
</body>
</html>
