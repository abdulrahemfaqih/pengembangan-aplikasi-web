<?php
require "../functions.php";

if (isset($_POST["batal"])) {
    header("Location: index.php");
}
$id = $_GET["id"];
$now_barang = query("SELECT * FROM `barang` WHERE id = $id")[0];
$dataSupplier = query("SELECT * FROM `supplier`");
if (isset($_POST["submit"])) : ?>
    <?php if ($now_barang["kode_barang"] !== $_POST["kode_barang"]
        || $now_barang["nama_barang"] !== $_POST["nama_barang"]
        || $now_barang["harga"] !== $_POST["harga_barang"]
        || $now_barang["stok"] !== $_POST["stok_barang"]
        || $now_barang["supplier_id"] !== $_POST["supplier"]) : ?>
        <?php if (ubahBarang($_POST) > 0) : mysqli_close($conn);  ?>
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
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap");
        * {list-style: none;margin: 0;padding: 0;text-decoration: none;font-family: "Poppins", sans-serif;}
        .container {height: 100vh;display: flex;justify-content: center;flex-direction: column;align-items: center;}
        h1 {margin: 1rem;}
        form {margin: 1rem;}
        td {padding: 0.8rem;}
        button {padding: 0.5rem 1rem;color: white;border: none;border-radius: 5px;cursor: pointer;}
        input {padding: 5px 0 10px 5px;width: 300px;}
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit data master Barang </h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $now_barang["id"] ?>">
            <table>
                <tr>
                    <td><label for="kode_barang">Kode Barang</label></td>
                    <td><input type="text" name="kode_barang" id="kode_barang" value="<?= $now_barang["kode_barang"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="nama_barang">Nama Barang</label></td>
                    <td><input type="text" name="nama_barang" id="nama_barang" value="<?= $now_barang["nama_barang"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="harga_barang">Harga Barang</label></td>
                    <td><input type="number" name="harga_barang" id="harga_barang" value="<?= $now_barang["harga"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="stok_barang">Stok Barang</label></td>
                    <td><input type="number" name="stok_barang" id="stok_barang" value="<?= $now_barang["stok"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="supplier">Supplier</label></td>
                    <td>
                        <select name="supplier" id="supplier">
                            <?php foreach ($dataSupplier as $supplier) : ?>
                                <option value="<?= $supplier["id"] ?>"
                                    <?= ($supplier["id"] == $now_barang["supplier_id"]) ? 'selected' : '' ?>>
                                    <?= $supplier["id"] ?> - <?= $supplier["nama"] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </td>
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