<?php
include 'koneksi.php';
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ruteID = $_POST['ruteID'];
    $userID = $_SESSION['userID'];
    $kode_unik_bank = rand(1000000000, 9999999999);

    $insert_query = "INSERT INTO tiket (ruteID, userID, pembayaran, kode_unik_bank) VALUES (?, ?, 0, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("iis", $ruteID, $userID, $kode_unik_bank);

    if ($insert_stmt->execute()) {
        $tiketID = $insert_stmt->insert_id;
        header("Location: ../pembayaran.php?tiketID=$tiketID");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $insert_stmt->close();
    $conn->close();
}
?>
