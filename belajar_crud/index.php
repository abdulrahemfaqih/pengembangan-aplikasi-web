<?php
require "functions.php";

// tambah Produk
if (isset($_POST["Btambah"])) {
    if (tambahPoduk($_POST) > 0) {
        echo "
        <script>alert('Data berhasil ditambahkan')</script>
        ";
    } else {
        echo "
        <script>alert('data gagal ditambahkan')</script>
        ";
    }
}

// ubah
if (isset($_POST["Bubah"])) {
    if (ubahProduk($_POST) > 0) {
        echo "
        <script>alert('Data berhasil diubah')</script>
        ";
    } else {
        echo "
        <script>alert('data gagal diubah')</script>
        ";
    }
}
if (isset($_POST["Bhapus"])) {
    if (hapusProduk($_POST) > 0) {
        echo "
        <script>alert('Data berhasil dihapus')</script>
        ";
    } else {
        echo "
        <script>alert('data gagal dihapus')</script>
        ";
    }
}



$listProduk = query("SELECT * FROM data_produk ORDER BY id_produk DESC")

?>

<?php include("layout/header.php") ?>

<div class="container">
    <div class="m-4">
        <h3 class="text-center">CRUD Produk Gadget</h3>
        <h4 class="text-center">Toko GadgetIn</h4>
    </div>
    <div class="card">
        <div class="card-header bg-dark text-white">
            Data Produk
        </div>
        <div class="card-body">
            <!-- Button trigger modal tambah -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah Produk
            </button>
            <table class="table table-bordered table-striped table-hover">
                <?php if (!empty($listProduk)) : ?>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jenis</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
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
                            <td>
                                <p style="color: blue; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalDesk<?= $produk["id_produk"] ?>">
                                    deskripsi produk
                                </p>
                            </td>
                            <!-- modal deskripsi -->
                            <div class="modal fade " id="modalDesk<?= $produk["id_produk"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Deskripsi Produk</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <p><?= $produk["deskripsi_produk"] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal deskripsi -->
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $produk["id_produk"] ?>">Ubah</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?= $produk["id_produk"] ?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- Modal ubah -->
                        <div class="modal fade " id="modalUbah<?= $produk["id_produk"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Ubah data Produk</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <input type="hidden" name="id_produk" value="<?= $produk["id_produk"] ?>">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $produk["nama_produk"] ?>" placeholder="inputkan nama produk">
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-select" aria-label="Default select example" name="jenis">
                                                    <option value="<?= $produk["jenis_produk"] ?>" selected><?= $produk["jenis_produk"] ?></option>
                                                    <option value="Laptop">Laptop</option>
                                                    <option value="Handphone">Handphone</option>
                                                    <option value="Tablet">Tablet</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="stok" class="form-label">Stok Produk</label>
                                                <input type="number" class="form-control" id="stok" name="stok" value="<?= $produk["stok_produk"] ?>" placeholder="inputkan stok produk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga Produk</label>
                                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $produk["harga_produk"] ?>" placeholder="inputkan harga produk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi"><?= $produk["deskripsi_produk"] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="Bubah">Ubah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal ubah -->


                        <!-- Modal hapus -->
                        <div class="modal fade " id="modalhapus<?= $produk["id_produk"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <input type="hidden" name="id_produk" value="<?= $produk["id_produk"] ?>">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $produk["nama_produk"] ?>" placeholder="inputkan nama produk">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="Bhapus">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal hapus -->
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Tidak ada product</p>
                <?php endif; ?>
            </table>


            <!-- Modal tambah -->
            <div class="modal fade " id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="inputkan nama produk">
                                </div>
                                <div class="mb-3">
                                    <select class="form-select" aria-label="Default select example" name="jenis">
                                        <option selected>Jenis Produk</option>
                                        <option value="Laptop">Laptop</option>
                                        <option value="Handphone">Handphone</option>
                                        <option value="Tablet">Tablet</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok Produk</label>
                                    <input type="number" class="form-control" id="stok" name="stok" placeholder="inputkan stok produk">
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga Produk</label>
                                    <input type="number" class="form-control" id="harga" name="harga" placeholder="inputkan harga produk">
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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