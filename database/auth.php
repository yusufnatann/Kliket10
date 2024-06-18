<?php
if (!isset($_SESSION['username']) || !isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['userID'];

$sql = "
    SELECT p.nama, p.email 
    FROM pengguna p
    WHERE p.userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$nama = isset($user['nama']) ? $user['nama'] : '';
$email = isset($user['email']) ? $user['email'] : '';
?>