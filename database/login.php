<?php
include 'koneksi.php'; // Pastikan file ini berisi koneksi database ($conn)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi dan sanitasi input jika perlu
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query untuk mendapatkan user dari database berdasarkan username
    $sql = "SELECT * FROM akun WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            // Username ditemukan, verifikasi password
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['kata_sandi'];
            $storedKategori = intval($row['kategoriID']);
            $storedid = $row['userID'];

            if ($password === $stored_password) {
                // Password benar, set session
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $storedid;

                if ($storedKategori === 1) {
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    header("Location: ../admutama.html");
                } elseif ($storedKategori === 2) {
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    header("Location: ../indexpetugas.html");
                } elseif ($storedKategori === 3) {
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    header("Location: ../index.php");
                } else {
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    $_SESSION['login_error'] = "Kategori pengguna tidak dikenal";
                    header("Location: ../error.html");
                }
                exit();
            } else {
                // Password salah
                $_SESSION['login_error'] = "Password salah";
                mysqli_free_result($result);
                mysqli_close($conn);
                header("Location: ../test.html");
                exit();
            }
        } else {
            // Username tidak ditemukan
            $_SESSION['login_error'] = "Username tidak ditemukan";
            mysqli_free_result($result);
            mysqli_close($conn);
            header("Location: ../test2.html");
            exit();
        }
    } else {
        // Query gagal dieksekusi
        $_SESSION['login_error'] = "Query database gagal";
        mysqli_close($conn);
        header("Location: ../error.html"); // Redirect ke halaman error
        exit();
    }
} else {
    // Request method tidak valid (harus POST)
    $_SESSION['login_error'] = "Metode request tidak valid";
    header("Location: ../error.html"); // Redirect ke halaman error
    exit();
}
?>
