<?php
session_start();
require "functions.php";

if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
  $id = $_COOKIE["id"];
  $key = $_COOKIE["key"];

  // ambil username berdasarkan idnya
  $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id" );
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username

  if ($key == hash("sha256", $row["username"])) {
    $_SESSION["login"] = true;
  }
};

if (isset($_SESSION["login"])) {
  header("Location: dashboard.php");
  exit;
}


if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];

  // Periksa koneksi ke database
  if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
  }

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  // Periksa apakah query berhasil dieksekusi
  if ($result) {
    if (mysqli_num_rows($result) === 1) {
      // cek password
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {

        // set sessionnya
        $_SESSION["login"] = true;

        // cek remember me
        if (isset($_POST["remember"])) {
          // buat cookie
          setcookie("id", $row['id'], time()+9999);
          setcookie("key", hash("sha256",$row['username']), time()+9999);
        }

        header("Location: dashboard.php");
        exit;
      }
    }
  }

  $error = true;
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Form Login</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="error-message">
    <?php if(isset($error)) : ?>
      <p>Username atau password salah</p>
    <?php endif; ?>
  </div>
  <div class="container">
    <div class="login-form">
      <h2>Login</h2>
      <form id="login-form" action="" method="post">
        <input type="text" id="username" placeholder="Username" required name="username">
        <input type="password" id="password" placeholder="Password" required name="password">
        <div class="remember">
          <input type="checkbox" name="remember" id="remember">
          <label for="remember">Remember me</label>
        </div>
        <p class="forgot-password-link"><a href="#">Lupa Password?</a></p>
        <button type="submit" id="login-button" name="login">Login</button>
      </form>
      <p class="register-link">Belum punya akun? <a href="registrasi.php">Registrasi</a></p>
    </div>
  </div>
</body>

</html>