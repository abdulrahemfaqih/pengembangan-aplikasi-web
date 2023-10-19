<?php
include "koneksi.php";
$menu = query("SELECT * FROM menu");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>no</td>
            <td>Nama</td>
            <td>jenis</td>
            <td>harga menu</td>
            <td>deskripsi menu</td>
        </tr>

        <?php $no = 1; foreach ($menu as $m) :  ?>
            <tr>
                <td><?= $no++ ?></em></td>
                <td><?= $m["nama_menu"] ?></td>
                <td><?= $m["jenis_menu"] ?></td>
                <td><?= $m["harga_menu"] ?></td>
                <td><?= $m["deskripsi_menu"] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>