<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "AnginTornado";
$dbname = "mitrasinerji";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// Mendapatkan nomor transaksi dari permintaan AJAX
$no_transaksi = $_GET['no_transaksi'];

// Mempersiapkan dan menjalankan query
$sql = "SELECT * FROM transaksi WHERE no_transaksi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $no_transaksi);
$stmt->execute();
$result = $stmt->get_result();

// Mengambil hasil query
$data = $result->fetch_assoc();
echo json_encode($data);

// Menutup koneksi
$stmt->close();
$conn->close();
?>