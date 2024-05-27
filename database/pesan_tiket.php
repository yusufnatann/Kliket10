<?php
include 'koneksi.php';

if (!isset($_SESSION['userID'])) {
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ruteID = $_POST['ruteID'];
    $userID = $_SESSION['userID']; 

    $sql = "INSERT INTO tiket (ruteID, userID, pembayaran) VALUES ('$ruteID', '$userID', 0)";

    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
