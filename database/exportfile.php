<?php
include 'koneksi.php';

$type = $_GET['type'];

$query = $conn->query("
    SELECT t.tiketID, p.nama, r.asal, r.tujuan, r.harga, t.kode_unik_bank
    FROM tiket t
    JOIN pengguna p ON t.userID = p.userID
    JOIN rute r ON t.ruteID = r.ruteID
    WHERE t.valid = 1
");

$total_query = $conn->query("
    SELECT SUM(r.harga) AS total_penjualan
    FROM tiket t
    JOIN rute r ON t.ruteID = r.ruteID
    WHERE t.valid = 1
");

$total_penjualan = $total_query->fetch_assoc()['total_penjualan'];

$data = [];
while ($row = $query->fetch_assoc()) {
    $data[] = $row;
}

if ($type == 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="tickets.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, array('No', 'Nama Pengguna', 'Terminal Asal', 'Terminal Tujuan', 'ID Tiket', 'Kode Unik Bank', 'Harga'));

    $no = 1;
    foreach ($data as $row) {
        fputcsv($output, array($no++, $row['nama'], $row['asal'], $row['tujuan'], $row['tiketID'], $row['kode_unik_bank'], $row['harga']));
    }
    fputcsv($output, array('', '', '', '', '', 'Total Penjualan', $total_penjualan));

    fclose($output);
    exit();
}
?>