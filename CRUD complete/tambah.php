<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require "functions.php";

if (isset($_POST["submit"])) {
  // cek apapah data berhasil ditambahkan atau tidak
  if (tambah($_POST) > 0) {
    echo "
      <script>
        alert('Data berhasil ditambahkan')
        window.location.href = 'dashboard.php'
      </script>
      ";
  } else {
    echo "
      <script>
        alert('Data Gagal ditambahkan')
      </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/tambah.css">
  <title>Tambah Mahasiswa</title>
</head>
<body>
  <div class="container">
    <h1>Tambah data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <table>
        <tr>
          <td><label for="nim">NIM</label></td>
          <td>: <input type="text" name="nim" id="nim"></td>
        </tr>
        <tr>
          <td><label for="nama">Nama</label></td>
          <td>: <input type="text" name="nama" id="nama"></td>
        </tr>
        <tr>
          <td><label for="email">Email</label></td>
          <td>: <input type="text" name="email" id="email"></td>
        </tr>
        <tr>
          <td><label for="jurusan">Jurusan</label></td>
          <td>: <input type="text" name="jurusan" id="jurusan"></td>
        </tr>
        <tr>
          <td><label for="gambar">Gambar</label></td>
          <td>: <input type="file" name="gambar" id="gambar" onchange="imagePreview()"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><img src="img/nophoto.png" class="imgPreview"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><button type="submit" name="submit">tambah</button></td>
        </tr>
      </table>
    </form>
  </div>
  <script src="js/tambah.js"></script>
</body>
</html>