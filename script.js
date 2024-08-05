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

// JavaScript untuk menangani pop-up
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
