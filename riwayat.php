<?php
include 'database/koneksi.php';
include 'database/auth.php';

$tiketQuery = "SELECT t.tiketID, t.pembayaran, t.valid, r.asal, r.tujuan, r.waktu_berangkat, r.tanggal_berangkat 
                FROM tiket t 
                JOIN rute r ON t.ruteID = r.ruteID 
                WHERE t.userID = ?";
$stmt = $conn->prepare($tiketQuery);
$stmt->bind_param('i', $userID);
$stmt->execute();
$tiketResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tiket</title>
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tabel.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/f1396b40aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'navbar.php';
    ?>

    <div class="cons">
    <img src="img/background_pesan.png" class="bg_pesan">
    <div class="boxs">
        <div class="boxxs">
            <h1 class="pesan-title">Daftar Tiket Saya</h1>
            <p class="pesan-sub">Ayo bayar tiket sekarang!</p>
        </div>
        <!-- Tabel disini -->
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Terminal Asal</th>
                        <th>Terminal Tujuan</th>
                        <th>Waktu Berangkat</th>
                        <th>Tanggal Berangkat</th>
                        <th>Status Pembayaran</th>
                        <th>Status Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($tiketResult->num_rows > 0) {
                        $no = 1;
                        while ($row = $tiketResult->fetch_assoc()) {
                            echo "<tr class='" . ($row['valid'] == 1 ? "valid-ticket" : "") . "' data-tiketid='{$row['tiketID']}'>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['asal'] . "</td>";
                            echo "<td>" . $row['tujuan'] . "</td>";
                            echo "<td>" . $row['waktu_berangkat'] . "</td>";
                            echo "<td>" . $row['tanggal_berangkat'] . "</td>";
                            echo "<td>";
                            if ($row['pembayaran'] == 1) {
                                echo "Sudah Bayar";
                            } elseif ($row['pembayaran'] == 2) {
                                echo "Batal";
                            } else {
                                echo "Belum Dibayar";
                            }
                            echo "</td>";
                            echo "<td>";
                            if ($row['valid'] == 1) {
                                echo "Valid";
                            } else {
                                echo "Belum Valid";
                            }
                            echo "</td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='7'>Tidak ada riwayat tiket.</td></tr>";
                    }
                    $stmt->close();
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="ticketDetailsModal" tabindex="-1" aria-labelledby="ticketDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticketDetailsModalLabel">Detail Tiket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- showdetail.php -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    function showTicketDetails(tiketID) {
        $.ajax({
            url: 'database/showdetail.php',
            type: 'GET',
            data: { tiketID: tiketID },
            success: function(data) {
                $('#ticketDetailsModal .modal-body').html(data);
                $('#ticketDetailsModal').modal('show');
            }
        });
    }

    $(document).ready(function() {
        $('.valid-ticket').click(function() {
            var tiketID = $(this).data('tiketid');
            showTicketDetails(tiketID);
        });
    });
</script>