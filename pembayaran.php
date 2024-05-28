<?php
include 'database/koneksi.php';
include 'database/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket - Pembayaran</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pembayaran.css">
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'navbar.php';
    ?>

    <!-- Pembayaran -->
    <div class="container">
        <h1>Informasi Pembayaran</h1>
        <?php
        if (isset($_GET['tiketID'])) {
            $tiketID = $_GET['tiketID'];

            // Dapatkan detail tiket dari tiketID
            $query = "SELECT rute.asal, rute.tujuan, rute.tanggal_berangkat, rute.waktu_berangkat, rute.harga, tiket.kode_unik_bank 
                      FROM tiket JOIN rute ON tiket.ruteID = rute.ruteID WHERE tiket.tiketID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $tiketID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <p>Asal: <?php echo htmlspecialchars($row['asal']); ?></p>
                <p>Tujuan: <?php echo htmlspecialchars($row['tujuan']); ?></p>
                <p>Tanggal Berangkat: <?php echo htmlspecialchars($row['tanggal_berangkat']); ?></p>
                <p>Waktu Berangkat: <?php echo htmlspecialchars($row['waktu_berangkat']); ?></p>
                <p>Harga: Rp <?php echo htmlspecialchars($row['harga']); ?></p>
                <p>Kode Unik Bank Virtual: <?php echo htmlspecialchars($row['kode_unik_bank']); ?></p>
                
                <!-- Form untuk upload bukti pembayaran -->
                <form action="database/checkout.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="tiketID" value="<?php echo htmlspecialchars($tiketID); ?>">
                    <label for="bukti_pembayaran">Upload Bukti Pembayaran:</label>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="bukti/*" required>
                    <button type="submit" class="btn-pembayaran">Bayar</button>
                </form>
                <?php
            } else {
                echo "<p>Tiket tidak ditemukan.</p>";
            }

            $stmt->close();
        } else {
            echo "<p>Informasi pembayaran tidak valid.</p>";
        }
        ?>
    </div>
</body>
</html>