<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

if (isset($_GET['tiketID'])) {
    $tiketID = intval($_GET['tiketID']);
    $userID = $_SESSION['userID'];

    // Tambahkan log untuk debugging
    error_log("TiketID: $tiketID, UserID: $userID");

    // Validasi bahwa tiketID milik user yang sedang login dan belum dibayar
    $query = "SELECT * FROM tiket WHERE tiketID = ? AND userID = ? AND pembayaran = 0";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param('ii', $tiketID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Hapus tiket dari database
        $deleteQuery = "DELETE FROM tiket WHERE tiketID = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        if (!$deleteStmt) {
            die("Prepare statement for delete failed: " . $conn->error);
        }
        $deleteStmt->bind_param('i', $tiketID);
        if ($deleteStmt->execute()) {
            header("Location: tiketsaya.php");
            exit();
        } else {
            echo "Terjadi kesalahan saat membatalkan tiket.";
        }
        $deleteStmt->close();
    } else {
        echo "Tiket tidak ditemukan atau sudah dibayar.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Tidak ada tiket yang dipilih untuk dibatalkan.";
}
?>
