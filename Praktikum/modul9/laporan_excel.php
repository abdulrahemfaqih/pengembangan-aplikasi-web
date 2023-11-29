<?php
include "function_database.php";
if (isset($_GET["start"]) && $_GET["end"]) {
    header("Content-Type: application/ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=laporan.xls");

    $start = $_GET["start"];
    $end = $_GET["end"];
    $data_penjualan = getRangeDate($start, $end);
    $total_pendapatan = array_sum(array_column($data_penjualan, 'total'));
    $total_pelanggan = array_sum(array_column($data_penjualan, 'pelanggan'));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MODUL 7</title>

</head>

<body>
    <?php if (!empty($data_penjualan)) : ?>
        <H3 class="mt-4">REKAP LAPORAN PENJUALAH <?= $start ?> SAMPAI <?= $end ?></H3>
        <table border="1">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>TOTAL</th>
                    <th>TANGGAL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_penjualan as $no => $data) : ?>
                    <tr>
                        <td><?= $no + 1 ?></td>
                        <td><?= formatHarga($data["total"]) ?></td>
                        <td><?= $data["waktu_transaksi"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <table border="1">
            <tr>
                <th>JUMLAH PELANGGAN</th>
                <th>JUMLAH PENDAPATAN</th>
            </tr>
            <tr>
                <td><?= $total_pelanggan ?></td>
                <td><?= formatHarga($total_pendapatan) ?></td>
            </tr>
        </table>
        </div>
    <?php endif; ?>

</body>

</html>