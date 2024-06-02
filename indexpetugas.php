<?php
include 'database/koneksi.php';
include 'database/authPetugas.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stylePetugas.css">
    <title>Petugas</title>
</head>

<body>
    <div class="navbar">
        <div class="container">
            <a href="indexpetugas.php"><img src="img/Kliket-logo-blue.png" class="logo"></a>
            <ul class="nav-items">
                <li><a href="Login.html"><img src="img/image 5.png" class="logout"></a></li>
                <li><a href="database/logout.php">Keluar</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="text-center">
            <h1 class="text-center 1">Data Pesanan Tiket</h1>
            <h3 class="text-center 2">Pilih Jam Keberangkatan</h3>
            </div>
    </div>

    <div class="image-list">
        <a href="data8.php"><img src="img/icon 08.00.png" alt="jam 08.00"></a>
        <a href="data11.php"><img src="img/icon 11.00.png" alt="jam 11.00"></a>       
        <a href="data15.php"><img src="img/icon 15.00.png" alt="jam 15.00"></a>
    </div>


</body>
</html>