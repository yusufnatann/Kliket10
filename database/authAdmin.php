<?php

if (!isset($_SESSION['username']) || !isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}

$userID = $_SESSION['userID'];

$sql = "
    SELECT a.username, a.kategoriID
    FROM akun a
    WHERE a.userID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['kategoriID'] == 1 ) {
    
} else {
    header("Location: ../indexPetugas.php");
    exit();
}

$nama = isset($user['nama']) ? $user['nama'] : '';
?>
