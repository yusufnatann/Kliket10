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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font.css">
</head>
<body>
    <div class="box">
        <div class="conta">
            <img src="img/background_login.png" class="bg_log">
            <div class="login">
                <form class="log-form" action="" method="POST">
                    <h1 class="login-title">Ubah Password</h1>
                    <div class="input-box-pass">
                        <input type="password" class="inp-b" id="new_password" name="new_password" placeholder="New Password" required>
                        <img src="img/eyeclose.png" id="eyeicon">
                    </div>
                    <button type="submit" class="btn">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script for hide/show password -->
    <script>
        let eyeicon = document.getElementById("eyeicon");
        let password = document.getElementById("new_password");

        eyeicon.onclick = function(){
            if(password.type == "password"){
                password.type = "text";
                eyeicon.src = "img/eyeopen.png";
            }
            else {
                password.type = "password";
                eyeicon.src = "img/eyeclose.png";
            }
        }
    </script>
</body>
</html>
