<?php
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE petugas, akun
        FROM petugas
        JOIN akun ON petugas.userid = akun.userid
        WHERE akun.userid = ? AND akun.kategoriID = 2";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}
?>
