<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket</title>
    <link rel="stylesheet" href="../css/style(10).css">
    <link rel="stylesheet" href="../css/editform.css">
</head>
<body>
    <!-- Navbar + koneksi -->
    <?php
    include 'adminnavbar.php';
    ?>

    <!-- Main Content -->
    <div class="main-content">
        <nav>
            <div class="text">Data Petugas</div>
            <form class="search-form" action="#">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search">
                    <i class="fas fa-search"></i>
                </div>
            </form>
            <a href="admtambahpetugas.php" class="addpetugas">Tambah Petugas</a>
        </nav>
        <div class="table-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th class="actions-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT akun.userID,petugas.nama, petugas.email, akun.kata_sandi
                            FROM petugas
                            JOIN akun ON petugas.userid = akun.userid
                            WHERE akun.kategoriID = 2";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["nama"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>" . $row["kata_sandi"] . "</td>
                                    <td class='actions-column'>
                                        <a href='#' class='edit-btn' data-id='" . $row["userID"] . "' data-nama='" . $row["nama"] . "' data-email='" . $row["email"] . "' data-password='" . $row["kata_sandi"] . "'><img src='../img/edit.png' class='edit-icon'></a>
                                        <a href='#' class='delete-btn' data-id='" . $row["userID"] . "'><img src='../img/hapus.png' class='delete-icon'></a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data petugas</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Pop-up Form -->
    <div id="edit-popup" class="popup-form">
        <h3>Edit Petugas</h3>
        <form id="edit-form">
            <div class="form-group">
                <label for="edit-nama">Nama:</label>
                <input type="text" id="edit-nama" name="nama">
            </div>
            <div class="form-group">
                <label for="edit-email">Email:</label>
                <input type="email" id="edit-email" name="email">
            </div>
            <div class="form-group">
                <label for="edit-password">Password:</label>
                <input type="password" id="edit-password" name="password">
            </div>
            <input type="hidden" id="edit-id" name="id">
            <div class="form-actions">
                <button type="button" onclick="closeEditForm()">Cancel</button>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>

    <!-- Delete Pop-up Confirmation -->
    <div id="delete-popup" class="popup-form">
        <h3>Hapus Petugas</h3>
        <p>Apakah Anda yakin ingin menghapus petugas ini?</p>
        <input type="hidden" id="delete-id">
        <div class="form-actions">
            <button type="button" onclick="closeDeleteForm()">Cancel</button>
            <button type="button" onclick="confirmDelete()">Delete</button>
        </div>
    </div>

    <!-- Overlay -->
    <div id="popup-overlay" class="popup-overlay"></div>

</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editBtns = document.querySelectorAll(".edit-btn");
        const deleteBtns = document.querySelectorAll(".delete-btn");

        editBtns.forEach(btn => {
            btn.addEventListener("click", function(e) {
                e.preventDefault();
                openEditForm(btn.dataset);
            });
        });

        deleteBtns.forEach(btn => {
            btn.addEventListener("click", function(e) {
                e.preventDefault();
                openDeleteForm(btn.dataset.id);
            });
        });
    });

    function openEditForm(data) {
        document.getElementById("edit-nama").value = data.nama;
        document.getElementById("edit-email").value = data.email;
        document.getElementById("edit-password").value = data.password;
        document.getElementById("edit-id").value = data.id;

        document.getElementById("edit-popup").style.display = "block";
        document.getElementById("popup-overlay").style.display = "block";
    }

    function closeEditForm() {
        document.getElementById("edit-popup").style.display = "none";
        document.getElementById("popup-overlay").style.display = "none";
    }

    function openDeleteForm(id) {
        document.getElementById("delete-id").value = id;

        document.getElementById("delete-popup").style.display = "block";
        document.getElementById("popup-overlay").style.display = "block";
    }

    function closeDeleteForm() {
        document.getElementById("delete-popup").style.display = "none";
        document.getElementById("popup-overlay").style.display = "none";
    }

    function confirmDelete() {
        const id = document.getElementById("delete-id").value;
        fetch(`../database/deletepetugas.php?id=${id}`, {
            method: 'GET'
        }).then(response => response.text())
        .then(data => {
            if (data == "success") {
                window.location.reload();
            } else {
                alert("Gagal menghapus data: " + data);
            }
        });

        closeDeleteForm();
    }

    document.getElementById("edit-form").addEventListener("submit", function(e) {
        e.preventDefault();
        const id = document.getElementById("edit-id").value;
        const nama = document.getElementById("edit-nama").value;
        const email = document.getElementById("edit-email").value;
        const password = document.getElementById("edit-password").value;
        
        fetch(`../database/editpetugas.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}&nama=${nama}&email=${email}&password=${password}`
        }).then(response => response.text())
        .then(data => {
            if (data == "success") {
                window.location.reload();
            } else {
                alert("Gagal mengupdate data: " + data);
            }
        });

        closeEditForm();
    });
</script>