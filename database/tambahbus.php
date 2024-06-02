<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_bus = $_POST['nama_bus'];
    $kapasitas = $_POST['kapasitas'];

    if (empty($nama_bus) || empty($kapasitas)) {
        echo "Semua bidang harus diisi.";
    } else {
        $sql = "INSERT INTO bus (nama, total_kursi) VALUES ('$nama_bus', '$kapasitas')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: ../admin/admtiket.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "Akses tidak sah.";
}
?>
