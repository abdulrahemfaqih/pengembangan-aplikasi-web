<?php
require "functions.php";



$query = "DELETE FROM `order` WHERE id_order NOT IN (SELECT id_order FROM order_detil)";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "query gagal : " . mysqli_error($conn);
}



// tambah
if (isset($_POST["Btambah"])) {
    $id_order = $_POST["id_order"];
    $tanggal_order = $_POST["tanggal_order"];
    $jam_order = $_POST["jam_order"];
    $no_meja = $_POST["no_meja"];
    $pelayan = $_POST["pelayan"];
    if (tambahOrder($_POST) > 0) {
        header("Location: form_order_detil.php?orderId=" . $id_order);
    } else {
        echo "<script>alert('Order gagal ditambah')</script>";
    }
}



// hapus
if (isset($_POST["Bhapus"])) {
    if (hapusOrderByOrderId($_POST["id_order"]) > 0) {
        header("Location: data_order.php");
    } else {
        header("Location: data_order.php");
    }
}

$pelayan = ["Wafda", "Faqih", "Farish"];


// Include header
include("layout/header.php");
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Data Order</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Order
                </button>
            </div>
            <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-secondary">
                        <tr>
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
                            $listOrder = query("SELECT * FROM `order` ORDER BY tgl_order ASC");
                        } else {
                            $listOrder = query("SELECT * FROM `order` ORDER BY tgl_order DESC");
                        }
                    } else if (isset($_GET["sort_no_meja"])) {
                        if ($_GET["sort_no_meja"] == "asc") {
                            $listOrder = query("SELECT * FROM `order` ORDER BY no_meja ASC");
                        } else {
                            $listOrder = query("SELECT * FROM `order` ORDER BY no_meja DESC");
                        }
                    } else if (isset($_GET["sort_total_bayar"])) {
                        if ($_GET["sort_total_bayar"] == "asc") {
                            $listOrder = query("SELECT * FROM `order` ORDER BY total_bayar ASC");
                        } else {
                            $listOrder = query("SELECT * FROM `order` ORDER BY total_bayar DESC");
                        }
                    } else if (isset($_GET["sort_id_order"])) {
                        if ($_GET["sort_id_order"] == "asc") {
                            $listOrder = query("SELECT * FROM `order` ORDER BY id_order ASC");
                        } else {
                            $listOrder = query("SELECT * FROM `order` ORDER BY id_order DESC");
                        }
                    } else if (isset($_GET["sort_status_order"])) {
                        if ($_GET["sort_status_order"] == "asc") {
                            $listOrder = query("SELECT * FROM `order` ORDER BY status_order ASC");
                        } else {
                            $listOrder = query("SELECT * FROM `order` ORDER BY status_order DESC");
                        }
                    }  else {
                        $listOrder = query("SELECT * FROM `order`");
                    }
                    ?>
                    <?php if (!empty($listOrder)) : ?>
                        <?php foreach ($listOrder as $order) : ?>
                            <tr>
                                <td><?= $order["id_order"] ?></td>
                                <td><?= $order["tgl_order"] ?></td>
                                <td><?= $order["jam_order"] ?></td>
                                <td><?= $order["pelayan"] ?></td>
                                <td><?= $order["no_meja"] ?></td>
                                <td><?= formatHarga($order["total_bayar"]) ?></td>
                                <td><?= $order["status_order"] ?></td>
                                <td>
                                    <a href="detil_order.php?id_order=<?= $order["id_order"] ?>"><button class="btn btn-info">Detail Order</button></a>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $order["id_order"] ?>">Hapus</button>
                                </td>
                            </tr>
                            <!-- Modal Ubah -->
                            <div class="modal fade" id="modalUbah<?= $order["id_order"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <input type="hidden" name="id_order" readonly value="<?= $order["id_order"] ?>">
                                                <div class="mb-3">
                                                    <label for="pelayan" class="form-label">Nama Pelayan</label>
                                                    <select class="form-select" aria-label="Default select example" name="pelayan">
                                                        <?php foreach ($pelayan as $sp) : ?>
                                                            <option value="<?= $sp ?>" <?= ($order['pelayan'] == $sp) ? 'selected' : ''; ?>><?= $sp ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_meja" class="form-label">No Meja</label>
                                                    <input type="number" required class="form-control" value="<?= $order["no_meja"] ?>" name="no_meja">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="Bubah">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Ubah -->
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
                            <td colspan="6" style="text-align: center; font-weight: bold;">Tidak ada data order</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Tambah Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <?php
                        $lastOrder = query("SELECT MAX(id_order) as max_id FROM `order`")[0]['max_id'];
                        $newOrderID = $lastOrder + 1;
                        ?>
                        <label class="form-label">ID Order</label>
                        <input type="text" class="form-control" readonly value="<?= $newOrderID ?>" name="id_order">
                    </div>
                    <?php
                    date_default_timezone_set("Asia/Jakarta");
                    $tanggal = date("Y-m-d");
                    $jam = date("H:i:s");
                    ?>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Order</label>
                        <input type="text" required class="form-control" value="<?= $tanggal ?>" name="tanggal_order">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Order</label>
                        <input type="text" required class="form-control" readonly value="<?= $jam ?>" name="jam_order">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pelayan</label>
                        <select required class="form-select" name="pelayan">
                            <option value="" disabled selected>Pilih Pelayan</option>
                            <?php foreach ($pelayan as $sp) : ?>
                                <option value="<?= $sp ?>"><?= $sp ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Meja</label>
                        <input type="number" required class="form-control" name="no_meja" placeholder="Inputkan no_meja">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="Btambah">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Tambah -->

<?php include("layout/footer.php"); ?>