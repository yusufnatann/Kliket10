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
        echo "<p style='color: #5c5858'>ID Tiket: " . $row['tiketID'] . "</p>";
        echo "<p><br></p>";
        echo "<p style='font-size: 24px; color: #5c5858'>" . $row['asal'] . " - " . $row['tujuan'] . "</p>";        
        echo "<p style='color: #5c5858'>Tanggal Berangkat: " . $row['tanggal_berangkat'] . "</p>";
        echo "<p style='color: #5c5858'>Waktu Berangkat: " . $row['waktu_berangkat'] . "</p>";
    } else {
        echo "<p>Detail tiket tidak ditemukan.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>ID tiket tidak ditemukan.</p>";
}
?>