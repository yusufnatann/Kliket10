<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $query = "SELECT userID FROM pengguna WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['userID'];
        header("Location: ../newpass.php?userID=" . $userID);
        exit();
    } else {
        echo "Email tidak ditemukan.";
    }
}
?>
