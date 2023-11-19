<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$kode_barang = isset($_POST["kode_barang"]) ? $_POST["kode_barang"] : '';

if (isset($_POST["t_tambah"])) {
    if (!tambahDataBarang($_POST)) {
        echo "<script>
            alert('kode barang $kode_barang Gagal ditambahkan');
            window.location.href = 'data_barang.php';
        </script>";
    } else {
        echo "<script>
            alert('kode barang $kode_barang berhasil ditambahkan');
            window.location.href = 'data_barang.php';
        </script>";
    }
}

if (isset($_POST["t_hapus"])) {
    $kode_barang = $_POST["kode_barang"];
    $id_barang = $_POST["id_barang"];
    $count_barang = countBarangInTransDetail($id_barang);
    if ($count_barang["jumlah"] > 0) {
        echo "<script>alert('kode barang $kode_barang tidak bisa dihapus karena digunakan pada transaksi detail')</script>";
    } else {
        if (!hapusbarang($id_barang)) {
            echo "<script>
                alert('kode barang $kode_barang gagal dihapus');
                window.location.href = 'data_barang.php';
            </script>";
        } else {
            echo "<script>
                alert('kode barang $kode_barang berhasil dihapus');
                window.location.href = 'data_barang.php';
            </script>";
        }
    }
}

if (isset($_POST["t_ubah"])) {
    if (!ubahBarang($_POST)) {
        echo "<script>
                alert('kode barang $kode_barang gagal diubah');
                window.location.href = 'data_barang.php';
            </script>";
    } else {
        echo "<script>
                alert('kode barang $kode_barang berhasil diubah');
                window.location.href = 'data_barang.php';
            </script>";
    }
}

$AllDataBarang = getAllDataBarang();
$AllSupplier = getAllSupplier();

$title = "Data Barang";
include "layout/header.php"
?>
<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mt-2">Data Barang</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Barang
                </button>
            </div>
            <div class="table table-responsive mt-2">
                <table class="table table-hover table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>N0.</th>
                            <th>KODE BARANG</th>
                            <th>NAMA BARANG</th>
                            <th>HARGA BARANG</th>
                            <th>STOK</th>
                            <th>NAMA SUPPLIER</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <?php if (!empty($AllDataBarang)) : ?>
                        <?php $i = 1 ?>
                        <tbody>
                            <?php foreach ($AllDataBarang as $barang) : ?>
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td>
                                        <?= $barang["kode_barang"] ?>
                                    </td>
                                    <td>
                                        <?= $barang["nama_barang"] ?>
                                    </td>
                                    <td>
                                        <?= formatHarga($barang["harga"]) ?>
                                    </td>
                                    <td>
                                        <?= $barang["stok"] ?>
                                    </td>
                                    <td>
                                        <?= $barang["nama"] ?>
                                    </td>
                                    <td style="width: 150px;">
                                        <div class="d-flex justify-content-around">
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_ubah<?= $barang["id"] ?>">Ubah</button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus<?= $barang["id"] ?>">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- modal hapus -->
                                <div class="modal fade" id="modal_hapus<?= $barang["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Barang</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_barang" value="<?= $barang["id"] ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label">KODE BARANG</label>
                                                        <input type="text" name="kode_barang" class="form-control" value="<?= $barang["kode_barang"] ?> | <?= $barang["nama_barang"] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger" name="t_hapus">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal hapus -->

                                <!-- modal ubah -->
                                <div class="modal fade" id="modal_ubah<?= $barang["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">FORM EDIT BARANG</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_barang" value="<?= $barang["id"] ?>">
                                                    <div class="mb-3">
                                                        <label for="kode_barang" class="form-label">KODE BARANG</label>
                                                        <input type="text" class="form-control" name="kode_barang" value="<?= $barang["kode_barang"] ?>" id="kode_barang">
                                                        <div class="mb-3">
                                                            <label for="nama_barang" class="form-label">NAMA BARANG</label>
                                                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?= $barang["nama_barang"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga_barang" class="form-label">HARGA BARANG</label>
                                                            <input type="number" class="form-control" name="harga_barang" id="harga_barang" value="<?= $barang["harga"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="stok_barang" class="form-label">STOK BARANG</label>
                                                            <input type="number" class="form-control" name="stok_barang" id="no_hp" value="<?= $barang["stok"] ?>">

                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="supplier" class="form-label">SUPPLIER</label>
                                                            <select class="form-select" name="supplier" id="supplier">
                                                                <?php
                                                                foreach ($AllSupplier as $supplier) : ?>
                                                                    <option value="<?= $supplier["id"] ?>" <?= $supplier["id"] == $barang["supplier_id"] ? "selected" : '' ?>><?= $supplier["nama"] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="sumbit" name="t_ubah" class="btn btn-primary">Simpan</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal ubah -->
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <th colspan="7" style="background-color: white;">Tidak ada data transaksi.</th>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- modal tambah -->
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">FORM TAMBAH BARANG</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <?php $kode_barang = generateID("barang", "kode_barang", "SH") ?>
                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">KODE BARANG</label>
                            <input type="text" class="form-control" name="kode_barang" id="kode_barang" value="<?= $kode_barang ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">NAMA BARANG</label>
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang">
                        </div>
                        <div class="mb-3">
                            <label for="harga_barang" class="form-label">HARGA BARANG</label>
                            <input type="number" class="form-control" name="harga_barang" id="harga_barang">
                        </div>
                        <div class="mb-3">
                            <label for="stok_barang" class="form-label">STOK BARANG</label>
                            <input type="number" class="form-control" name="stok_barang" id="stok_barang">

                        </div>
                        <div class="mb-3">
                            <label for="supplier" class="form-label">SUPPLIER</label>
                            <select class="form-select" name="supplier" id="supplier">
                                <option value="" disabled selected>--- PILIH SUPPLIER ---</option>
                                <?php foreach ($AllSupplier as $supplier) : ?>
                                    <option value="<?= $supplier["id"] ?>"><?= $supplier["nama"] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="t_tambah" class="btn btn-primary">Sumbit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal tambah -->
</div>
<?php
include "layout/footer.php"
?>