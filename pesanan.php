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
    <link rel="stylesheet" href="css/font.css">
    <script src="https://kit.fontawesome.com/f1396b40aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'navbar.php';
    ?>

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
                                    <td><a href='pembayaran.php?tiketID={$row['tiketID']}'>Bayar</a></td>
                                    <td><a href='javascript:void(0);' onclick='confirmCancellation({$row['tiketID']})'>Batal</a></td>
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

<script>
    function confirmCancellation(tiketID) {
        var confirmAction = confirm("Apakah Anda yakin ingin membatalkan tiket ini?");
        if (confirmAction) {
            window.location.href = 'database/cancel.php?tiketID=' + tiketID;
        }
    }
</script>