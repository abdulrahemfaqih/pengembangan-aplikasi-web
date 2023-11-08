<?php
require "functions.php";
// tambah
if (isset($_POST["Btambah"])) {
    if (tambahMenu($_POST) > 0) {
        echo "<script>alert('Menu berhasil ditambah')</script>";
    } else {
        echo "<script>alert('Menu gagal ditambah')</script>";
    }
}
// ubah
if (isset($_POST["Bubah"])) {
    if (editMenu($_POST) > 0) {
        echo "<script>alert('Menu berhasil diubah')</script>";
    } else {
        echo "<script>alert('Menu gagal diubah')</script>";
    }
}
// hapus
if (isset($_POST["Bhapus"])) {
    $id_menu = $_POST["id_menu"];
    $orderDetailCount = query("SELECT COUNT(id_menu) AS jumlah FROM order_detil WHERE id_menu = $id_menu ")[0];
    if ($orderDetailCount["jumlah"]  > 0) {
        echo "<script>alert('Menu tidak dapat dihapus karena masih digunakan dalam order detail.')</script>";
    } else {
        if (hapusMenu($id_menu) > 0) {
            echo "<script>alert('Menu berhasil dihapus')</script>";
        } else {
            echo "<script>alert('Menu gagal dihapus')</script>";
        }
    }
}
?>
<?php include("layout/header.php") ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Data Master Menu</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Menu
                </button>
            </div>
            <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>NO.</th>
                            <th>ID MENU</th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    <span>NAMA MENU</span>
                                    <a href="data_menu.php?sortName=<?php echo isset($_GET["sortName"]) && $_GET["sortName"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sortName"]) && $_GET["sortName"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sortName"]) && $_GET["sortName"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>JENIS MENU</th>
                            <th>STOK</th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    <span>HARGA MENU</span>
                                    <a href="data_menu.php?sortHarga=<?php echo isset($_GET["sortHarga"]) && $_GET["sortHarga"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sortHarga"]) && $_GET["sortHarga"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sortHarga"]) && $_GET["sortHarga"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($_GET["sortName"])) {
                        if ($_GET["sortName"] == "asc") {
                            $listMenu = query("SELECT * FROM `menu` ORDER BY nama ASC");
                        } else {
                            $listMenu = query("SELECT * FROM `menu` ORDER BY nama DESC");
                        }
                    } elseif (isset($_GET["sortHarga"])) {
                        if ($_GET["sortHarga"] == "asc") {
                            $listMenu = query("SELECT * FROM `menu` ORDER BY harga ASC");
                        } else {
                            $listMenu = query("SELECT * FROM `menu` ORDER BY harga DESC");
                        }
                    } else {
                        $listMenu = query("SELECT * FROM `menu`");
                    }
                    $no = 1; ?>
                    <?php if (!empty($listMenu)) : ?>
                        <?php foreach ($listMenu as $menu) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $menu["id_menu"] ?></td>
                                <td><?= $menu["nama"] ?></td>
                                <td><?= $menu["jenis"] ?></td>
                                <td><?= $menu["stok"] ?></td>
                                <td><?= formatHarga($menu["harga"]) ?></td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $menu["id_menu"] ?>">Ubah</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $menu["id_menu"] ?>">Hapus</button>
                                </td>
                            </tr>
                            <!-- modal ubah -->
                            <div class="modal fade" id="modalUbah<?= $menu["id_menu"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal Edit Menu</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_menu" value="<?= $menu["id_menu"] ?>">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Nama Menu</label>
                                                    <input type="text" class="form-control" placeholder="inputkan nama product" value="<?= $menu["nama"] ?> " name="nama">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Jenis Menu</label>
                                                    <select class="form-select" aria-label="Default select example" name="jenis">
                                                        <option value="makanan" <?= ($menu["jenis"] == 'makanan') ? 'selected' : '' ?>>Makanan</option>
                                                        <option value="minuman" <?= ($menu["jenis"] == 'minuman') ? 'selected' : '' ?>>Minuman</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Harga Menu</label>
                                                    <input type="number" class="form-control" placeholder="inputkan harga produk" value="<?= $menu["harga"] ?>" name="harga">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="Bubah">Ubah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal ubah -->
                            <!-- modal hapus -->
                            <div class="modal fade" id="modalHapus<?= $menu["id_menu"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus menu</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_menu" value="<?= $menu["id_menu"] ?>">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Nama Menu</label>
                                                    <input disabled type="text" class="form-control" value="<?= $menu["nama"] ?>" name="nama">
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
                            <!-- end modal hapus -->
                        <?php endforeach; ?>
                    <?php else :  ?>
                        <p style=" font-weight: bold;">Tidak ada menu ditemukan!</p>
                    <?php endif; ?>
                </table>
            </div>
            <!-- Modal tambah -->
            <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Menu</label>
                                    <input type="text" required class="form-control" placeholder="inputkan nama menu" name="nama">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Jenis Produk</label>
                                    <select required class="form-select" aria-label="Default select example" name="jenis">
                                        <option selected>Jenis Menu</option>
                                        <option value="makanan">Makanan</option>
                                        <option value="minuman">Minuman</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Harga Menu</label>
                                    <input type="number" required class="form-control" placeholder="inputkan harga menu" name="harga">
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
            <!-- end modal tambah -->
        </div>
    </div>
</div>
<?php include "layout/footer.php" ?>