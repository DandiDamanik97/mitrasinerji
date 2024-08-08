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
                <form class="d-flex" role="search" onsubmit="handleSearch(event)">
                    <input id="searchInput" class="form-control me-2" type="search" placeholder="Cari" aria-label="Search" style="width: 200px;">
                    <button class="btn btn-outline-success" type="submit">Cari</button>
                </form>
                <div id="hasilPencarian" class="mt-3"></div>
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
                <tbody id="tabelBody">
                <?php
                    include 'koneksi.php'; //include koneksi
                    $no = 1;
                    $sqlTransaksi = mysqli_query($conn, " SELECT * FROM transaksi ORDER BY no_transaksi ASC");
                    while ($data=mysqli_fetch_array($sqlTransaksi)) {
                        echo "<tr>
                            <td class ='text-center'>$no</td>
                            <td>$data[no_transaksi]</td>
                            <td>$data[tanggal]</td>
                            <td>$data[nama_customer]</td>
                            <td>$data[jumlah_barang]</td>
                            <td>$data[sub_total]</td>
                            <td>$data[diskon]</td>
                            <td>$data[ongkir]</td>
                            <td>$data[total]</td>
                        </tr>";
                        $no++;
                    }
                    $conn->close(); // Menutup koneksi setelah selesai
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- akhir daftar transaksi -->

    
    <!-- form input -->
    <form action="simpan.php" id="form-input" method="post" autocomplete="off">
        <div class="container container-custom">
            <div class="border-container">
                <h2 class="mb-4">Form Input</h2>
                <div class="mb-1 row">
                    <label for="transaksi" class="col-sm-2 col-form-label">Transaksi</label>
                    <!-- <div class="col-sm-10">
                    </div> -->
                </div>                
                    <div class="mb-1 row align-items-center">
                        <label for="no" class="col-sm-2 col-form-label">No</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <input type="text" class="form-control short-label me-2" id="no_transaksi" name="no_transaksi" readonly>
                            <button type="button" class="btn btn-primary" onclick="generateTransactionNo()">Generate Nomor</button>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control short-label" id="tanggal" name="tanggal">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="Customer" class="col-sm-2 col-form-label">Customer</label>
                        <div class="col-sm-10">
                        </div>
                    </div>
                    <div class="mb-1 row align-items-center">
                    <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-10 d-flex align-items-center">
                        <input type="text" class="form-control short-label me-2" id="kode" readonly>
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
                                                echo "<option value='" . $row['id'] ."' data-nama='" . $row['nama'] . "' data-telp='" . $row['telp'] . "' data-kode='" . $row['kode'] . "'>" . $row['nama'] . "</option>";
                                            }
                                            $conn->close();
                                            ?>
                                        </select>
                                        <button type="button" class="btn btn-primary mt-2" id="selectCustomer">Pilih</button>
                                    </form>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="mb-1 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control short-label" id="nama" name="nama_customer">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control short-label" id="telepon">
                        </div>
                    </div>           
                    <div class="container">
                        <table class="table main-table table-bordered border-primary">
                            <thead class="table-info">
                                <tr>
                                    <!-- Tombol di HTML -->
                                    <th scope="col">
                                    <button type="button" id="bukaPopup" class=" btn btn-primary col-sm-20 col-form-label">Tambah</button>
                                    </th>
                                                        
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Harga Bandrol</th>
                                    <th scope="col" colspan="2">Diskon</th>
                                    <th scope="col">Harga Diskon</th>
                                    <th scope="col">Total</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th scope="col">%</th>
                                    <th scope="col">RP</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody id="list-form-input">
                            
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4" class="text-end">Jumlah Barang:</td>
                                <td><input type="number" id="jumlah_barang" name="jumlah_barang" style="width: 70px;" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="9" class="text-end">Subtotal:</td>
                                <td><input type="number" id="subTotal" name="sub_total" style="width: 120px;" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="9" class="text-end">Diskon:</td>
                                <td><input type="number" id="diskon" name="diskon" oninput="hitungTotalBayar()" style="width: 120px;"></td>
                            </tr>
                            <tr>
                                <td colspan="9" class="text-end">Ongkir:</td>
                                <td><input type="number" id="ongkir" name="ongkir" oninput="hitungTotalBayar()" style="width: 120px;"></td>
                            </tr>
                            <tr>
                                <td colspan="9" class="text-end">Total Bayar:</td>
                                <td><input type="number" id="totalBayar" name="total" style="width: 120px;" readonly></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Popup untuk Pemilihan Barang -->
                    <div id="barangPopup" class="popup">
                        <div class="popup-content">
                            <span class="close" id="closePopup">&times;</span>
                            <h2>Pilih Barang</h2>
                            <form id="barangForm">
                                <select name="barang" id="barangSelect">
                                    <?php
                                        // Ambil data barang dari database
                                        $conn = new mysqli('localhost', 'root', 'AnginTornado', 'mitrasinerji');
                                        if ($conn->connect_error) {
                                            die("Koneksi gagal: " . $conn->connect_error);
                                        }
                                        $sql = "SELECT id, kode, nama, harga FROM barangs";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "' data-nama='" . $row['nama'] . "' data-harga='" . $row['harga'] . "' data-kode='" . $row['kode'] . "'>" . $row['nama'] . "</option>";
                                        }
                                        $conn->close();
                                    ?>
                                </select>
                                <button type="button" class="btn btn-primary mt-2" id="selectBarang">Pilih</button>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <input class="btn btn-success me-2" type="submit" name="simpan" value="Simpan" />
                        <input class="btn btn-warning me-2" type="submit" value="Batal" />
                    </div>
            </div>
        </div>
    </form>
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