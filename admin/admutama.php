<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style(2).css">
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'adminnavbar.php';
    ?>
    <!-- Main Content -->
    <div class="container">
        <img src="../img/background_login.png" class="bg_log">
        <div class="main-content">
            <div class="box">
                <div class="item">
                    <a href="admpetugas.php">
                        <img src="../img/petugas.png" alt="Petugas Terminal">
                        <h3>Petugas Terminal</h3>
                    </a>
                </div>
                <div class="item">
                    <a href="admtiket.php">
                    <img src="../img/kelolatiket.png" alt="Kelola Tiket">
                    <h3>Kelola Tiket</h3>
                    </a>
                </div>
                <div class="item">
                    <a href="">
                    <img src="../img/datapenjualan.png" alt="Data Penjualan">
                    <h3>Data Penjualan</h3>
                    </a>
                </div>
                <div class="item">
                    <a href="admvalidasi.php">
                    <img src="../img/validasipembayaran.png" alt="Validasi Pembayaran">
                    <h3>Validasi Pembayaran</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
