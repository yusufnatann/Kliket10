<?php
include 'database/koneksi.php';

$sql = "SELECT r.ruteID, r.asal, r.tujuan, r.waktu_berangkat, r.tanggal_berangkat, 
               b.total_kursi - COALESCE(COUNT(t.pembayaran), 0) AS sisa_kapasitas
        FROM rute r
        LEFT JOIN tiket t ON r.ruteID = t.ruteID AND t.pembayaran = 1
        LEFT JOIN bus b ON r.ruteID = b.ruteID
        GROUP BY r.ruteID, r.asal, r.tujuan, r.waktu_berangkat, r.tanggal_berangkat, b.total_kursi";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $no = 1;
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $no . "</td>
                <td>" . $row["asal"] . "</td>
                <td>" . $row["tujuan"] . "</td>
                <td>" . $row["waktu_berangkat"] . "</td>
                <td>" . $row["tanggal_berangkat"] . "</td>
                <td>" . $row["sisa_kapasitas"] . "</td>
                <td><button type='button' onclick='pesanTiket(" . $row["ruteID"] . ")'>Pesan</button></td>
              </tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='7'>Mohon maaf tiket habis</td></tr>";
}
?>
<script>
function pesanTiket(ruteID) {
    fetch('database/pesan_tiket.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'ruteID=' + ruteID
    })
    .then(response => response.text())
    .then(tiketID => {
        if (tiketID) {
            window.location.href = "pembayaran.php?ruteID=" + ruteID + "&tiketID=" + tiketID;
        } else {
            alert('Gagal memesan tiket.');
        }
    });
}
</script>