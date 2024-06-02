<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket</title>
    <link rel="stylesheet" href="../css/style(12).css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'adminnavbar.php';

    $limit = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $limit) - $limit : 0;
    
    $result = $conn->query("SELECT COUNT(*) AS total FROM tiket WHERE valid = 1");
    $total = $result->fetch_assoc()['total'];
    $pages = ceil($total / $limit);
    
    $query = $conn->query("
        SELECT t.tiketID, p.nama, r.asal, r.tujuan, r.harga, t.kode_unik_bank
        FROM tiket t
        JOIN pengguna p ON t.userID = p.userID
        JOIN rute r ON t.ruteID = r.ruteID
        WHERE t.valid = 1
        LIMIT $start, $limit
    ");

    $total_query = $conn->query("
        SELECT SUM(r.harga) AS total_penjualan
        FROM tiket t
        JOIN rute r ON t.ruteID = r.ruteID
        WHERE t.valid = 1
    ");
    $total_penjualan = $total_query->fetch_assoc()['total_penjualan'];
    ?>

    <!-- Tabel tiket -->
    <div class="main-content">
        <nav>
            <div class="text">Data Penjualan</div>
            <form class="search-form" method="GET" action="admpenjualan.php">
                <div class="search-box">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                    <i class="fas fa-search"></i>
                </div>
            </form>
            <div class="dropdown">
                <a href="../database/exportfile.php?type=csv" class="dropbtn">Download</a>
            </div>
        </nav>
        <div class="table-container">
            <div class="total-container">
                Total Penjualan : <span>Rp <?php echo number_format($total_penjualan, 0, ',', '.'); ?></span>
            </div>
            <table class="order-table" id="ticketTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengguna</th>
                        <th>Terminal Asal</th>
                        <th>Terminal Tujuan</th>
                        <th>ID Tiket</th>
                        <th>Kode Unik Bank</td>
                        <th>Harga</th>
                        <th style=display:none>Status Valid</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = $start + 1;
                    while ($row = $query->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['asal']; ?></td>
                            <td><?php echo $row['tujuan']; ?></td>
                            <td><?php echo $row['tiketID']; ?></td>
                            <td><?php echo $row['kode_unik_bank']; ?></td>
                            <td><?php echo $row['harga']; ?></td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                <?php if ($page < $pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>