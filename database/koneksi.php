<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$host = "localhost";
$user = "root";
$password = "";
$database = "kliket_satu";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>