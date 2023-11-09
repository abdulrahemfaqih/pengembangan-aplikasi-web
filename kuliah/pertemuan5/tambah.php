
<?php
require "fungsi.php";

if (isset($_POST["submit"])) {
    // cek apapah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
      <script>
        alert('Data berhasil ditambahkan')
        window.location.href = 'index.php'
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
    <title>Tambah Menu</title>
</head>

<body>
    <div class="container">
        <h1>Tambah data Menu</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="nim">Nama</label></td>
                    <td>: <input type="text" name="nama"></td>
                </tr>
                <tr>
                    <td><label for="email">Harga</label></td>
                    <td>: <input type="text" name="harga" ></td>
                </tr>
                <tr>
                    <td><label for="nama">Ketersediaan</label></td>
                    <td>: <select name="ketersediaan">
                        <option value="ada">Ada</option>
                        <option value="habis">Tidak ada</option>
                    </select></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><button type="submit" name="submit">tambah</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>