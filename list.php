<?php
include 'database/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM akun WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tabel.css">
</head>
<body>
    <!-- Navbar -->
    <div class="nav">
        <label>
            <input type="checkbox" class="hiddens">
            <div class="toggle">
                <span class="top_line common"></span>
                <span class="middle_line common"></span>
                <span class="bottom_line common"></span>
            </div>
            
            <div class="bartiga">
                <h1 class="title">‎ </h1>
                <ul class="navmenu">
                    <li><a href="profile.php"><img src="img/user_icon.png" class="icon">Akun</a></li>
                    <li><a href="pesanan.php"><img src="img/user_icon.png" class="icon">Pesanan Saya</a></li>
                    <li><a href="riwayat.php"><img src="img/user_icon.png" class="icon">Riwayat Tiket</a></li>
                    <li><a href="faq.php"><img src="img/user_icon.png" class="icon">FAQ</a></li>
                    <li><a href="database/logout.php"><img src="img/user_icon.png" class="icon">Keluar</a></li>
                </ul>
            </div>
        </label>
        
        <div class="cont">
            <nav>
                <a href="index.php"><img src="img/Kliket-logo-blue.png" class="logo"></a>
                <ul>
                    <li><a href="profile.php"><img src="img/user_icon.png" class="logo2"><?php echo $user['username']; ?></a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Pesan Tiket -->

    <div class="cons">
        <img src="img/background_pesan.png" class="bg_pesan">
        <div class="boxs">
            <div class="boxxs">
                <h1 class="pesan-title">Cari Tiket</h1>
                <p class="pesan-sub">Atur jadwal keberangkatan anda!</p>
            </div>
            <!-- Tabel disini -->
            <div class="table-container">
                <table border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Terminal Asal</th>
                            <th>Terminal Tujuan</th>
                            <th>Waktu Berangkat</th>
                            <th>Tanggal Berangkat</th>
                            <th>Sisa Kapasitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'database/showRute.php';?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
