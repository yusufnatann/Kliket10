<?php
include 'database/koneksi.php';

if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
} else {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];

    $update_query = "UPDATE akun SET kata_sandi = ? WHERE userID = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("si", $new_password, $userID);

    if ($update_stmt->execute()) {
        echo "Password berhasil diperbarui. Silakan login dengan password baru Anda.";
        header("Location: login.html");
        exit();
    } else {
        echo "Terjadi kesalahan saat memperbarui password.";
    }

    $update_stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Password</title>
</head>
<body>
    <h1>Ubah Password</h1>
    <form method="POST" action="">
        <div>
            <label for="new_password">Password Baru:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <button type="submit">Ubah Password</button>
    </form>
</body>
</html>
