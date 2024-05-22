<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);

    $conn->begin_transaction();

    try {
        $sql1 = "INSERT INTO akun (username, kategoriID, kata_sandi) VALUES ('$username', '3', '$password')";
        if ($conn->query($sql1) === TRUE) {
            $userid = $conn->insert_id;

            $sql2 = "INSERT INTO pengguna (userid, username, nama, email) VALUES ('$userid', '$username', '$username', '$email')";
            if ($conn->query($sql2) === TRUE) {
                $conn->commit();
                header("Location: ../login.html");
                exit();
            } else {
                $conn->rollback();
                echo "Error: " . $conn->error;
            }
        } else {
            $conn->rollback();
            echo "Error: " . $conn->error;
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo "Exception: " . $e->getMessage();
    }
}
?>