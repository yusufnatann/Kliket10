<?php
include 'database/koneksi.php';
include 'database/auth.php';

$tiketQuery = "SELECT t.tiketID, t.pembayaran, r.asal, r.tujuan, r.waktu_berangkat, r.tanggal_berangkat 
                FROM tiket t 
                JOIN rute r ON t.ruteID = r.ruteID 
                WHERE t.userID = ?";
$stmt = $conn->prepare($tiketQuery);
$stmt->bind_param('i', $userID);
$stmt->execute();
$tiketResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tiket</title>
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
                    <li><a href="profile.php"><img src="img/user_icon.png" class="logo2"><?php echo htmlspecialchars($nama); ?></a></li>
                </ul>
            </nav>
        </div>
    </div>

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
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($tiketResult->num_rows > 0) {
                        $no = 1;
                        while ($row = $tiketResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['asal'] . "</td>";
                            echo "<td>" . $row['tujuan'] . "</td>";
                            echo "<td>" . $row['waktu_berangkat'] . "</td>";
                            echo "<td>" . $row['tanggal_berangkat'] . "</td>";
                            echo "<td>";
                            if ($row['pembayaran'] == 1) {
                                echo "Sudah Bayar";
                            } elseif ($row['pembayaran'] == 2) {
                                echo "Batal";
                            } else {
                                echo "Belum Dibayar";
                            }
                            echo "</td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada riwayat tiket.</td></tr>";
                    }
                    $stmt->close();
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
