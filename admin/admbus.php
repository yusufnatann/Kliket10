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
                <a href="admtiket.php"><button class="addtiket">Kelola Tiket</button></a>
                <button class="addbus">Tambah Bus</button>
            </div>
        </div>
        <div class="table-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Bus</th>
                        <th>Kursi</th>
                        <th class="actions-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT * FROM bus";

                    if (!empty($search)) {
                        $sql .= " WHERE busid LIKE '%$search%' OR nama LIKE '%$search%' OR total_kursi LIKE '%$search%'";
                    }

                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["busid"] . "</td>";
                            echo "<td>" . $row["nama"] . "</td>";
                            echo "<td>" . $row["total_kursi"] . "</td>";
                            echo '<td class="actions-column">
                                    <a href="javascript:void(0);" class="edit-bus" data-id="'. $row["busid"].'" data-nama="'.$row["nama"].'" 
                                    data-kursi="'.$row["total_kursi"].'">
                                    <img src="../img/edit.png" class="edit-icon"></a>
                                    <a href="javascript:void(0);" onclick="confirmDelete('.$row["busid"].')"><img src="../img/hapus.png" class="delete-icon"></a>
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

    <!-- form edit bus -->
    <div id="editBusModal" class="modal">
        <div class="modal-content">
            <span class="close-edit-bus">&times;</span>
            <form id="editBusForm" action="../database/editbus.php" method="POST">
                <h2>Edit Bus</h2>
                <input type="hidden" id="edit_busid" name="busid">
                <label for="edit_nama_bus">Nama Bus:</label>
                <input type="text" id="edit_nama_bus" name="nama_bus" required>
                
                <label for="edit_kapasitas">Kapasitas:</label>
                <input type="number" id="edit_kapasitas" name="kapasitas" required>

                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <script>
        var busModal = document.getElementById("addBusModal");
        var busBtn = document.querySelector(".addbus");
        var busSpan = document.getElementsByClassName("close-bus")[0];

        var editBusModal = document.getElementById("editBusModal");
        var editBusSpan = document.getElementsByClassName("close-edit-bus")[0];

        busBtn.onclick = function() {
            busModal.style.display = "block";
        }

        busSpan.onclick = function() {
            busModal.style.display = "none";
        }

        editBusSpan.onclick = function() {
            editBusModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == busModal) {
                busModal.style.display = "none";
            } else if (event.target == editBusModal) {
                editBusModal.style.display = "none";
            }
        }

        document.querySelectorAll('.edit-bus').forEach(function(element) {
            element.onclick = function() {
                var busid = this.getAttribute('data-id');
                var nama = this.getAttribute('data-nama');
                var kursi = this.getAttribute('data-kursi');

                document.getElementById('edit_busid').value = busid;
                document.getElementById('edit_nama_bus').value = nama;
                document.getElementById('edit_kapasitas').value = kursi;

                editBusModal.style.display = "block";
            }
        });

        function confirmDelete(id) {
            var result = confirm("Anda yakin ingin menghapus bus ini?");
            if (result) {
                window.location.href = '../database/hapusbus.php?id=' + id;
            }
        }
    </script>
</body>
</html>