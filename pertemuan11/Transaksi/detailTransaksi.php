<?php
require "../functions.php";
if (isset($_GET["transaksi_id"])) {
    $transaksi_id = $_GET["transaksi_id"];
    $transaksi = query("SELECT * FROM transaksi WHERE id = $transaksi_id")[0];
    $transaksi_detail = query("SELECT transaksi_detail.transaksi_id, transaksi_detail.barang_id, barang.nama_barang, transaksi_detail.harga, transaksi_detail.qty, barang.kode_barang
        FROM transaksi_detail
        LEFT JOIN barang ON barang.id = transaksi_detail.barang_id
        WHERE transaksi_detail.transaksi_id = $transaksi_id
        ORDER BY transaksi_detail.transaksi_id");

    $total_harga = query("SELECT total FROM transaksi WHERE id = $transaksi_id")[0];
    $pelanggan = $transaksi["pelanggan_id"];
    $keterangan = $transaksi["keterangan"];
    $waktu_transaksi = $transaksi["waktu_transaksi"];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="../assets/css/detailSupplier.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include "../assets/layout/navbar.php" ?>
    <div>
        <div class="container">
            <h2>Detail Transaksi ID <span style="color: red;"><?= $transaksi_id ?></span></h2>
            <div class="menu mb-4" style="display: flex; justify-content: flex-end;" my>
                <a href="formTransaksiDetail.php?last_id=<?= $transaksi_id ?>&keterangan=<?= $keterangan ?>&pelanggan=<?= $pelanggan ?>&waktu_transaksi=<?= $waktu_transaksi ?>">Tambah Order</a>
            </div>
            <div class="table-container" id="table-container">
                <?php if (!empty($transaksi_detail)) : ?>
                    <table border="1" cellspacing="0">
                        <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                        </tr>
                        <?php $i = 1 ?>
                        <?php foreach ($transaksi_detail as $db) :
                            $subtotal = $db["harga"] * $db["qty"];
                        ?>
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
                                        <?= $db["qty"] ?>
                                    </p>
                                </td>
                                <td class="stok">
                                    <p>
                                        <?= formatHarga($subtotal) ?>
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
                                    <b><?= formatHarga($total_harga["total"]) ?></b>
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
</body>

</html>