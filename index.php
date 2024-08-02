<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Datepicker CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="styles.css">

    <title>MitraSinerji</title>
</head>
<body>

<!-- Navbar Judul -->
    <nav class="navbar bg-body-tertiary navbar-custom">
        <div class="container-fluid d-flex flex-column align-items-center">
            <span class="navbar-brand h1">Test Programming</span>
            <span class="navbar-brand h1">PT.Mitra Sinerji Teknoindo</span>
        </div>
    </nav>

    
    <!-- Tampilan Table Transaksi -->
    <div class="container container-custom">
        <div class="border-container">
            <h2 class="mb-4">Daftar Transaksi</h2>
            <div class="d-flex justify-content-end mb-2">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Cari" aria-label="Search" style="width: 200px;">
                    <button class="btn btn-outline-success" type="submit">Cari</button>    
                </form>
            </div>
            <table class="table table-bordered border-primary">
                <thead class="table-info">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Transaksi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Ongkir</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>001</td>
                        <td>2024-08-01</td>
                        <td>Mark</td>
                        <td>5</td>
                        <td>Rp 500.000</td>
                        <td>Rp 50.000</td>
                        <td>Rp 20.000</td>
                        <td>Rp 470.000</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>002</td>
                        <td>2024-08-02</td>
                        <td>Jacob</td>
                        <td>3</td>
                        <td>Rp 300.000</td>
                        <td>Rp 30.000</td>
                        <td>Rp 15.000</td>
                        <td>Rp 285.000</td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td colspan="7" class="text-end">Grand Total</td>
                        <td>Rp 755.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- akhir daftar transaksi -->

    <!-- form input -->
    <div class="container container-custom">
        <div class="border-container">
            <h2 class="mb-4">Form Input</h2>
            <div class="mb-1 row">
                <label for="transaksi" class="col-sm-2 col-form-label">Transaksi</label>
                <div class="col-sm-10">
                </div>
            </div>
            <div class="mb-1 row align-items-center">
                <label for="no" class="col-sm-2 col-form-label">No</label>
                <div class="col-sm-10 d-flex align-items-center">
                    <input type="text" class="form-control short-label me-2" id="no" readonly>
                    <button type="button" class="btn btn-primary" onclick="generateTransactionNo()">Generate Nomor</button>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="datepicker" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control short-label" id="datepicker">
                </div>
            </div>
            <div class="mb-1 row">
                <label for="Customer" class="col-sm-2 col-form-label">Customer</label>
                <div class="col-sm-10">
                </div>
            </div>
            <div class="mb-1 row align-items-center">
            <label for="no" class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10 d-flex align-items-center">
                <input type="text" class="form-control short-label me-2" id="no" readonly>
                <button type="button" id="openPopup" class=" btn btn-primary col-sm-2 col-form-label">Kode</button>
                    <div id="customerPopup" class="popup">
                        <div class="popup-content">
                            <span class="close" id="closePopup">&times;</span>
                            <h2>Pilih Customer</h2>
                            <form id="customerForm">
                                <select name="customer" id="customerSelect">
                                    <?php
                                    // Ambil data pelanggan dari database
                                    $conn = new mysqli('localhost', 'root', 'AnginTornado', 'mitrasinerji');
                                    if ($conn->connect_error) {
                                        die("Koneksi gagal: " . $conn->connect_error);
                                    }
                                    $sql = "SELECT id, kode, nama, telp FROM customers";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                                <button type="submit">Pilih</button>
                            </form>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="mb-1 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" class="form-control short-label" id="nama">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                <input type="text" class="form-control short-label" id="telepon">
                </div>
            </div>
            <table class="table table-bordered border-primary">
                <thead class="table-info">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Transaksi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Ongkir</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>001</td>
                        <td>2024-08-01</td>
                        <td>Mark</td>
                        <td>5</td>
                        <td>Rp 500.000</td>
                        <td>Rp 50.000</td>
                        <td>Rp 20.000</td>
                        <td>Rp 470.000</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>002</td>
                        <td>2024-08-02</td>
                        <td>Jacob</td>
                        <td>3</td>
                        <td>Rp 300.000</td>
                        <td>Rp 30.000</td>
                        <td>Rp 15.000</td>
                        <td>Rp 285.000</td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td colspan="7" class="text-end">Grand Total</td>
                        <td>Rp 755.000</td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                <button type="button" class="btn btn-success me-2">Simpan</button>
                <button type="button" class="btn btn-warning">Batal</button>
            </div>
        </div>
    </div>

    <!-- akhir input -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
    <!-- jQuery (required by Bootstrap Datepicker) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Datepicker JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
 
    <!-- buat selalupaling bawah sebelum /body agar fungsi js bisa runing -->
    <script src="script.js"></script>

</body>
</html>