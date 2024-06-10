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
    <link rel="stylesheet" href="css/font.css">
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'navbar.php';
    ?>

    <!-- Pembayaran -->
    <div class="container">
        <h1 style='color: #5c5858'>Informasi Pembayaran</h1>
        <hr>
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
                <p style='color: #5c5858; padding: 10px'>Asal: <?php echo htmlspecialchars($row['asal']); ?></p>
                <p style='color: #5c5858; padding: 10px'>Tujuan: <?php echo htmlspecialchars($row['tujuan']); ?></p>
                <p style='color: #5c5858; padding: 10px'>Tanggal Berangkat: <?php echo htmlspecialchars($row['tanggal_berangkat']); ?></p>
                <p style='color: #5c5858; padding: 10px'>Waktu Berangkat: <?php echo htmlspecialchars($row['waktu_berangkat']); ?></p>
                <p style='color: #5c5858; padding: 10px'>Harga: Rp<?php echo htmlspecialchars($row['harga']); ?></p>
                <p style='color: #5c5858; padding: 10px'>Kode Unik Bank Virtual: <?php echo htmlspecialchars($row['kode_unik_bank']); ?></p>
                
                <!-- Form untuk upload bukti pembayaran -->
                <form action="database/checkout.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="tiketID" value="<?php echo htmlspecialchars($tiketID); ?>">
                    <label for="bukti_pembayaran" style='color: #5c5858; padding: 10px'>Upload Bukti Pembayaran:</label>
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

        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            $message = isset($_GET['message']) ? urldecode($_GET['message']) : '';
            if ($status === 'berhasil') {
                echo "<script>
                        alert('Berhasil');
                        window.location.href = 'index.php';
                      </script>";
            } else if ($status === 'gagal') {
                echo "<script>
                        alert('Tidak berhasil! $message');
                        window.location.href = 'index.php';
                      </script>";
            }
        }
        ?>
    </div>
</body>
</html>