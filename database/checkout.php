<?php
include 'koneksi.php';
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tiketID = $_POST['tiketID'];
    $userID = $_SESSION['userID'];

    $target_dir = "../bukti/";
    $imageFileType = strtolower(pathinfo($_FILES["bukti_pembayaran"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . 'bukti_' . $tiketID . '.' . $imageFileType;
    $uploadOk = 1;

    $check = getimagesize($_FILES["bukti_pembayaran"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        $timestamp = time();
        $target_file = $target_dir . 'bukti_' . $tiketID . '_' . $timestamp . '.' . $imageFileType;
    }

    if ($_FILES["bukti_pembayaran"]["size"] > 5000000) {
        echo "Maaf, file Anda terlalu besar.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Maaf, hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<br>Maaf, file Anda tidak terunggah.";
        echo "<br><a href="."../pembayaran.php?tiketID=".$tiketID.">Kembali?</a>";
    } else {
        if (move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"], $target_file)) {

            $update_query = "UPDATE tiket SET pembayaran = 1, bukti_pembayaran = ? WHERE tiketID = ? AND userID = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("sii", $target_file, $tiketID, $userID);

            if ($update_stmt->execute()) {
                echo "Pembayaran berhasil. Terima kasih telah memesan tiket!";
                echo "<a href="."../index.php".">Kembali?</a>";
            } else {
                echo "Error: " . $conn->error;
            }

            $update_stmt->close();
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
            echo "<br><a href="."../pembayaran.php?tiketID=".$tiketID.">Kembali?</a>";
        }
    }

    $conn->close();
}
?>
