<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket</title>
    <link rel="stylesheet" href="../css/style(6).css">
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'adminnavbar.php';
    ?>

    <!-- Tabel tiket -->
    <div class="main-content">
        <nav>
            <div class="text">Kelola Tiket</div>
            <form class="search-form" action="#">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search">
                    <i class="fas fa-search"></i>
                </div>
            </form>
            <button class="addtiket">Tambah Rute</button>
        </nav>
        <div class="table-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Terminal Asal</th>
                        <th>Terminal Tujuan</th>
                        <th>Tanggal Berangkat</th>
                        <th>Waktu Berangkat</th>
                        <th>Bus</th>
                        <th>Harga</th>
                        <th class="actions-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bandar Lampung</td>
                        <td>Palembang</td>
                        <td>200.000</td>
                        <td class="actions-column">
                            <a href="admedit.html"><img src="../img/edit.png" class="edit-icon"></a>
                            <a href="admhapus.html"><img src="../img/hapus.png" class="delete-icon"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Bandar Lampung</td>
                        <td>Jakarta</td>
                        <td>400.000</td>
                        <td class="actions-column">
                            <a href="admedit.html"><img src="../img/edit.png" class="edit-icon"></a>
                            <a href="admhapus.html"><img src="../img/hapus.png" class="delete-icon"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Bandar Lampung</td>
                        <td>Semarang</td>
                        <td>500.000</td>
                        <td class="actions-column">
                            <a href="admedit.html"><img src="../img/edit.png" class="edit-icon"></a>
                            <a href="admhapus.html"><img src="../img/hapus.png" class="delete-icon"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Bandar Lampung</td>
                        <td>Jogjakarta</td>
                        <td>600.000</td>
                        <td class="actions-column">
                            <a href="admedit.html"><img src="../img/edit.png" class="edit-icon"></a>
                            <a href="admhapus.html"><img src="../img/hapus.png" class="delete-icon"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Jakarta</td>
                        <td>500.000</td>
                        <td class="actions-column">
                            <a href="admedit.html"><img src="../img/edit.png" class="edit-icon"></a>
                            <a href="admhapus.html"><img src="../img/hapus.png" class="delete-icon"></a>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
    </div>
    </div>
</body>
</html>
