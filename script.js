function generateTransactionNo() {
  // Mendapatkan tanggal saat ini
  const date = new Date();
  const year = date.getFullYear().toString().slice(-2); // Tahun 2 digit
  const month = ("0" + (date.getMonth() + 1)).slice(-2); // Bulan
  const day = ("0" + date.getDate()).slice(-2); // Hari
  const randomNum = Math.floor(1000 + Math.random() * 9000); // Nomor acak 4 digit

  // Format nomor transaksi
  const transactionNo = `${year}${month}${day}-${randomNum}`;

  // Menetapkan nomor transaksi ke input field
  document.getElementById("no_transaksi").value = transactionNo;
}

$(document).ready(function () {
  $("#tanggal").datepicker({
    format: "yyyy-mm-dd", // Format tanggal
    autoclose: true, // Menutup datepicker setelah memilih tanggal
  });
});

// JavaScript untuk menangani pop-up customer
document.getElementById("openPopup").addEventListener("click", function () {
  document.getElementById("customerPopup").style.display = "flex";
});

document.getElementById("closePopup").addEventListener("click", function () {
  document.getElementById("customerPopup").style.display = "none";
});

// Menutup popup jika klik di luar area popup customer
window.addEventListener("click", function (event) {
  if (event.target === customerPopup) {
    customerPopup.style.display = "none";
  }
});

// JavaScript untuk mengisi kolom nama dan telepon berdasarkan pilihan customer
document.getElementById("selectCustomer").addEventListener("click", function () {
  var selectedOption = document.getElementById("customerSelect").options[document.getElementById("customerSelect").selectedIndex];
  var kode = selectedOption.getAttribute("data-kode");
  var nama = selectedOption.getAttribute("data-nama");
  var telp = selectedOption.getAttribute("data-telp");

  document.getElementById("nama").value = nama;
  document.getElementById("telepon").value = telp;
  document.getElementById("kode").value = kode;

  document.getElementById("customerPopup").style.display = "none"; // Menutup pop-up setelah memilih customer
});

// Mendapatkan elemen popup dan tombol
var barangPopup = document.getElementById("barangPopup");
var bukaPopup = document.getElementById("bukaPopup");
var closePopup = document.getElementById("closePopup");

// Menampilkan popup
bukaPopup.addEventListener("click", function () {
  barangPopup.style.display = "flex";
  console.log("Popup dibuka");
});

// Menutup popup dengan tombol close
closePopup.addEventListener("click", function () {
  barangPopup.style.display = "none";
  console.log("Popup ditutup dengan tombol close");
});

// Menutup popup jika klik di luar area popup
window.addEventListener("click", function (event) {
  if (barangPopup.style.display === "flex" && !barangPopup.contains(event.target) && !bukaPopup.contains(event.target)) {
    barangPopup.style.display = "none";
    console.log("Popup ditutup karena klik di luar area popup");
  }
});

//tambah barang
document.getElementById("selectBarang").addEventListener("click", function () {
  const selectedOption = document.getElementById("barangSelect").selectedOptions[0];
  const kodeBarang = selectedOption.getAttribute("data-kode");
  const namaBarang = selectedOption.getAttribute("data-nama");
  const hargaBandrol = selectedOption.getAttribute("data-harga");

  const tbody = document.getElementById("list-form-input");
  const rowCount = tbody.rows.length + 1;

  const row = document.createElement("tr");

  row.innerHTML = `
            <td class='text-center'>
                <a href="#" class="btn btn-danger btn-sm hapus">Hapus</a>
            </td>
            <td>${rowCount}</td>
            <td><input type="text" value="${kodeBarang}" readonly style="width: 60px;"></td>
            <td><input type="text" value="${namaBarang}" readonly style="width: 100px;"></td>
            <td><input type="number" class="qty" oninput="hitungTotal(this)" style="width: 70px;"></td>
            <td><input type="number" value="${hargaBandrol}" readonly style="width: 100px;"></td>
            <td><input type="number" class="diskonPersen" oninput="hitungTotal(this)" style="width: 50px;"></td>
            <td><input type="number" class="diskonRp" readonly style="width: 120px;"></td>
            <td><input type="number" class="hargaDiskon" readonly style="width: 120px;"></td>
            <td><input type="number" class="totalHarga" readonly style="width: 120px;"></td>
        `;
  tbody.appendChild(row);

  document.getElementById("barangPopup").style.display = "none";

  hitungSubTotal();
});

