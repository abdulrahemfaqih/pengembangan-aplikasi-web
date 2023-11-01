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
    <link rel="stylesheet" href="../assets/css/tabelBarang.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include "../assets/layout/navbar.php" ?>
    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="container">
            <h2>Data Master Barang</h2>
            <div class="menu">
                <a href="tambahBarang.php" class='tambah'>Tambah Data</a>
            </div>
            <div class="table-container" id="table-container">
                <table border="1" cellspacing="0">
                    <tr class="text-center">
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