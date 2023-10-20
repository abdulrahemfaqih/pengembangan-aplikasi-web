<?php
session_start();
require "functions.php";

// ambil data di url
$id = $_GET["id"];

// quary data berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


if (isset($_POST["submit"])) {
  // cek apapah data berhasil diubah atau tidak
  if (ubah($_POST) > 0) {
    echo "
      <script>
        alert('Data berhasil diubah')
        window.location.href = 'dashboard.php'
      </script>
      ";
  } else {
    echo "
      <script>
        alert('Data Gagal diubah')
      </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/ubah.css">
  <title>Edit Data</title>
</head>

<body>
  <div class="container">
    <h1>Edit data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $mhs["id"] ?>" >
       <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"] ?>">
      <table>
        <tr>
          <td><label for="nim">NIM</label></td>
          <td>: <input type="text" name="nim" id="nim" value="<?= $mhs["nim"]  ?>"></td>
        </tr>
        <tr>
          <td><label for="nama">Nama</label></td>
          <td>: <input type="text" name="nama" id="nama" value="<?= $mhs["nama"] ?>"></td>
        </tr>
        <tr>
          <td><label for="email">Email</label></td>
          <td>: <input type="text" name="email" id="email" value="<?= $mhs["email"] ?>"></td>
        </tr>
        <tr>
          <td><label for="jurusan">Jurusan</label></td>
          <td>: <input type="text" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"] ?>"></td>
        </tr>
        <tr>
          <td><label for="gambar">Gambar</label></td>
          <td align="center"><img src="img/<?= $mhs["gambar"]; ?>" alt="profil" class="imgPreview"></td>
        </tr>
        <tr>
          <td colspan="2"><input type="file" name="gambar" id="gambar"onchange="imagePreview()" ></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><button type="submit" name="submit">Edit Data</button></td>
        </tr>
      </table>
    </form>
  </div>
  <script src="js/ubah.js"></script>
</body>

</html>