<?php
include 'database/koneksi.php';
include 'database/authPetugas.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stylePetugas.css">
    <title>Petugas</title>
</head>

<body>
    <div class="navbar">
        <div class="container">
            <a href="indexpetugas.php"><img src="img/Kliket-logo-blue.png" class="logo"></a>
            <ul class="nav-items">
                <li><em>Bandar Lampung 11.00</em></li>
            </ul>
        </div>
    </div>
    
    <h1>Daftar Pesanan</h1>
    <table class="order-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Kode</th>
                <th>Aksi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT pengguna.nama, rute.asal, rute.tujuan, tiket.tiketID, tiket.status_kehadiran
                    FROM tiket 
                    JOIN pengguna ON tiket.userID = pengguna.userID 
                    JOIN rute ON tiket.ruteID = rute.ruteID 
                    WHERE rute.waktu_berangkat = '08:00' AND tiket.pembayaran = 1";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nama"] . "</td>";
                    echo "<td>" . $row["asal"] . "</td>";
                    echo "<td>" . $row["tujuan"] . "</td>";
                    echo "<td>" . $row["tiketID"] . "</td>";
                    echo '<td>
                            <button class="action-button hadir" onclick="updateStatus(this, \'Hadir\')">Hadir</button>
                            <button class="action-button tidak-hadir" onclick="updateStatus(this, \'Tidak Hadir\')">Tidak Hadir</button>
                          </td>';
                    echo '<td class="status">' . $row["status_kehadiran"] . '</td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <script src="js/scriptPetugas.js"></script>
</body>
</html>