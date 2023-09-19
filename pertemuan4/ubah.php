<?php


require "fungsi.php";

$id = $_GET["id"];

$menu = query("SELECT * FROM menu WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    // cek apapah data berhasil diubah atau tidak
    if (ubahMenu($_POST) > 0) {
        echo "
      <script>
        alert('Data berhasil diubah')
        window.location.href = 'index.php'
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
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Edit data Menu</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $menu["id"] ?>">
            <table>
                <tr>
                    <td><label for="nim">Nama</label></td>
                    <td>: <input type="text" name="nama" value="<?= $menu["nama"]  ?>"></td>
                </tr>
                <tr>
                    <td><label for="nama">Jenis</label></td>
                    <td>: <input type="text" name="jenis"  value="<?= $menu["jenis"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="email">harga</label></td>
                    <td>: <input type="text" name="harga"  value="<?= $menu["harga"] ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><button type="submit" name="submit">Edit Data</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>