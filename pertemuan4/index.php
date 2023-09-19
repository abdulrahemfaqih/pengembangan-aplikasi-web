<?php
require "fungsi.php";
$menu =  query("SELECT * FROM menu");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container p-4">
        <h1 class="py-4">Menu Makanan</h1>
        <div class="tambah pb-4">
            <a href="tambah.php"><button class="btn btn-primary">Tambah Data Menu</button></a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Menu</th>
                    <th scope="col">Jenis Menu</th>
                    <th scope="col">Harga Menu</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if ($menu) : ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $no ?></th>
                            <td><?= $m["nama"] ?></td>
                            <td><?= $m["jenis"] ?></td>
                            <td><?= formatHarga($m["harga"]) ?></td>
                            <td>
                                <a href="ubah.php?id=<?= $m["id"] ?>"><button class="btn btn-warning">Ubah</button></a>
                                <a href="hapus.php?id=<?= $m["id"] ?>"><button class="btn btn-danger">Hapus</button></a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" align="center">Tidak ada menu yang ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>