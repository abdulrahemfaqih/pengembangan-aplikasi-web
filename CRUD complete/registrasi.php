<?php

require "functions.php";

if (isset($_POST["register"])) {

  if (registrasi($_POST) > 0) {
    echo "
    <script>
      alert('User baru berhasil ditambahkan');
    </script>";
  } else {
    echo mysqli_error($conn);
  }
}


?>

<!DOCTYPE html>
<html>

<head>
  <title>Form Registrasi</title>
  <link rel="stylesheet" href="css/registrasi.css">
</head>

<body>
  <div class="container">
    <div class="registration-form">
      <h2>Registrasi</h2>
      <form id="registration-form" action="" method="post">
        <input type="text" id="username" name="username" placeholder="Username">
        <input type="password" id="password" placeholder="Password" name="password1">
        <input type="password" id="confirm-password" placeholder="Ulangi Password" name="password2">
        <button type="submit" id="register-button" name="register">Daftar</button>
      </form>
      <p class="login-link">Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
  </div>
</body>

</html>