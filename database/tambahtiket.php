<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $waktu_berangkat = $_POST['waktu_berangkat'];
    $tanggal_berangkat = $_POST['tanggal_berangkat'];
    $busID = $_POST['busID'];
    $harga = $_POST['harga'];

    if ($asal == $tujuan){
        header("Location: ../admin/admtiket.php?error=asal_tujuan");
    } else {
        $sql = "INSERT INTO rute (asal, tujuan, waktu_berangkat, tanggal_berangkat, busID, harga) VALUES ('$asal', '$tujuan', '$waktu_berangkat', '$tanggal_berangkat', '$busID', '$harga')";

        if ($conn->query($sql) === TRUE) {
            echo "Rute baru berhasil ditambahkan";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        header("Location: ../admin/admtiket.php");
        exit();
    }
}
?>
