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
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap");
        * { list-style: none; margin: 0; padding: 0; text-decoration: none; font-family: "Poppins", sans-serif; }
        .container { display: flex; width: 1000px; flex-direction: column;justify-content: center;}
        .table-container {display: flex;justify-content: center;flex-direction: column;}
        .container h2 {margin: 2rem 0;}
        table {margin: 0 0 2rem 0;width: 100%; border: #ccc ;}
        table td {padding: 0.3rem;border: 1px solid #ccc;padding: 1rem;}
        table th {padding: 0.3rem;background-color: #DBDBDB;border: 1px solid #ccc;padding: .5rem;}
        .nomor {width: 10px;}
        .nama {width: 200px;}
        .telp {width: 180px;}
        .alamat {width: 400px;}
        .tambah {background-color: rgb(2, 142, 2);color: white;border-radius: 6px;padding: 0.5rem 1rem;}
        .tambah:hover {transform: scale(1.05);background-color: rgb(24, 186, 3);}
        .container a {font-size: 14px;}
        .aksi {display: flex;gap: 10px;justify-content: center;}
        .aksi a {padding: 0.5rem 1rem;color: white;border-radius: 5px;}
        .aksi .edit {background-color: rgb(225, 109, 0);}
        .aksi .edit:hover {background-color: rgb(248, 123, 20);}
        .aksi .hapus {background-color: rgb(203, 3, 3);}
		.aksi .hapus:hover {background-color: rgb(255, 68, 68);}
        .aksi .detail {background-color: #61A2FC;}
		.aksi .detail:hover {background-color: #516E9F;}
    </style>
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