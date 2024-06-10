<head>
<script src="https://kit.fontawesome.com/f1396b40aa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/navbar.css">
</head>

<div class="nav">
        <label>
            <input type="checkbox" class="hiddens">
            <div class="toggle">
                <span class="top_line common"></span>
                <span class="middle_line common"></span>
                <span class="bottom_line common"></span>
            </div>
            
            <div class="bartiga">
                <h1 class="title">‎ </h1>
                <ul class="navmenu">
                    <li><a href="profile.php"><img src="img/user.png" class="icon">Akun</a></li>
                    <li><a href="pesanan.php"><i class="fa-solid fa-receipt icon"></i>Pesanan Saya</a></li>
                    <li><a href="riwayat.php"><i class="fa-solid fa-clock-rotate-left icon"></i>Riwayat Tiket</a></li>
                    <li><a href="faq.php"><img src="img/faq.png" class="icon">FAQ</a></li>
                    <li><a href="database/logout.php"><img src="img/keluar.png" class="icon">Keluar</a></li>
                </ul>
            </div>
        </label>
        
        <div class="cont">
            <nav>
                <a href="index.php"><img src="img/Kliket-logo-blue.png" class="logo"></a>
                <ul>
                    <li><a href="profile.php"><img src="img/user_icon.png" class="logo2"><?php echo htmlspecialchars($nama); ?></a></li>
                </ul>
            </nav>
        </div>
    </div>