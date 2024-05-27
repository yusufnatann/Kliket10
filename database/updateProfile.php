<?php
include 'koneksi.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}

$userID = $_SESSION['userID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE pengguna SET nama = ?, email = ? WHERE userID = ?");
    $stmt->bind_param('ssi', $nama, $email, $userID);

    if ($stmt->execute()) {
        header("Location: ../profile.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat memperbarui profil.";
    }
}
?>
