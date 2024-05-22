<?php
include 'koneksi.php';

if (!isset($_SESSION['userID'])) {
    // Jika userID tidak ditemukan di sesi, redirect ke halaman login
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ruteID = $_POST['ruteID'];
    $userID = $_SESSION['userID']; // Ambil userID dari sesi

    // Insert tiket ke database
    $sql = "INSERT INTO tiket (ruteID, userID, pembayaran) VALUES ('$ruteID', '$userID', 0)";

    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id; // Return tiketID
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
