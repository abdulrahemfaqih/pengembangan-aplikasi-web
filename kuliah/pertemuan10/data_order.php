<?php
require "functions.php";

// tambah
if (isset($_POST["Btambah"])) {
    if (tambahOrder($_POST) > 0) {
        echo "<script>alert('Order berhasil ditambah')</script>";
    } else {
        echo "<script>alert('Order gagal ditambah')</script>";
    }
}

// ubah
if (isset($_POST["Bubah"])) {
    if (editOrder($_POST) > 0) {
        echo "<script>alert('Order berhasil diubah')</script>";
    } else {
        echo "<script>alert('Order gagal diubah')</script>";
    }
}

// hapus
if (isset($_POST["Bhapus"])) {
    if (hapusOrder($_POST) > 0) {
        echo "<script>alert('Order berhasil dihapus')</script>";
    } else {
        echo "<script>alert('Order gagal dihapus')</script>";
    }
}

$pelayan = ["Wafda", "Faqih", "Farish"];
$listOrder = query("SELECT * FROM `order`");

// Include header
include("layout/header.php");
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Data Order</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah Order
            </button>
            <table class="table table-bordered table-hover">
                <tr>
                    <th style="width: 100px;">ID Order</th>
                    <th>Tanggal Order</th>
                    <th>Jam Order</th>
                    <th>Pelayan</th>
                    <th>No Meja</th>
                    <th style="width: 200px;">Aksi</th>
                </tr>

                <?php if (!empty($listOrder)) : ?>
                    <?php foreach ($listOrder as $order) : ?>
                        <tr>
                            <td><?= $order["id_order"] ?></td>
                            <td><?= $order["tgl_order"] ?></td>
                            <td><?= $order["jam_order"] ?></td>
                            <td><?= $order["pelayan"] ?></td>
                            <td><?= $order["no_meja"] ?></td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $order["id_order"] ?>">Ubah</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $order["id_order"] ?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- Modal Ubah -->
                        <div class="modal fade" id="modalUbah<?= $order["id_order"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="hidden" name="id_order" value="<?= $order["id_order"] ?>">
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
                        // Ambil ID Order terakhir dan tambahkan 1
                        $lastOrder = query("SELECT MAX(id_order) as max_id FROM `order`")[0]['max_id'];
                        $newOrderID = $lastOrder + 1;
                        ?>
                        <label class="form-label">ID Order</label>
                        <input type="text" class="form-control" value="<?= $newOrderID ?>" name="id_order">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pelayan</label>
                        <select required class="form-select" name="pelayan">
                            <option disabled selected>Pilih Pelayan</option>
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