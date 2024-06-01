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
            <div class="text">Validasi Tiket</div>
            <form class="search-form" method="GET" action="admvalidasi.php">
                <div class="search-box">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                    <i class="fas fa-search"></i>
                </div>
            </form>
            <button class="addtiket">Tambah Rute</button>
        </nav>
        <div class="table-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>ID Tiket</th>
                        <th>Nama Pengguna</th>
                        <th>Terminal Asal</th>
                        <th>Terminal Tujuan</th>
                        <th>Harga</th>
                        <th>Kode Unik Bank</td>
                        <th>Bukti</th>
                        <th class="actions-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tabel disni -->
                    <?php
                    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

                    $sql = "SELECT tiket.tiketID, pengguna.nama, rute.asal, rute.tujuan, rute.harga, tiket.kode_unik_bank, tiket.bukti_pembayaran 
                            FROM tiket
                            JOIN pengguna ON tiket.userID = pengguna.userID
                            JOIN rute ON tiket.ruteID = rute.ruteID
                            WHERE tiket.pembayaran = '1' AND tiket.valid = 'belum_divalidasi'";
                    
                    if (!empty($searchQuery)) {
                        $sql .= " AND (pengguna.nama LIKE '%$searchQuery%' OR rute.asal LIKE '%$searchQuery%' OR rute.tujuan LIKE '%$searchQuery%')";
                    }
                    
                    $sql .= " ORDER BY tiket.pembayaran DESC, tiket.valid ASC";
                    
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["tiketID"] . "</td>
                                    <td>" . $row["nama"] . "</td>
                                    <td>" . $row["asal"] . "</td>
                                    <td>" . $row["tujuan"] . "</td>
                                    <td>" . $row["harga"] . "</td>
                                    <td>" . $row["kode_unik_bank"] . "</td>
                                    <td><img src='" . $row["bukti_pembayaran"] . "' alt='Bukti' style='width:50px; height:50px;'></td>
                                    <td class='actions-column'>
                                        <a href='" . $row["tiketID"] . "'><img src='../img/edit.png' class='edit-icon'></a>
                                        <a href='" . $row["tiketID"] . "'><img src='../img/hapus.png' class='delete-icon'></a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Tidak ada data tiket</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
    </div>
    </div>
</body>
</html>
