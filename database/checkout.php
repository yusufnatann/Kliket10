<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tiketID = $_POST['tiketID'];

    $sql = "UPDATE tiket SET pembayaran = 1 WHERE tiketID = '$tiketID'";

    if ($conn->query($sql) === TRUE) {
        echo "Pembayaran berhasil.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>