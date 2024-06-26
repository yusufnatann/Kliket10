<?php
include 'database/koneksi.php';
if (isset($_SESSION['username'])){
    header("Location: admin/admutama.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font.css">
    <script src="js/loading.js" defer></script>
</head>
<body>
    
    <div class="nav">
        <nav>
            <a href=""><img src="img/Kliket-logo-blue.png" class="logo"></a>
        </nav>
    </div>

    <div class="box">
        <div class="conta">
            <img src="img/background_login.png" class="bg_log">
            <div class="login">
                <form class="log-form" action="database/login.php" method="POST">
                    <h1 class="login-title">Masuk</h1>
                    <div class="input-box">
                        <input type="text" class="inp-b" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-box-pass">
                        <input type="password" class="inp-b" id="password" name="password" placeholder="Kata Sandi" required>
                        <img src="img/eyeclose.png" id="eyeicon">
                    </div>
                    <div class="forget-pass">
                        <a href="forgor.php" class="forgor">Lupa Kata Sandi?</a>
                    </div>
                    <button type="submit" class="btn">Masuk</button>
                    <div class="register-link">
                        <p>Tidak punya akun? <a href="register.php">Daftar Sekarang!</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Loading -->
    <div class="loader"></div>


    <!-- Script for hide/show password -->
    <script>
        let eyeicon = document.getElementById("eyeicon");
        let password = document.getElementById("password");

        eyeicon.onclick = function(){
            if(password.type == "password"){
                password.type = "text";
                eyeicon.src = "/img/eyeopen.png";
            }
            else {
                password.type = "password";
                eyeicon.src = "/img/eyeclose.png";
            }
        }
    </script>
</body>
</html>
