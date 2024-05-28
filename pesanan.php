<?php
include 'database/koneksi.php';
include 'database/auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya</title>
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
                    <li><a href="faq.html"><img src="img/user_icon.png" class="icon">FAQ</a></li>
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

    <!-- Pesan Tiket -->

    <div class="cons">
    <img src="img/background_pesan.png" class="bg_pesan">
    <div class="boxs">
        <div class="boxxs">
            <h1 class="pesan-title">Daftar Tiket Saya</h1>
            <p class="pesan-sub">Ayo bayar tiket sekarang!</p>
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
                        <th>Bayar</th>
                        <th>Batal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mendapatkan tiket yang belum dibayar dari database
                    $query = "SELECT t.tiketID, r.asal, r.tujuan, r.waktu_berangkat, r.tanggal_berangkat , r.ruteID
                            FROM tiket t
                            JOIN rute r ON t.ruteID = r.ruteID
                            WHERE t.userID = {$_SESSION['userID']} AND t.pembayaran = 0";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$row['asal']}</td>
                                    <td>{$row['tujuan']}</td>
                                    <td>{$row['waktu_berangkat']}</td>
                                    <td>{$row['tanggal_berangkat']}</td>
                                    <td><a href='database/checkout.php?tiketID={$row['tiketID']}'>Bayar</a></td>
                                    <td><a href='database/cancel.php?tiketID={$row['tiketID']}'>Batal</a></td>
                                  </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='8'>Tidak ada tiket yang dipesan</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>