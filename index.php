<?php
include 'database/koneksi.php';
include 'database/auth.php';

$query = "SELECT nama FROM terminal ORDER BY nama ASC;";
$result = $conn->query($query);

$terminals = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $terminals[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tabel.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/font.css">
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
                <h1 class="pesan-title">Cari Tiket</h1>
                <p class="pesan-sub">Atur jadwal keberangkatan anda!</p>
            </div>
                <!-- Search disini -->
                <form action="list.php" method="POST" onsubmit="return validateForm()">
                    <label for="asal">Asal:</label>
                    <select id="asal" name="asal" required>
                        <option value="">Pilih Asal</option>
                        <?php foreach ($terminals as $terminal): ?>
                            <option value="<?php echo htmlspecialchars($terminal['nama']); ?>"><?php echo htmlspecialchars($terminal['nama']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <label for="tujuan">Tujuan:</label>
                    <select id="tujuan" name="tujuan" required>
                        <option value="">Pilih Tujuan</option>
                        <?php foreach ($terminals as $terminal): ?>
                            <option value="<?php echo htmlspecialchars($terminal['nama']); ?>"><?php echo htmlspecialchars($terminal['nama']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <label for="tanggal_berangkat">Tanggal Berangkat:</label>
                    <input type="date" id="tanggal_berangkat" name="tanggal_berangkat" required>
                    
                    <label for="waktu_berangkat">Waktu Berangkat:</label><br>
                    <div class="radio-group">
                        <input type="radio" id="jam_8" name="waktu_berangkat" value="08:00">
                        <label class="check-label" for="jam_8">Jam 08:00</label>

                        <input type="radio" id="jam_11" name="waktu_berangkat" value="11:00">
                        <label class="check-label" for="jam_11">Jam 11:00</label>

                        <input type="radio" id="jam_15" name="waktu_berangkat" value="15:00">
                        <label class="check-label" for="jam_15">Jam 15:00</label>
                    </div>
                    
                    <button type="submit">Cari Tiket</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    function validateForm() {
        const tanggalBerangkat = document.getElementById('tanggal_berangkat').value;
        const today = new Date().toISOString().split('T')[0];
        
        if (tanggalBerangkat < today) {
            alert("Tanggal berangkat tidak bisa kemarin.");
            return false;
        }
        return true;
    }
</script>