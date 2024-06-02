<?php
include 'koneksi.php';

if (isset($_GET['action']) && isset($_GET['tiketID'])) {
    $action = $_GET['action'];
    $tiketID = $_GET['tiketID'];
    
    if ($action == 'confirm') {
        $sql = "UPDATE tiket SET valid = 1 WHERE tiketID = ?";
    } elseif ($action == 'decline') {
        $sql = "UPDATE tiket SET valid = 2 WHERE tiketID = ?";
    }

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $tiketID);
        if ($stmt->execute()) {
            header("Location: ../admin/admvalidasi.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
