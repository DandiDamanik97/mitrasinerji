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
