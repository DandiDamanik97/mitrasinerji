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
                <a href="#" class="btn btn-warning btn-sm ubah">Ubah</a>
                <a href="#" class="btn btn-danger btn-sm hapus">Hapus</a>
            </td>
            <td>${rowCount}</td>
            <td><input type="text" value="${kodeBarang}" readonly></td>
            <td><input type="text" value="${namaBarang}" readonly></td>
            <td><input type="number" class="qty" oninput="hitungTotal(this)"></td>
            <td><input type="number" value="${hargaBandrol}" readonly></td>
            <td><input type="number" class="diskonPersen" oninput="hitungTotal(this)"></td>
            <td><input type="number" class="diskonRp" readonly></td>
            <td><input type="number" class="hargaDiskon" readonly></td>
            <td><input type="number" class="totalHarga" readonly></td>
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
}

//fungsi perhitungan totalbayar
function hitungTotalBayar() {
  const subTotal = parseFloat(document.getElementById("subTotal").value) || 0;
  const diskon = parseFloat(document.getElementById("diskon").value) || 0;
  const ongkir = parseFloat(document.getElementById("ongkir").value) || 0;
  const totalBayar = subTotal - diskon + ongkir;
  document.getElementById("totalBayar").value = totalBayar.toFixed(2);
}

// edit data
document.querySelector("#student-list").addEventListener("click", (e) => {
  target = e.target;
  if (target.classList.contains("edit")) {
    selectedRow = target.parentElement.parentElement;
    document.querySelector("#firstName").value = selectedRow.children[0].textContent;
    document.querySelector("#lastName").value = selectedRow.children[1].textContent;
    document.querySelector("#rollNo").value = selectedRow.children[2].textContent;
  }
});

//delete Data
document.querySelector("#list-form-input").addEventListener("click", (e) => {
  target = e.target;
  if (target.classList.contains("hapus")) {
    target.parentElement.parentElement.remove();
    showAlert("barang telah di hapus", "danger");
  }
});
