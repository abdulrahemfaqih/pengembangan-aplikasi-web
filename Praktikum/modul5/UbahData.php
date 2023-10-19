<?php
require "functions.php";

$id = $_GET["id"];

$supplier = query("SELECT * FROM supplier WHERE id = $id")[0];


if (isset($_POST["submit"])) : ?>
    <?php if (ubah($_POST) > 0) :  ?>
        <script>
            alert('Data berhasil diubah')
            window.location.href = 'index.php'
        </script>
    <?php else : ?>
        <script>
            alert('Data Gagal diubah')
        </script>
    <?php endif; ?>
<?php endif; ?>


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
        <h1>Edit data master supplier </h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $supplier["id"] ?>">
            <table>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td>: <input type="text" name="nama" id="nama" value="<?= $supplier["nama"]  ?>"></td>
                </tr>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td>: <input type="text" name="telp" id="telp" value="<?= $supplier["telp"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="email">Alamat</label></td>
                    <td>: <input type="text" name="alamat" id="alamat" value="<?= $supplier["alamat"] ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button style="background-color: green;" type="submit" name="submit">Update</button>
                        <button style="background-color: red;" type="reset" name="submit">Batal</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>