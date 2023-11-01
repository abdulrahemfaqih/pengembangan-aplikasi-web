<?php
require "../functions.php";

if (isset($_POST["batal"])) {
    header("Location: index.php");
}
$id = $_GET["id"];
$now_supplier = query("SELECT * FROM supplier WHERE id = $id")[0];

if (isset($_POST["submit"])) : ?>
    <?php if ($now_supplier["nama"] !== $_POST["nama"] || $now_supplier["telp"] !== $_POST["telp"] || $now_supplier["alamat"] !== $_POST["alamat"]) : ?>
        <?php if (ubahSupplier($_POST) > 0) : mysqli_close($conn);  ?>
            <script>
                alert('Data berhasil diubah')
                window.location.href = 'index.php'
            </script>
        <?php else : ?>
            <script>
                alert('Data Gagal diubah')
            </script>
        <?php endif; ?>
    <?php else : ?>
        <script>
            alert('Anda tidak merubah data apapun')
        </script>
    <?php endif; ?>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="../assets/css/editData.css">
</head>

<body>
    <div class="container">
        <h1>Edit data master supplier </h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $now_supplier["id"] ?>">
            <table>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name="nama" id="nama" value="<?= $now_supplier["nama"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="telp">Nama</label></td>
                    <td><input type="text" name="telp" id="telp" value="<?= $now_supplier["telp"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="alamat">Alamat</label></td>
                    <td><input type="text" name="alamat" id="alamat" value="<?= $now_supplier["alamat"] ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button style="background-color: rgb(2,142,2);" type="submit" name="submit">Update</button>
                        <button style="background-color: rgb(203,3,3);" name="batal">Batal</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>