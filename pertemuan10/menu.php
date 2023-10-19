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
    if (hapusMenu($_POST) > 0) {
        echo "<script>alert('Menu berhasil dihapus')</script>";
    } else {
        echo "<script>alert('Menu gagal dihapus')</script>";
    }
}



$listMenu = query("SELECT * FROM menu ORDER BY id_menu DESC")
?>


<?php include("layout/header.php") ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Data Master Menu</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah Menu
            </button>
            <table class="table table-bordered table-hover">
                <?php if (!empty($listMenu)) : ?>
                    <tr>
                        <th>No.</th>
                        <th>Nama Menu</th>
                        <th>Jenis Menu</th>
                        <th>Harga Menu</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($listMenu as $menu) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $menu["nama"] ?></td>
                            <td><?= $menu["jenis"] ?></td>
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