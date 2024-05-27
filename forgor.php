<?php
include 'database/koneksi.php';

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/loading.js" defer></script>
    <title>Lupa Password</title>
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
                <form class="log-form" action="database/forgor.php" method="POST">
                    <h1 class="reg-title">Lupa Password</h1>
                    <div class="input-box">
                        <input type="email" class="inp-b" id="email" name="email" placeholder="Email" required>
                    </div>
                    <button type="submit" class="btn">Submit</button>
                    <div class="register-link">
                        <p>Sudah punya akun? <a href="login.html">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Script for show/hide password -->
    <script>
        let eyeicon = document.getElementById("eyeicon");
        let passwords = document.getElementById("passwords");

        let eyeicons = document.getElementById("eyeicons");
        let conpassword = document.getElementById("conpassword");

        eyeicon.onclick = function(){
            if(passwords.type == "password"){
                passwords.type = "text";
                eyeicon.src = "img/eyeopen.png";
            }
            else {
                passwords.type = "password";
                eyeicon.src = "img/eyeclose.png";
            }
        }
    </script>
</body>
</html>