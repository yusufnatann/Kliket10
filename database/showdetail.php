<?php
include 'koneksi.php';

if (isset($_GET['tiketID'])) {
    $tiketID = $_GET['tiketID'];

    $query = "SELECT t.tiketID, t.pembayaran, t.valid, r.asal, r.tujuan, r.waktu_berangkat, r.tanggal_berangkat, t.userID 
              FROM tiket t 
              JOIN rute r ON t.ruteID = r.ruteID 
              WHERE t.tiketID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $tiketID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p>ID Tiket: " . $row['tiketID'] . "</p>";
        echo "<p><br></p>";
        echo "<p>Terminal Asal: " . $row['asal'] . "</p>";
        echo "<p>Terminal Tujuan: " . $row['tujuan'] . "</p>";
        echo "<p>Waktu Berangkat: " . $row['waktu_berangkat'] . "</p>";
        echo "<p>Tanggal Berangkat: " . $row['tanggal_berangkat'] . "</p>";
        echo "<p>Status Pembayaran: " . ($row['pembayaran'] == 1 ? "Sudah Bayar" : ($row['pembayaran'] == 2 ? "Batal" : "Belum Dibayar")) . "</p>";
        echo "<p>Status Validasi: " . ($row['valid'] == 1 ? "Valid" : "Belum Valid") . "</p>";
    } else {
        echo "<p>Detail tiket tidak ditemukan.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>ID tiket tidak ditemukan.</p>";
}
?>