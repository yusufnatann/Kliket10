<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Petugas</title>
    <link rel="stylesheet" href="../css/style(3).css">
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'adminnavbar.php';
    ?>

    <div class="box">
        <div class="conta">
            <img src="../img/background_login.png" class="bg_log">
            <div class="login">
                <form class="log-form" action="../database/regpetugas.php" method="POST">
                    <h1 class="login-title">Tambah Data Petugas</h1>
                    <div class="input-box">
                        <input type="text" class="inp-b" id="Username" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-box">
                        <input type="email" class="inp-b" id="Email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-box-pass">
                        <input type="password" class="inp-b" id="password" name="password" placeholder="Kata Sandi" required>
                        <img src="../img/eyeclose.png" id="eyeicon">
                    </div>
                    <button type="submit" class="btn">Daftar</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Script for hide/show password -->
    <script>
        let eyeicon = document.getElementById("eyeicon");
        let password = document.getElementById("password");

        eyeicon.onclick = function(){
            if(password.type == "password"){
                password.type = "text";
                eyeicon.src = "../img/eyeopen.png";
            }
            else {
                password.type = "password";
                eyeicon.src = "../img/eyeclose.png";
            }
        }
    </script>
</body>
</html>
