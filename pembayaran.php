<?php
include 'database/koneksi.php';

if (!isset($_SESSION['username']) && !isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM akun WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$ruteID = $_GET['ruteID'];
$tiketID = $_GET['tiketID'];

$sql = "SELECT r.asal, r.tujuan, r.waktu_berangkat, r.tanggal_berangkat
        FROM rute r
        WHERE r.ruteID = '$ruteID'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $asal = $row['asal'];
    $tujuan = $row['tujuan'];
    $waktu_berangkat = $row['waktu_berangkat'];
    $tanggal_berangkat = $row['tanggal_berangkat'];
} else {
    echo "Data rute tidak ditemukan.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
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
                <h1 class="pesan-title">Pembayaran</h1>
                <p class="pesan-sub"><?php echo $asal . " - " . $tujuan; ?></p>
                <p class="pesan-sub">Jadwal Keberangkatan</p>
                <p class="pesan-sub"><?php echo $tanggal_berangkat . "<br>" . $waktu_berangkat; ?></p>
            </div>
            <div class="buttt">
                <button onclick="checkout(<?php echo $tiketID; ?>)">Checkout</button>
            </div>
        </div>
    </div>
</body>
</html>

<script>
function checkout(tiketID) {
    fetch('database/checkout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'tiketID=' + tiketID
    })
    .then(response => response.text())
    .then(data => {
        alert('Pembayaran berhasil');
        window.location.href = "index.php";
    });
}
</script>