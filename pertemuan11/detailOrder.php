<?php
require "functions.php";

if (isset($_GET["id_order"])) {
    $id_order = $_GET["id_order"];
    $order = query("SELECT * FROM `order` WHERE id_order = $id_order")[0];
    $order_detail = query("SELECT order_detil.id_order, order_detil.subtotal, order_detil.id_menu, menu.nama, order_detil.harga, order_detil.jumlah
        FROM order_detil
        LEFT JOIN menu ON menu.id_menu = order_detil.id_menu
        WHERE order_detil.id_order = $id_order
        ORDER BY order_detil.id_order");
    $tanggal = $order["tgl_order"];
    $jam = $order["jam_order"];
    $no = $order["no_meja"];

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include "layout/header.php" ?>
    <div>
        <div class="container">
            <h2 class="my-4">Detail ID Order <span style="color: red;"><?= $id_order ?></span></h2>
            <div class="menu mb-4" style="display: flex; justify-content: flex-end;" my>
                <a href="formOrderDetil.php?orderId=<?= $id_order ?>&tanggal=<?= $tanggal ?>&jam=<?= $jam ?>&no=<?= $no ?>"><button class="btn btn-primary">Tambah Order</button></a>
            </div>
            <div class="table-container" id="table-container">
                <?php if (!empty($order_detail)) : ?>
                    <table border="1" cellspacing="0" class="table table-bordered">
                        <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                        </tr>
                        <?php
                        $i = 1;
                        $total = 0;
                        ?>
                        <?php foreach ($order_detail as $order) :
                            $total += $order["subtotal"];
                        ?>
                            <tr>
                                <td class="nomor">
                                    <p>
                                        <?= $i++ ?>
                                    </p>
                                </td>
                                <td class="kode">
                                    <p>
                                        <?= $order["id_menu"] ?>
                                    </p>
                                </td>
                                <td class="nama">
                                    <p>
                                        <?= $order["nama"] ?>
                                    </p>
                                </td>
                                <td class="harga">
                                    <p>
                                        <?= formatHarga($order["harga"]) ?>
                                    </p>
                                </td>
                                <td class="stok">
                                    <p>
                                        <?= $order["jumlah"] ?>
                                    </p>
                                </td>
                                <td class="stok">
                                    <p>
                                        <?= formatHarga($order["subtotal"]) ?>
                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td class="stok" colspan="5">
                                <p>
                                    Total
                                </p>
                            </td>
                            <td class="stok">
                                <p>
                                    <b><?= formatHarga($total) ?></b>
                                </p>
                            </td>

                        </tr>
                    <?php else : ?>
                        <tr>
                            <th colspan="5" style="background-color: white;">Tidak ada detail Transaksi</th>
                        </tr>
                    </table>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <?php include "layout/footer.php" ?>