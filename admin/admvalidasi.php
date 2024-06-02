<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket</title>
    <link rel="stylesheet" href="../css/style(11).css">
    <script src="https://kit.fontawesome.com/f1396b40aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'adminnavbar.php';
    ?>

    <!-- Tabel tiket -->
    <div class="main-content">
        <div class="text">Validasi Tiket</div>
        <form class="search-form" method="GET" action="admvalidasi.php">
            <div class="search-box">
                <input type="text" name="search" class="form-control" placeholder="Search">
                <i class="fas fa-search"></i>
            </div>
        </form>
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
                        <th>Status Valid</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tabel disni -->
                    <?php
                    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

                    $sql = "SELECT tiket.valid, tiket.tiketID, pengguna.nama, rute.asal, rute.tujuan, rute.harga, tiket.kode_unik_bank, tiket.bukti_pembayaran 
                            FROM tiket
                            JOIN pengguna ON tiket.userID = pengguna.userID
                            JOIN rute ON tiket.ruteID = rute.ruteID
                            WHERE tiket.pembayaran = '1' AND (tiket.valid = '0' OR tiket.valid= '2' OR tiket.valid = '1')";
                    
                    if (!empty($searchQuery)) {
                        $sql .= " AND (tiket.kode_unik_bank LIKE '%$searchQuery%' OR tiket.tiketID LIKE '%$searchQuery%' OR pengguna.nama LIKE '%$searchQuery%')";
                    }
                    
                    $sql .= " ORDER BY tiket.pembayaran ASC, tiket.valid ASC";
                    
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
                                    <td><img src='" . $row["bukti_pembayaran"] . "' alt='Bukti' style='width:100%; height:100%;'></td>
                                    <td class='actions-column'>
                                        <a href='../database/validasi.php?action=confirm&tiketID=" . $row["tiketID"] . "'><i class='fa-solid fa-check edit-icon'></i></a>
                                        <a href='../database/validasi.php?action=decline&tiketID=" . $row["tiketID"] . "'><i class='fa-solid fa-ban delete-icon'></i></a>
                                    </td>
                                    <td>";
                                    if ($row['valid'] == 1) {
                                        echo "Valid";
                                    } elseif ($row['valid'] == 2) {
                                        echo "Tidak valid";
                                    } else {
                                        echo "Belum Valid";
                                    }
                                    "</td>
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
