<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id_transaksi"])) {
    $id_transaksi = $_GET["id_transaksi"];
    $detail_transaksi = getTransaksiDetailByIdTrans($id_transaksi);
    $total = getTotalTrans($id_transaksi);
    $transaksi = getTransaksiById($id_transaksi);
}

$title = "Detail Transaksi";
include "layout/header.php"
?>
<div class="container my-4">
    <div class="card">
        <h5 class="card-header">
            Detail Order
        </h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID TRANSAKSI</th>
                            <th>TANGGAL TANGGAL TRANSAKSI</th>
                            <th>KETERANGAN</th>
                            <th>PELANGGAN</th>
                            <th>TOTAL BAYAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $transaksi["id"] ?></td>
                            <td><?= $transaksi["waktu_transaksi"] ?></td>
                            <td><?= $transaksi["keterangan"] ?></td>
                            <td><?= $transaksi["nama"] ?></td>
                            <td><?= formatHarga($transaksi["total"]) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive mt-4">
                <table class="table table-hover table-bordered">
                    <?php if (!empty($detail_transaksi)) : ?>
                        <thead class="table-secondary">
                            <tr>
                                <th>NO</th>
                                <th>KODE BARANG</th>
                                <th>NAMA BARANG</th>
                                <th>HARGA</th>
                                <th>JUMLAH</th>
                                <th>SUB TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($detail_transaksi as $detail) :
                                $subtotal = $detail["harga"] * $detail["qty"]
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $detail["kode_barang"] ?></td>
                                    <td><?= $detail["nama_barang"] ?></td>
                                    <td><?= formatHarga($detail["harga"]) ?></td>
                                    <td><?= $detail["qty"] ?></td>
                                    <td><?= formatHarga($subtotal) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8" class="text-center fw-bold">TIDAK ADA DETAIL TRANSAKSI</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include "layout/footer.php"
?>