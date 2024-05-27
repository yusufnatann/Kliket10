<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tiketID = $_POST['tiketID'];
    $status = $_POST['status'];

    $sql = "UPDATE tiket SET status_kehadiran='$status' WHERE tiketID='$tiketID'";

    if ($conn->query($sql) === TRUE) {
        echo "Status berhasil diperbarui";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
