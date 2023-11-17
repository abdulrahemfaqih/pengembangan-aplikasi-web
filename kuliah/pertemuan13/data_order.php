<?php
require "functions.php";

$getPelayan = getAllPelayan();


deleteOrderWhereNotInDetil();

// hapus
if (isset($_POST["Bhapus"])) {
    if (hapusOrderByOrderId($_POST["id_order"]) > 0) {
        header("Location: data_order.php");
    } else {
        header("Location: data_order.php");
    }
}

date_default_timezone_set("Asia/Jakarta");
$tanggal = date("Y-m-d");
$jam = date("H:i:s");



$title = "DATA ORDER";
include("layout/header.php");
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Data Order</h5>

        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <a href="form_order.php"  class="btn btn-primary mb-3">
                    Tambah Order
                </a>
            </div>
            <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>NO</th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    <span>ID ORDER</span>
                                    <a href="data_order.php?sort_id_order=<?php echo isset($_GET["sort_id_order"]) && $_GET["sort_id_order"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sort_id_order"]) && $_GET["sort_id_order"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sort_id_order"]) && $_GET["sort_id_order"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    <span>TANGGAL ORDER</span>
                                    <a href="data_order.php?sort_tanggal=<?php echo isset($_GET["sort_tanggal"]) && $_GET["sort_tanggal"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sort_tanggal"]) && $_GET["sort_tanggal"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sort_tanggal"]) && $_GET["sort_tanggal"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>
                                JAM ORDER
                            </th>
                            <th>PELAYAN</th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    <span>NO MEJA</span>
                                    <a href="data_order.php?sort_no_meja=<?php echo isset($_GET["sort_no_meja"]) && $_GET["sort_no_meja"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sort_no_meja"]) && $_GET["sort_no_meja"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sort_no_meja"]) && $_GET["sort_no_meja"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    <span>TOTAL BAYAR</span>
                                    <a href="data_order.php?sort_total_bayar=<?php echo isset($_GET["sort_total_bayar"]) && $_GET["sort_total_bayar"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sort_total_bayar"]) && $_GET["sort_total_bayar"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sort_total_bayar"]) && $_GET["sort_total_bayar"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    <span>STATUS ORDER</span>
                                    <a href="data_order.php?sort_status_order=<?php echo isset($_GET["sort_status_order"]) && $_GET["sort_status_order"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sort_status_order"]) && $_GET["sort_status_order"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sort_status_order"]) && $_GET["sort_status_order"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>

                            </th>
                            <th style="width: 250px;">AKSI</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($_GET["sort_tanggal"])) {
                        if ($_GET["sort_tanggal"] == "asc") {
                            $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY tgl_order ASC");
                        } else {
                            $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY tgl_order DESC");
                        }
                    } else if (isset($_GET["sort_no_meja"])) {
                        if ($_GET["sort_no_meja"] == "asc") {
                            $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY no_meja ASC");
                        } else {
                            $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY no_meja DESC");
                        }
                    } else if (isset($_GET["sort_total_bayar"])) {
                        if ($_GET["sort_total_bayar"] == "asc") {
                            $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY total_bayar ASC");
                        } else {
                            $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY total_bayar DESC");
                        }
                    } else if (isset($_GET["sort_id_order"])) {
                        if ($_GET["sort_id_order"] == "asc") {
                            $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY id_order ASC");
                        } else {
                            $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY id_order DESC");
                        }
                    } else if (isset($_GET["sort_status_order"])) {
                        if ($_GET["sort_status_order"] == "asc") {
                            $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY status_order ASC");
                        } else {
                            $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY status_order DESC");
                        }
                    } else {
                        $listOrder = query("SELECT `order`.*, pelayan.nama_pelayan FROM `order` JOIN `pelayan` ON order.id_pelayan = pelayan.id_pelayan ORDER BY id_order");
                    }
                    ?>
                    <?php $no = 1;
                    if (!empty($listOrder)) : ?>
                        <?php foreach ($listOrder as $order) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $order["id_order"] ?></td>
                                <td><?= $order["tgl_order"] ?></td>
                                <td><?= $order["jam_order"] ?></td>
                                <td><?= $order["nama_pelayan"] ?></td>
                                <td><?= $order["no_meja"] ?></td>
                                <td><?= formatHarga($order["total_bayar"]) ?></td>
                                <td><?= $order["status_order"] ?></td>
                                <td>
                                    <a href="detil_order.php?id_order=<?= $order["id_order"] ?>"><button class="btn btn-info btn-sm">Detail Order</button></a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $order["id_order"] ?>">Hapus</button>
                                </td>
                            </tr>
                            <!-- Modal Hapus -->
                            <div class="modal fade" id="modalHapus<?= $order["id_order"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Order</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_order" value="<?= $order["id_order"] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">ID Order</label>
                                                    <input disabled type="text" class="form-control" value="<?= $order["id_order"] ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" name="Bhapus">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Hapus -->
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" style="text-align: center; font-weight: bold;">Tidak ada data order</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("layout/footer.php"); ?>