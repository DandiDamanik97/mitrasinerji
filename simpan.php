<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "AnginTornado";
$dbname = "mitrasinerji";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah kunci ada di $_POST
    $no_transaksi = isset($_POST['no_transaksi']) ? $_POST['no_transaksi'] : '';
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
    $nama_customer = isset($_POST['nama_customer']) ? $_POST['nama_customer'] : '';
    $jumlah_barang = isset($_POST['jumlah_barang']) ? $_POST['jumlah_barang'] : '';
    $sub_total = isset($_POST['sub_total']) ? $_POST['sub_total'] : '';
    $diskon = isset($_POST['diskon']) ? $_POST['diskon'] : '';
    $ongkir = isset($_POST['ongkir']) ? $_POST['ongkir'] : '';
    $total = isset($_POST['total']) ? $_POST['total'] : '';

    // Query untuk menyimpan data
    $sql = "INSERT INTO transaksi (no_transaksi, tanggal, nama_customer, jumlah_barang, sub_total, diskon, ongkir, total) VALUES ('$no_transaksi', '$tanggal', '$nama_customer', '$jumlah_barang', '$sub_total', '$diskon', '$ongkir', '$total')";

    if ($conn->query($sql) === TRUE) {
        // Data berhasil disimpan, arahkan ke index.php
        header("Location: index.php");
        exit(); // Pastikan untuk menghentikan eksekusi script setelah redirect
    } else {
        // Tampilkan pesan error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>