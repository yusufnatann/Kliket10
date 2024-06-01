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
    <link rel="stylesheet" href="css/font.css">
    <script src="https://kit.fontawesome.com/f1396b40aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'navbar.php';
    ?>

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