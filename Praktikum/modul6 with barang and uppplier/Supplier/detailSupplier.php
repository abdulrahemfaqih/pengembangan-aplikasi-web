<?php
require "../functions.php";
$supplier_id = $_GET["id"];
$dataSupplier = query("SELECT * FROM supplier WHERE id = $supplier_id")[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Supplier</title>
</head>
<body>
    <?php include "../layout/navbar.php" ?>
    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="container">
            <h2>Barang yang di suplai Supplier <spanc style="color: red;"><?= $dataSupplier["nama"] ?></spanc></h2>
            <div class="table-container" id="table-container">
                <?php if (!empty($dataSupplier)) : ?>
                    <table border="1" cellspacing="0">
                        <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                        <?php
                        $dataBarang = query("SELECT * FROM barang WHERE supplier_id = $supplier_id");
                        if (!empty($dataBarang)) :
                        ?>
                            <?php $i = 1 ?>
                            <?php foreach ($dataBarang as $db) : ?>
                                <tr>
                                    <td class="nomor">
                                        <p>
                                            <?= $i++ ?>
                                        </p>
                                    </td>
                                    <td class="kode">
                                        <p>
                                            <?= $db["kode_barang"] ?>
                                        </p>
                                    </td>
                                    <td class="nama">
                                        <p>
                                            <?= $db["nama_barang"] ?>
                                        </p>
                                    </td>
                                    <td class="harga">
                                        <p>
                                            <?= formatHarga($db["harga"]) ?>
                                        </p>
                                    </td>
                                    <td class="stok">
                                        <p>
                                            <?= $db["stok"] ?>
                                        </p>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <th colspan="5" style="background-color: white;">Tidak ada barang</th>
                            </tr>
                        <?php endif; ?>
                    </table>
                <?php else : ?>
                    <h2>Supplier Tidak ditemukan</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>