//fungsi perhitungan total
function hitungTotal(element) {
  const row = element.closest("tr");
  const qty = row.querySelector(".qty").value;
  const hargaBandrol = row.querySelector("td:nth-child(6) input").value;
  const diskonPersen = row.querySelector(".diskonPersen").value;

  const diskonRp = (hargaBandrol * diskonPersen) / 100;
  const hargaDiskon = hargaBandrol - diskonRp;
  const totalHarga = hargaDiskon * qty;

  row.querySelector(".diskonRp").value = diskonRp.toFixed(2);
  row.querySelector(".hargaDiskon").value = hargaDiskon.toFixed(2);
  row.querySelector(".totalHarga").value = totalHarga.toFixed(2);

  hitungSubTotal();
}

//fungsi perhitungan sub total
function hitungSubTotal() {
  let subTotal = 0;
  const totalHargaElements = document.querySelectorAll(".totalHarga");
  totalHargaElements.forEach((element) => {
    subTotal += parseFloat(element.value) || 0;
  });
  document.getElementById("subTotal").value = subTotal.toFixed(2);
  hitungTotalBayar();
  hitungJumlahBarang();
}

//fungsi perhitungan jumlah barang
function hitungJumlahBarang() {
  let jumlah_barang = 0;
  const totalBarangElements = document.querySelectorAll(".qty");
  totalBarangElements.forEach((element) => {
    jumlah_barang += parseFloat(element.value) || 0;
  });

  const jumlahBarangElement = document.getElementById("jumlah_barang");
  if (jumlahBarangElement) {
    jumlahBarangElement.value = jumlah_barang.toFixed(2);
  } else {
    console.error("Elemen dengan ID 'jumlahBarang' tidak ditemukan.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".qty").forEach((element) => {
    element.addEventListener("input", hitungJumlahBarang);
  });
});

//fungsi perhitungan totalbayar
function hitungTotalBayar() {
  const subTotal = parseFloat(document.getElementById("subTotal").value) || 0;
  const diskon = parseFloat(document.getElementById("diskon").value) || 0;
  const ongkir = parseFloat(document.getElementById("ongkir").value) || 0;
  const totalBayar = subTotal - diskon + ongkir;
  document.getElementById("totalBayar").value = totalBayar.toFixed(2);
}

// Event listener untuk menangani klik pada tombol hapus
document.querySelector("#list-form-input").addEventListener("click", (e) => {
  const target = e.target;
  if (target.classList.contains("hapus")) {
    // Menghapus baris yang berisi tombol hapus
    target.closest("tr").remove();
    showAlert("Barang telah dihapus", "danger");
  }
});

// fungsi untuk event cari
function handleSearch(event) {
  event.preventDefault(); // Mencegah pengiriman formulir secara default
  const no_transaksi = document.getElementById("searchInput").value;

  // Mengirim permintaan AJAX ke PHP
  fetch(`cari_transaksi.php?no_transaksi=${no_transaksi}`)
    .then((response) => response.json())
    .then((data) => {
      const tabelBody = document.getElementById("tabelBody");
      tabelBody.innerHTML = ""; // Clear previous data

      if (data && data.no_transaksi) {
        tabelBody.innerHTML = `
                  <tr>
                      <td>1</td>
                      <td class='text-center'>${data.no_transaksi}</td>
                      <td>${data.tanggal}</td>
                      <td>${data.nama_customer}</td>
                      <td>${data.jumlah_barang}</td>
                      <td>${data.sub_total}</td>
                      <td>${data.diskon}</td>
                      <td>${data.ongkir}</td>
                      <td>${data.total}</td>
                  </tr>
              `;
      } else {
        tabelBody.innerHTML = `<tr><td colspan="8" class='text-center'>Transaksi tidak ditemukan</td></tr>`;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
