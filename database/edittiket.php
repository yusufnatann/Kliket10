<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ruteid = $_POST['ruteid'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $tanggal_berangkat = $_POST['tanggal_berangkat'];
    $waktu_berangkat = $_POST['waktu_berangkat'];
    $busID = $_POST['busID'];
    $harga = $_POST['harga'];

    $sql = "UPDATE rute SET asal=?, tujuan=?, tanggal_berangkat=?, waktu_berangkat=?, busid=?, harga=? WHERE ruteid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisi", $asal, $tujuan, $tanggal_berangkat, $waktu_berangkat, $busID, $harga, $ruteid);

    if ($stmt->execute()) {
        echo "Data berhasil diperbarui";
        header("Location: ../admin/admtiket.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}
?>
