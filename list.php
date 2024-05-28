<?php
include 'database/koneksi.php';
include 'database/auth.php';

$tickets = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $tanggal_berangkat = $_POST['tanggal_berangkat'];
    $waktu_berangkat = $_POST['waktu_berangkat'];

    $today = date('Y-m-d');
    if ($tanggal_berangkat < $today) {
        die("Tanggal berangkat tidak bisa kemarin.");
    }

    $query = "SELECT * FROM rute WHERE asal = ? AND tujuan = ? AND (tanggal_berangkat > ? OR (tanggal_berangkat = ? AND waktu_berangkat > ?))";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $asal, $tujuan, $tanggal_berangkat, $tanggal_berangkat, $waktu_berangkat);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $tickets[] = $row;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket - Hasil Pencarian</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tabel.css">
    <link rel="stylesheet" href="css/result.css">
    <script src="https://kit.fontawesome.com/f1396b40aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'navbar.php';
    ?>
    
    <!-- Hasil Pencarian -->
    <div class="cons">
        <div class="boxs">
            <div class="boxxs">
                <h1 class="pesan-title">Hasil Pencarian Tiket</h1>
                <?php if (count($tickets) > 0): ?>
                    <div class="results">
                        <table>
                            <thead>
                                <tr>
                                    <th>Asal</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal Berangkat</th>
                                    <th>Waktu Berangkat</th>
                                    <th>Harga</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tickets as $ticket): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($ticket['asal']); ?></td>
                                        <td><?php echo htmlspecialchars($ticket['tujuan']); ?></td>
                                        <td><?php echo htmlspecialchars($ticket['tanggal_berangkat']); ?></td>
                                        <td><?php echo htmlspecialchars($ticket['waktu_berangkat']); ?></td>
                                        <td><?php echo htmlspecialchars($ticket['harga']); ?></td>
                                        <td>
                                            <form action="database/pesan_tiket.php" method="POST">
                                                <input type="hidden" name="ruteID" value="<?php echo htmlspecialchars($ticket['ruteID']); ?>">
                                                <button type="submit" class="btn-pesan">Pesan</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>Tiket tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
