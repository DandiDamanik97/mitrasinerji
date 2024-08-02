<?php
$servername = "localhost"; // atau nama host database Anda
$username = "root"; // ganti dengan username database Anda
$password = "AnginTornado"; // ganti dengan password database Anda
$dbname = "mitrasinerji"; // ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
echo "Koneksi berhasil";
$conn->close();
?>