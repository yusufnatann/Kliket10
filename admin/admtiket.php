<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket</title>
    <link rel="stylesheet" href="../css/style(6).css">
    <link rel="stylesheet" href="../css/modal(1).css">
</head>
<body>
    <!-- Navbar + koneksi -->
    <?php
    include 'adminnavbar.php';
    
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    ?>

    <!-- Tabel tiket -->
    <div class="main-content">
        <div class="text">Kelola Tiket</div>
        <div class="nav-container">
            <form class="search-form" method="GET" action="admtiket.php">
                <div class="search-box">
                    <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>">
                    <i class="fas fa-search"></i>
                </div>
            </form>
            <div class="button-container">
                <button class="addbus">Tambah Bus</button>
                <button class="addtiket">Tambah Rute</button>
            </div>
        </div>
        <div class="table-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Terminal Asal</th>
                        <th>Terminal Tujuan</th>
                        <th>Tanggal Berangkat</th>
                        <th>Waktu Berangkat</th>
                        <th>Tipe Bis</th>
                        <th>Harga</th>
                        <th class="actions-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT r.ruteid AS ID, r.asal AS TerminalAsal, 
                            r.tujuan AS TerminalTujuan, r.tanggal_berangkat AS TanggalBerangkat, 
                            r.waktu_berangkat AS WaktuBerangkat, r.busID, b.nama AS Bus, r.harga AS Harga
                            FROM rute r
                            JOIN bus b ON r.busid = b.busid
                            ";

                    if (!empty($search)) {
                        $sql .= " WHERE r.ruteid LIKE '%$search%' OR r.asal LIKE '%$search%' OR r.tujuan LIKE '%$search%' OR b.nama LIKE '%$search%' OR r.tanggal_berangkat LIKE '%$search%' OR r.waktu_berangkat LIKE '%$search%' OR r.harga LIKE '%$search%'";
                    }

                    $sql .= " ORDER BY r.ruteid";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["ID"] . "</td>";
                            echo "<td>" . $row["TerminalAsal"] . "</td>";
                            echo "<td>" . $row["TerminalTujuan"] . "</td>";
                            echo "<td>" . $row["TanggalBerangkat"] . "</td>";
                            echo "<td>" . $row["WaktuBerangkat"] . "</td>";
                            echo "<td>" . $row["Bus"] . "</td>";
                            echo "<td>" . $row["Harga"] . "</td>";
                            echo '<td class="actions-column">
                                    <a href="javascript:void(0);" onclick="openEditModal(\'' . $row["ID"] . '\', \'' . $row["TerminalAsal"] . '\',
                                    \'' . $row["TerminalTujuan"] . '\', \'' . $row["TanggalBerangkat"] . '\', \'' . $row["WaktuBerangkat"] . '\',
                                    \'' . $row["busID"] . '\', \'' . $row["Harga"] . '\')">
                                    <img src="../img/edit.png" class="edit-icon"></a>
                                    <a href="javascript:void(0);" onclick="confirmDelete(' . $row["ID"] . ')"><img src="../img/hapus.png" class="delete-icon"></a>
                                  </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form tambah rute -->
    <div id="addRuteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="addRuteForm" action="../database/tambahtiket.php" method="POST">
                <h2>Tambah Rute Baru</h2>
                <label for="asal">Terminal Asal:</label>
                <select id="asal" name="asal" required>
                    <?php
                    $terminalSql = "SELECT nama FROM terminal ORDER BY nama ASC";
                    $terminalResult = $conn->query($terminalSql);
                    while ($terminalRow = $terminalResult->fetch_assoc()) {
                        echo "<option value='".$terminalRow['nama']."'>".$terminalRow['nama']."</option>";
                    }
                    ?>
                </select>

                <label for="tujuan">Terminal Tujuan:</label>
                <select id="tujuan" name="tujuan" required>
                    <?php
                    $terminalSql = "SELECT nama FROM terminal ORDER BY nama ASC";
                    $terminalResult = $conn->query($terminalSql);
                    while ($terminalRow = $terminalResult->fetch_assoc()) {
                        echo "<option value='".$terminalRow['nama']."'>".$terminalRow['nama']."</option>";
                    }
                    ?>
                </select>

                <label for="waktu_berangkat">Waktu Berangkat:</label>
                <div class="radio-container">
                    <input type="radio" id="waktu_berangkat_0800" name="waktu_berangkat" value="08:00" required>
                    <label for="waktu_berangkat_0800">08.00</label>

                    <input type="radio" id="waktu_berangkat_1100" name="waktu_berangkat" value="11:00" required>
                    <label for="waktu_berangkat_1100">11.00</label>

                    <input type="radio" id="waktu_berangkat_1500" name="waktu_berangkat" value="15:00" required>
                    <label for="waktu_berangkat_1500">15.00</label>
                </div>

                <label for="tanggal_berangkat">Tanggal Berangkat:</label>
                <input type="date" id="tanggal_berangkat" name="tanggal_berangkat" required>

                <label for="busID">Tipe Bus:</label>
                <select id="busID" name="busID" required>
                    <?php
                    $busSql = "SELECT busid, nama FROM bus ORDER BY nama ASC";
                    $busResult = $conn->query($busSql);
                    while ($busRow = $busResult->fetch_assoc()) {
                        echo "<option value='".$busRow['busid']."'>".$busRow['nama']."</option>";
                    }
                    ?>
                </select>

                <label for="harga">Harga:</label>
                <input type="number" id="harga" name="harga" required>

                <button type="submit">Tambah Rute</button>
            </form>
        </div>
    </div>

    <!-- form edit rute -->
    <div id="editRuteModal" class="modal">
        <div class="modal-content">
            <span class="close-edit">&times;</span>
            <form id="editRuteForm" action="../database/edittiket.php" method="POST">
                <h2>Edit Rute</h2>
                <input type="hidden" id="edit_ruteid" name="ruteid">

                <label for="edit_asal">Terminal Asal:</label>
                <select id="edit_asal" name="asal" required>
                    <?php
                    $terminalSql = "SELECT nama FROM terminal ORDER BY nama ASC";
                    $terminalResult = $conn->query($terminalSql);
                    while ($terminalRow = $terminalResult->fetch_assoc()) {
                        echo "<option value='".$terminalRow['nama']."'>".$terminalRow['nama']."</option>";
                    }
                    ?>
                </select>

                <label for="edit_tujuan">Terminal Tujuan:</label>
                <select id="edit_tujuan" name="tujuan" required>
                    <?php
                    $terminalSql = "SELECT nama FROM terminal ORDER BY nama ASC";
                    $terminalResult = $conn->query($terminalSql);
                    while ($terminalRow = $terminalResult->fetch_assoc()) {
                        echo "<option value='".$terminalRow['nama']."'>".$terminalRow['nama']."</option>";
                    }
                    ?>
                </select>

                <label for="edit_waktu_berangkat">Waktu Berangkat:</label>
                <div class="radio-container">
                    <input type="radio" id="edit_waktu_berangkat_0800" name="waktu_berangkat" value="08:00" required>
                    <label for="edit_waktu_berangkat_0800">08.00</label>

                    <input type="radio" id="edit_waktu_berangkat_1100" name="waktu_berangkat" value="11:00" required>
                    <label for="edit_waktu_berangkat_1100">11.00</label>

                    <input type="radio" id="edit_waktu_berangkat_1500" name="waktu_berangkat" value="15:00" required>
                    <label for="edit_waktu_berangkat_1500">15.00</label>
                </div>
                
                <label for="edit_tanggal_berangkat">Tanggal Berangkat:</label>
                <input type="date" id="edit_tanggal_berangkat" name="tanggal_berangkat" required>

                <label for="edit_busID">Tipe Bus:</label>
                <select id="edit_busID" name="busID" required>
                    <?php
                    $busSql = "SELECT busid, nama FROM bus ORDER BY nama ASC";
                    $busResult = $conn->query($busSql);
                    while ($busRow = $busResult->fetch_assoc()) {
                        echo "<option value='".$busRow['busid']."'>".$busRow['nama']."</option>";
                    }
                    ?>
                </select>

                <label for="edit_harga">Harga:</label>
                <input type="number" id="edit_harga" name="harga" required>

                <button type="submit">Update Rute</button>
            </form>
        </div>
    </div>

    <!-- form tambah bus -->
    <div id="addBusModal" class="modal">
        <div class="modal-content">
            <span class="close-bus">&times;</span>
            <form id="addBusForm" action="../database/tambahbus.php" method="POST">
                <h2>Tambah Bus Baru</h2>
                <label for="nama_bus">Nama Bus:</label>
                <input type="text" id="nama_bus" name="nama_bus" required>

                <label for="kapasitas">Kapasitas:</label>
                <input type="number" id="kapasitas" name="kapasitas" required>

                <button type="submit">Tambah Bus</button>
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById("addRuteModal");
        var btn = document.querySelector(".addtiket");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        var busModal = document.getElementById("addBusModal");
        var busBtn = document.querySelector(".addbus");
        var busSpan = document.getElementsByClassName("close-bus")[0];

        busBtn.onclick = function() {
            busModal.style.display = "block";
        }

        busSpan.onclick = function() {
            busModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == busModal) {
                busModal.style.display = "none";
            }
        }

        var editModal = document.getElementById("editRuteModal");
        var editSpan = document.getElementsByClassName("close-edit")[0];

        function openEditModal(id, asal, tujuan, tanggal, waktu, bus, harga) {
            document.getElementById('edit_ruteid').value = id;
            document.getElementById('edit_asal').value = asal;
            document.getElementById('edit_tujuan').value = tujuan;
            document.getElementById('edit_tanggal_berangkat').value = tanggal;
            if (waktu === "08:00") {
                document.getElementById('edit_waktu_berangkat_0800').checked = true;
            } else if (waktu === "11:00") {
                document.getElementById('edit_waktu_berangkat_1100').checked = true;
            } else if (waktu === "15:00") {
                document.getElementById('edit_waktu_berangkat_1500').checked = true;
            }
            document.getElementById('edit_busID').value = bus;
            document.getElementById('edit_harga').value = harga;
            editModal.style.display = "block";
        }

        editSpan.onclick = function() {
            editModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == editModal) {
                editModal.style.display = "none";
            }
        }

        function confirmDelete(id) {
            var result = confirm("Anda yakin ingin menghapus tiket ini?");
            if (result) {
                window.location.href = '../database/hapustiket.php?id=' + id;
            }
        }
    </script>
</body>
</html>