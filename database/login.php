<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM akun WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['kata_sandi'];
            $storedKategori = intval($row['kategoriID']);
            $storedid = $row['userID'];

            if ($password === $stored_password) {
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $storedid;
                $_SESSION['kategoriID'] = $storedKategori;

                if ($storedKategori === 1) {
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    header("Location: ../admin/admutama.php");
                } elseif ($storedKategori === 2) {
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    header("Location: ../indexpetugas.php");
                } elseif ($storedKategori === 3) {
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    header("Location: ../index.php");
                } else {
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    $_SESSION['login_error'] = "Kategori pengguna tidak dikenal";
                    header("Location: ../error/error.html");
                }
                exit();
            } else {
                $_SESSION['login_error'] = "Password salah";
                mysqli_free_result($result);
                mysqli_close($conn);
                header("Location: ../login.php");
                exit();
            }
        } else {
            $_SESSION['login_error'] = "Username tidak ditemukan";
            mysqli_free_result($result);
            mysqli_close($conn);
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Query database gagal";
        mysqli_close($conn);
        header("Location: ../error/error.html");
        exit();
    }
} else {
    $_SESSION['login_error'] = "Metode request tidak valid";
    header("Location: ../error/error.html");
    exit();
}
?>
