<?php
require "functions.php";
// tambah
if (isset($_POST["Btambah"])) {
    if (tambahData($_POST) > 0) {
        echo "<script>alert('Data berhasil ditambah')</script>";
    } else {
        echo "<script>alert('Data gagal ditambah')</script>";
    }
}
// ubah
if (isset($_POST["Bubah"])) {
    if (ubahProduk($_POST) > 0) {
        echo "<script>alert('Data berhasil diubah')</script>";
    } else {
        echo "<script>alert('Data gagal diubah')</script>";
    }
}
// hapus
if (isset($_POST["Bhapus"])) {
    if (hapusProduk($_POST) > 0) {
        echo "<script>alert('Data berhasil dihapus')</script>";
    } else {
        echo "<script>alert('Data gagal dihapus')</script>";
    }
}



$listProduk = query("SELECT * FROM tbl_produk ORDER BY id_produk DESC")
?>


<?php include("layout/header.php") ?>
<div class="container">
    <div class="my-4">
        <h3 class="text-center">CRUD PRODUK</h3>
        <h4 class="text-center">Toko GadgetIn</h4>
    </div>


    <div class="card">
        <div class="card-header bg-dark text-white">
            Data Produk
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah Produk
            </button>
            <table class="table table-bordered table-hover">
                <?php if (!empty($listProduk)) : ?>
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Jenis Produk</th>
                        <th>Stok Produk</th>
                        <th>Harga Produk</th>
                        <th>Deskripsi Produk</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($listProduk as $produk) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $produk["nama_produk"] ?></td>
                            <td><?= $produk["jenis_produk"] ?></td>
                            <td><?= $produk["stok_produk"] ?></td>
                            <td><?= formatHarga($produk["harga_produk"]) ?></td>
                            <td><button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalDesk<?= $produk["id_produk"] ?>">lihat deksripsi</button></td>
                            <!-- modal deskripsi -->
                            <div class="modal fade" id="modalDesk<?= $produk["id_produk"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><?= $produk["deskripsi_produk"] ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal deksripsi -->
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $produk["id_produk"] ?>">Ubah</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $produk["id_produk"] ?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- modal ubah -->
                        <div class="modal fade" id="modalUbah<?= $produk["id_produk"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Ubah Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <input type="hidden" name="id_produk" value="<?= $produk["id_produk"] ?>">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Nama Product</label>
                                                <input type="text" class="form-control" placeholder="inputkan nama product" value="<?= $produk["nama_produk"] ?>" name="nama_produk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Jenis Produk</label>
                                                <select class="form-select" aria-label="Default select example" name="jenis_produk">
                                                    <option value="<?= $produk["jenis_produk"] ?>" selected><?= $produk["jenis_produk"] ?></option>
                                                    <option value="Laptop">Laptop</option>
                                                    <option value="Handphone">Handphone</option>
                                                    <option value="Tablet">Tablet</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Stok Produk</label>
                                                <input type="number" class="form-control" placeholder="inputkan stok produk" value="<?= $produk["stok_produk"] ?>" name="stok_produk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Harga Produk</label>
                                                <input type="number" class="form-control" placeholder="inputkan harga produk" value="<?= $produk["harga_produk"] ?>" name="harga_produk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi_produk" rows="3"><?= $produk["deskripsi_produk"] ?></textarea>
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
                        <div class="modal fade" id="modalHapus<?= $produk["id_produk"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Produk</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <input type="hidden" name="id_produk" value="<?= $produk["id_produk"] ?>">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Nama Product</label>
                                                <input type="text" class="form-control" placeholder="inputkan nama product" value="<?= $produk["nama_produk"] ?>" name="nama_produk">
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
                    <p style=" font-weight: bold;">Tidak ada produk ditemukan!</p>
                <?php endif; ?>
            </table>
            <!-- Modal tambah -->
            <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Product</label>
                                    <input type="text" class="form-control" placeholder="inputkan nama product" name="nama_produk">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Jenis Produk</label>
                                    <select class="form-select" aria-label="Default select example" name="jenis_produk">
                                        <option selected>Jenis Produk</option>
                                        <option value="Laptop">Laptop</option>
                                        <option value="Handphone">Handphone</option>
                                        <option value="Tablet">Tablet</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Stok Produk</label>
                                    <input type="number" class="form-control" placeholder="inputkan stok produk" name="stok_produk">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Harga Produk</label>
                                    <input type="number" class="form-control" placeholder="inputkan harga produk" name="harga_produk">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi_produk" rows="3"></textarea>
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
<?php include("layout/footer.php") ?>