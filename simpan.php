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

     //Validasi data
     $errors = [];
     if (empty($no_transaksi)) {
         $errors[] = 'No Transaksi tidak boleh kosong.';
     }
     if (empty($tanggal)) {
         $errors[] = 'Tanggal tidak boleh kosong.';
     }
     if (empty($nama_customer)) {
         $errors[] = 'Nama Customer tidak boleh kosong.';
     }
     if (empty($jumlah_barang)) {
         $errors[] = 'Jumlah Barang tidak boleh kosong.';
     }
     if (empty($sub_total)) {
         $errors[] = 'Sub Total tidak boleh kosong.';
     }
     if (empty($diskon)) {
         $errors[] = 'Diskon tidak boleh kosong.';
     }
     if (empty($ongkir)) {
         $errors[] = 'Ongkir tidak boleh kosong.';
     }
     if (empty($total)) {
         $errors[] = 'Total tidak boleh kosong.';
     }
 
     // Jika ada error, tampilkan pesan dan hentikan eksekusi
     if (!empty($errors)) {
         echo implode('<br>', $errors);
         exit;
     }

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