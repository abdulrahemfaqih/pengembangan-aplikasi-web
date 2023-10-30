<?php
require "../functions.php";

$dataSupplier = query("SELECT * FROM supplier");
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="../assets/css/tabelSupplier.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include "../assets/layout/navbar.php" ?>
    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="container">
            <h2>Data Master Supplier</h2>
            <div class="menu">
                <a href="tambahData.php" class='tambah'>Tambah Data</a>
            </div>
            <div class="table-container" id="table-container">
                <table border="1" cellspacing="0">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th>Tindakan</th>
                    </tr>
                    <?php if (!empty($dataSupplier)) : ?>
                        <?php $i = 1 ?>
                        <?php foreach ($dataSupplier as $sp) : ?>
                            <tr>
                                <td class="nomor">
                                    <p>
                                        <?= $i++ ?>
                                    </p>
                                </td>
                                <td class="nama">
                                    <p>
                                        <?= $sp["nama"] ?>
                                    </p>
                                </td>
                                <td class="telp">
                                    <p>
                                        <?= $sp["telp"] ?>
                                    </p>
                                </td>
                                <td class="alamat">
                                    <p>
                                        <?= $sp["alamat"] ?>
                                    </p>
                                </td>
                                <td class="aksi">
                                    <a class="edit" href="ubahData.php?id=<?= $sp["id"] ?>">Edit</a>
                                    <a class="hapus" href="hapusData.php?id=<?= $sp["id"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus supplier ini?')">Hapus</a>
                                    <a class="detail" href="detailSupplier.php?id=<?= $sp["id"] ?>">detail</a>
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