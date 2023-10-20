const logout = document.getElementById("logout");
logout.addEventListener("click", (event) => {
  let cek = confirm("Yakin ingin logout?");
  if (cek === true) {
    return true;
  } else {
    event.preventDefault();
    return false;
  }
});

const keyword = document.getElementById("keyword");
const tableContainer = document.querySelector(".table-container");
const table = document.querySelector("table");
const btn = document.getElementById("cari");

keyword.addEventListener("keyup", () => {
  // Buat objek ajax
  let xhr = new XMLHttpRequest();

  // Cek kesiapan ajax
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      tableContainer.innerHTML = xhr.responseText;

      // Hapus tombol cari setelah data diload
      btn.remove();
    }
  };

  // Eksekusi ajax
  xhr.open("GET", "ajax/mahasiswa.php?keyword=" + keyword.value, true);
  xhr.send();
});
