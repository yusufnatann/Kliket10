<?php
    include '../database/koneksi.php';
    include '../database/authAdmin.php';
?>
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
                    <li><a href="admpetugas.php"><img src="../img/petugas.png" class="icon">Petugas Terminal</a></li>
                    <li><a href="admtiket.php"><img src="../img/kelolatiket.png" class="icon">Kelola Tiket</a></li>
                    <li><a href="#"><img src="../img/datapenjualan.png" class="icon">Data Penjualan</a></li>
                    <li><a href="#"><img src="../img/validasipembayaran.png" class="icon">Validasi Pembayaran</a></li>
                    <li><a href="../database/logout.php"><img src="../img/keluar.png" class="icon">Keluar</a></li>
                </ul>
            </div>
        </label>
                
        <div class="cont">
            <nav>
                <a href="admutama.php"><img src="../img/Kliket-logo-blue.png" class="logo"></a>
                <ul>
                    <li><a href=""><img src="../img/user_icon.png" class="logo2"><?php echo $_SESSION['username'];?></a></li>
                </ul>
            </nav>
        </div>
    </div>

</body>