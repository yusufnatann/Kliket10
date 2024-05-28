<?php
include 'database/koneksi.php';
include 'database/auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/faq.css">
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
                    <?php if (($_SESSION['kategoriID']) === 1): ?>
                    <li><a href="admin/admutama.html"><img src="img/user_icon.png" class="icon">Dashboard Admin</a></li>
                    <?php endif; ?>
                    <?php if (($_SESSION['kategoriID']) === 1 || ($_SESSION['kategoriID']) === 2): ?>
                    <li><a href="indexPetugas.php"><img src="img/user_icon.png" class="icon">Petugas</a></li>
                    <?php endif; ?>
                    <li><a href="database/logout.php"><img src="img/user_icon.png" class="icon">Keluar</a></li>
                </ul>
            </div>
        </label>
        
        <div class="cont">
            <nav>
                <a href="index.php"><img src="img/Kliket-logo-blue.png" class="logo"></a>
                <ul>
                    <li><a href=""><img src="img/user_icon.png" class="logo2"><?php echo htmlspecialchars($nama); ?></a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="faq-container">
        <div class="faq-header">
            <h1>FAQs</h1>
        </div>
        <details>
            <summary>Apa itu Travel?</summary>
            <p>Travel adalah aktivitas yang melibatkan perpindahan dari satu tempat ke tempat lain, baik untuk tujuan rekreasi, bisnis, pendidikan, atau tujuan lainnya. Ini melibatkan transportasi, akomodasi, dan pengalaman baru di tempat yang dikunjungi.</p>
        </details>
        <details>
            <summary>Apakah situs web KliKer aman untuk digunakan pembayaran? </summary>
            <p>Ya, situs web kami dilengkapi dengan sistem keamanan yang canggih untuk melindungi informasi pribadi dan transaksi pembayaran pelanggan.</p>
        </details>
        <details>
            <summary>Apakah KliKer aman digunakan sebagai platform perjalanan?</summary>
            <p>KliKer adalah platform perjalanan yang aman dan dapat dipercaya, dengan penerapan sistem keamanan yang ketat dan penggunaan sertifikat SSL untuk melindungi informasi pribadi pelanggan. Dengan demikian, pengguna dapat merasa nyaman dan terjamin saat menggunakan KliKer untuk merencanakan perjalanan mereka.</p>
        </details>
    </div>

</body>
</html>
