<?php
include 'koneksi.php';

if (isset($_GET['tiketID'])) {
    $tiketID = intval($_GET['tiketID']);
    $userID = $_SESSION['userID'];

    error_log("TiketID: $tiketID, UserID: $userID");

    $query = "SELECT * FROM tiket WHERE tiketID = ? AND userID = ? AND pembayaran = 0";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare statement gagal: " . $conn->error);
    }
    $stmt->bind_param('ii', $tiketID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $updateQuery = "UPDATE tiket SET pembayaran = 2 WHERE tiketID = ?";
        $updateStmt = $conn->prepare($updateQuery);
        if (!$updateStmt) {
            die("Prepare statement untuk update gagal: " . $conn->error);
        }
        $updateStmt->bind_param('i', $tiketID);
        if ($updateStmt->execute()) {
            header("Location: ../pesanan.php");
            exit();
        } else {
            echo "Terjadi kesalahan saat membatalkan tiket.";
        }
        $updateStmt->close();
    } else {
        echo "Tiket tidak ditemukan atau sudah dibayar.";
    }
} else {
    echo "Tidak ada tiket yang dipilih untuk dibatalkan.";
}
?>
