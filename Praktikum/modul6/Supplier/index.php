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
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap");
        * { list-style: none; margin: 0; padding: 0; text-decoration: none; font-family: "Poppins", sans-serif; }
        .container { display: flex; width: 1000px; flex-direction: column;justify-content: center;}
        .menu {display: flex;justify-content: flex-end;margin: 0 0 1rem 0;}
        .table-container {display: flex;justify-content: center;flex-direction: column;}
        .container h2 {margin: 2rem 0 0 0;}
        table {margin: 0 0 2rem 0;width: 100%; border: #ccc ;}
        table td {padding: 0.3rem;border: 1px solid #ccc;padding: 1rem;}
        table th {padding: 0.3rem;background-color: #DBDBDB;border: 1px solid #ccc;padding: .5rem;}
        .nomor {width: 10px;}
        .nama {width: 200px;}
        .telp {width: 180px;}
        .alamat {width: 400px;}
        .tambah {background-color: rgb(53, 115, 53);color: white;border-radius: 6px;padding: 0.5rem 1rem;}
        .tambah:hover {transform: scale(1.05);background-color: rgb(24, 186, 3);}
        .container a {font-size: 14px;}
        .aksi {display: flex;gap: 10px;justify-content: center;}
        .aksi a {padding: 0.5rem 1rem;color: white;border-radius: 5px;}
        .aksi .edit {background-color: rgb(187, 123, 64);}
        .aksi .edit:hover {background-color: rgb(248, 123, 20);}
        .aksi .hapus {background-color: rgb(174, 63, 63);}
		.aksi .hapus:hover {background-color: rgb(253, 6, 6);}
        .aksi .detail {background-color: #6e93c6;}
		.aksi .detail:hover {background-color: #004bce;}
    </style>
</head>
<body>
    <?php include "../layout/navbar.php" ?>
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