document
  .getElementById("login-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Lakukan validasi login di sini
    if (username === "" || password === "") {
      alert("Harap isi semua field.");
    } else {
      // Proses login
      alert("Login berhasil!");
    }
  });
