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
  document.getElementById("no").value = transactionNo;
}

$(document).ready(function () {
  $("#datepicker").datepicker({
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

// popup barang
document.getElementById("bukaPopup").addEventListener("click", function () {
  document.getElementById("barangPopup").style.display = "flex";
});

document.getElementById("closePopup").addEventListener("click", function () {
  document.getElementById("barangPopup").style.display = "none";
});

document.getElementById("selectBarang").addEventListener("click", function () {
  var select = document.getElementById("barangSelect");
  var selectedOption = select.options[select.selectedIndex];
  var nama = selectedOption.getAttribute("data-nama");
  var harga = selectedOption.getAttribute("data-harga");
  var kode = selectedOption.getAttribute("data-kode");

  // Isi elemen input dengan data yang dipilih
  document.querySelector("tbody tr td:nth-child(3) input").value = kode;
  document.querySelector("tbody tr td:nth-child(4) input").value = nama;
  document.querySelector("tbody tr td:nth-child(6) input").value = harga;

  // Menutup popup setelah memilih
  document.getElementById("barangPopup").style.display = "none";
});

function hitungTotal() {
  var qty = parseFloat(document.getElementById("qty").value) || 0;
  var hargaBandrol = parseFloat(document.getElementById("hargaBandrol").value) || 0;
  var diskonPersen = parseFloat(document.getElementById("diskonPersen").value) || 0;

  // Hitung diskon dalam rupiah berdasarkan persen diskon
  var diskonRp = hargaBandrol * (diskonPersen / 100) * qty;
  document.getElementById("diskonRp").value = diskonRp.toFixed(2);

  // Hitung harga setelah diskon
  var hargaDiskon = hargaBandrol - diskonRp;
  document.getElementById("hargaDiskon").value = hargaDiskon.toFixed(2);

  // Pastikan harga tidak negatif
  if (hargaDiskon < 0) {
    hargaDiskon = 0;
  }

  // Hitung total harga
  var totalHarga = qty * hargaDiskon;
  document.getElementById("totalHarga").value = totalHarga.toFixed(2);
}
