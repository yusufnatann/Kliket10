<?php
include 'database/koneksi.php';
include 'database/auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Kliket</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <!-- Navbar -->
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
                    <li><a href="profile.php"><img src="img/user_icon.png" class="icon">Akun</a></li>
                    <li><a href="pesanan.php"><img src="img/user_icon.png" class="icon">Pesanan Saya</a></li>
                    <li><a href="riwayat.php"><img src="img/user_icon.png" class="icon">Riwayat Tiket</a></li>
                    <li><a href="faq.php"><img src="img/user_icon.png" class="icon">FAQ</a></li>
                    <?php if (($_SESSION['kategoriID']) === 1): ?>
                    <li><a href="admin/admutama.html"><img src="img/user_icon.png" class="icon">Dashboard Admin</a></li>
                    <?php endif; ?>
                    <?php if (($_SESSION['kategoriID']) === 1 || ($_SESSION['kategoriID']) === 2): ?>
                    <li><a href="indexPetugas.php"><img src="img/user_icon.png" class="icon">Petugas</a></li>
                    <?php endif; ?>
                    <li><a href="database/logout.php"><img src="img/user_icon.png" class="icon">Keluar</a></li>
                </ul>
            </div>
        </label>
        
        <div class="cont">
            <nav>
                <a href="index.php"><img src="img/Kliket-logo-blue.png" class="logo"></a>
                <ul>
                    <li><a href=""><img src="img/user_icon.png" class="logo2"><?php echo htmlspecialchars($nama); ?></a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="cons">
        <div class="boxs">
            <div class="boxxs">
                <h1 class="pesan-title">Detail Akun</h1>
                <p class="pesan-sub">Informasi Personal</p>
            </div>
            <div class="profile-container">
                <div class="profile-info">
                    <p>Nama: <?php echo htmlspecialchars($nama); ?></p>
                    <p>Email: <?php echo htmlspecialchars($email); ?></p>
                </div>
                <button id="editProfileBtn">Ubah Profil</button>
            </div>
        </div>
    </div>

    <!-- Pop-up form -->
    <div class="overlay" id="overlay"></div>
    <div class="popup-form" id="popupForm">
        <form action="database/updateProfile.php" method="post">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <button type="submit">Simpan</button>
            <button type="button" id="closePopupBtn">Batal</button>
        </form>
    </div>
</body>
</html>

<script>
    document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.getElementById('popupForm').classList.add('active');
        document.getElementById('overlay').classList.add('active');
    });

    document.getElementById('closePopupBtn').addEventListener('click', function() {
        document.getElementById('popupForm').classList.remove('active');
        document.getElementById('overlay').classList.remove('active');
    });

    document.getElementById('overlay').addEventListener('click', function() {
        document.getElementById('popupForm').classList.remove('active');
        document.getElementById('overlay').classList.remove('active');
    });
</script>