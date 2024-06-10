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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tabel.css">
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/detail.css">
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
            <table border="0" class= styled-table>
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
                            } elseif ($row['valid'] == 2) {
                                echo "Tidak valid";
                            } elseif ($row['valid'] == 2 || $row['pembayaran'] == 2) {
                                echo "Tidak valid";
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

    <div class="ticket" style="display:none;">
        <img src="img/img8.jpeg" alt="Travel Image">
        <div class="ticket-info">
            <h1>E Tiket</h1>
            <div id="ticket-details">
                <!-- showdetail.php -->
            </div>
        </div>
        <button class="close-button" onclick="closeTicketDetails()">Tutup</button>
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
                $('#ticket-details').html(data);
                $('.ticket').show();
            }
        });
    }

    function closeTicketDetails() {
        $('.ticket').hide();
    }

    $(document).ready(function() {
        $('.valid-ticket').click(function() {
            var tiketID = $(this).data('tiketid');
            showTicketDetails(tiketID);
        });
    });
</script>