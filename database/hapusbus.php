<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $busid = $_GET['id'];

    $busid = mysqli_real_escape_string($conn, $busid);

    $sql = "DELETE FROM bus WHERE busid='$busid'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/admbus.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
