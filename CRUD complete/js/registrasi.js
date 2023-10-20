document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("registration-form");
  var usernameInput = document.getElementById("username");
  var passwordInput = document.getElementById("password");
  var confirmPasswordInput = document.getElementById("confirm-password");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Periksa apakah semua input terisi
    if (
      usernameInput.value.trim() === "" ||
      passwordInput.value === "" ||
      confirmPasswordInput.value === ""
    ) {
      alert("Harap isi semua inputan.");
    }
  });
});
