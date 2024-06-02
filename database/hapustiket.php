<?php
include '../database/koneksi.php';

if (isset($_GET['id'])) {
    $ruteid = $_GET['id'];

    $sql = "DELETE FROM rute WHERE ruteid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ruteid);

    if ($stmt->execute()) {
        echo "Data berhasil dihapus";
        header("Location: ../admin/admtiket.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID tidak ditemukan";
}
?>
