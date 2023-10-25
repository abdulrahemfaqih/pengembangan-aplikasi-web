<?php
require "../functions.php";
$dataBarang = query("SELECT * FROM barang");
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap");
        * { list-style: none; margin: 0; padding: 0; text-decoration: none; font-family: "Poppins", sans-serif; }
        .container { display: flex; width: 1000px; flex-direction: column;justify-content: center;}
        .menu {display: flex;justify-content: flex-end;margin: 0 0 1rem 0;}
        .container { display: flex; width: 1000px; flex-direction: column;justify-content: center;}
        .menu {display: flex;justify-content: flex-end;margin: 0 0 1rem 0;}
        .table-container {display: flex;justify-content: center;flex-direction: column;}
        .container h2 {margin: 2rem 0 0 0;}
        table {margin: 0 0 2rem 0;width: 100%;}
        table,td,th {border: 1px solid #ccc;}
        table td {padding: 0.3rem;padding: 1rem;}
        table th {background-color: rgb(210, 228, 255);padding: .5rem;}
        .kode {width: 100px;}
        .nama {width: 300px;}
        .harga {width: 180px;}
        .stok {width: 100px;}
        .supplier {width: 100px;}
        .aksi {display: flex;gap: 10px;justify-content: center;}
        .container a {font-size: 14px;}
        .tambah {background-color: rgb(2, 142, 2);color: white;border-radius: 6px; padding: .5rem 1rem;}
        .tambah:hover {transform: scale(1.05);background-color: rgb(24, 186, 3);}
        .aksi a {padding: 0.5rem 1rem;color: white;border-radius: 5px; display: block;}
        .aksi .edit {background-color: rgb(225, 109, 0);}
        .aksi .edit:hover {background-color: rgb(248, 123, 20);}
        .aksi .hapus {background-color: rgb(203, 3, 3);}
		.aksi .hapus:hover {background-color: rgb(255, 68, 68);}
    </style>
</head>
<body>
    <?php include "../layout/navbar.php" ?>
    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="container">
            <h2>Data Master Barang</h2>
            <div class="menu">
                <a href="tambahBarang.php" class='tambah'>Tambah Data</a>
            </div>
            <div class="table-container" id="table-container">
                <table border="1" cellspacing="0">
                    <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Supplier ID</th>
                        <th>Tindakan</th>
                    </tr>
                    <?php if (!empty($dataBarang)) : ?>
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
                                <td class="supplier">
                                    <p>
                                        <?= $db["supplier_id"] ?>
                                    </p>
                                </td>
                                <td class="aksi">
                                    <a class="edit" href="ubahData.php?id=<?= $db["id"] ?>">Edit</a>
                                    <a class="hapus" href="hapusData.php?id=<?= $db["id"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus barang ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <th colspan="5">Data tidak ditemukan.</th>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>