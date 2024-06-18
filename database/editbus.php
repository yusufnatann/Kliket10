<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busid = $_POST['busid'];
    $nama_bus = $_POST['nama_bus'];
    $kapasitas = $_POST['kapasitas'];

    $busid = mysqli_real_escape_string($conn, $busid);
    $nama_bus = mysqli_real_escape_string($conn, $nama_bus);
    $kapasitas = mysqli_real_escape_string($conn, $kapasitas);

    $sql = "UPDATE bus SET nama='$nama_bus', total_kursi='$kapasitas' WHERE busid='$busid'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/admbus.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>