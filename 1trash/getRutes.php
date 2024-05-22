<?php
include 'database/koneksi.php';

// Query untuk mengambil data rute
$sql = 'SELECT ruteID, asal FROM rute';
$result = $conn->query($sql);

$rutes = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rutes[] = $row;
    }
}

$conn->close();

// Mengirim data dalam format JSON
header('Content-Type: application/json');
echo json_encode($rutes);
?>
