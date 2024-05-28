<?php
include '../database/koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];

if(empty($id) || empty($nama) || empty($email) || empty($password)) {
    echo "error: Missing data";
    exit();
}

$sql = "UPDATE petugas 
        JOIN akun ON petugas.userid = akun.userid
        SET petugas.nama = ?, petugas.email = ?, akun.kata_sandi = ?
        WHERE akun.userid = ? AND akun.kategoriID = 2";

$stmt = $conn->prepare($sql);

if($stmt === false) {
    echo "error: Statement preparation failed";
    exit();
}

$stmt->bind_param("sssi", $nama, $email, $password, $id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: " . $stmt->error;
}
?>
