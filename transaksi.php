<?php
$servername = "localhost";
$username = "root";
$password = "AnginTornado";
$dbname = "mitrasinerji";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengenerate nomor transaksi otomatis
function generateTransactionNo($conn) {
    $date = new DateTime();
    $year = $date->format('y'); // Tahun 2 digit
    $month = $date->format('m'); // Bulan
    $day = $date->format('d'); // Hari

    // Query untuk mendapatkan nomor urut terakhir
    $sql = "SELECT MAX(no_transaksi) AS last_no FROM transaksi WHERE no_transaksi LIKE '$year$month$day%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_no = $row['last_no'];
        if ($last_no) {
            $last_num = intval(substr($last_no, -4)) + 1;
        } else {
            $last_num = 1;
        }
    } else {
        $last_num = 1;
    }

    // Format nomor transaksi
    $no_transaksi = sprintf("%s%s%s-%04d", $year, $month, $day, $last_num);

    return $no_transaksi;
}

// Mengenerate nomor transaksi
$no_transaksi = generateTransactionNo($conn);

// Menyimpan nomor transaksi ke database
$sql = "INSERT INTO transaksi (no_transaksi) VALUES ('$no_transaksi')";

if ($conn->query($sql) === TRUE) {
    echo "Nomor transaksi berhasil di-generate: " . $no_transaksi;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
