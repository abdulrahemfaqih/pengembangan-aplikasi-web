<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$nama_supplier = isset($_POST["nama_supplier"]) ? $_POST["nama_supplier"] : '';

if (isset($_POST["t_tambah"])) {
    if (!tambahSupplier($_POST)) {
        echo "<script>
            alert('supplier dengan nama $nama_supplier Gagal ditambahkan');
            window.location.href = 'data_supplier.php';
        </script>";
    } else {
        echo "<script>
            alert('supplier dengan nama $nama_supplier berhasil ditambahkan');
            window.location.href = 'data_supplier.php';
        </script>";
    }
}

if (isset($_POST["t_hapus"])) {
    $id_supplier = $_POST["id_supplier"];
    $count_supplier = countSupplierInBarang($id_supplier);
    if ($count_supplier["jumlah"] > 0) {
        echo "<script>alert('supplier dengan nama $nama_supplier tidak bisa dihapus karena digunakan pada Tabel Barang')</script>";
    } else {
        if (!hapusSupplier($id_supplier)) {
            echo "<script>
                alert('supplier dengan nama $nama_supplier gagal dihapus');
                window.location.href = 'data_supplier.php';
            </script>";
        } else {
            echo "<script>
                alert('supplier dengan nama $nama_supplier berhasil dihapus');
                window.location.href = 'data_supplier.php';
            </script>";
        }
    }
}

if (isset($_POST["t_ubah"])) {
    if (!ubahSupplier($_POST)) {
        echo "<script>
                alert('supplier dengan nama $nama_supplier gagal diubah');
                window.location.href = 'data_supplier.php';
            </script>";
    } else {
        echo "<script>
                alert('supplier dengan nama $nama_supplier berhasil diubah');
                window.location.href = 'data_supplier.php';
            </script>";
    }
}

$all_supplier = getAllSupplier();

$title = "Data Supplier";
include "layout/header.php"
?>
<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mt-2">Data Pelanggan</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Pelanggan
                </button>
            </div>
            <div class="table table-responsive mt-2">
                <table class="table table-hover table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>N0.</th>
                            <th>NAMA SUPPLIER</th>
                            <th>TELEPON</th>
                            <th>ALAMAT</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <?php if (!empty($all_supplier)) : ?>
                        <?php $i = 1 ?>
                        <tbody>
                            <?php foreach ($all_supplier as $supplier) : ?>
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td>
                                        <?= $supplier["nama"] ?>
                                    </td>
                                    <td>
                                        <?= $supplier["telp"] ?>
                                    </td>
                                    <td>
                                        <?= $supplier["alamat"] ?>
                                    </td>
                                    <td style="width: 150px;">
                                        <div class="d-flex justify-content-around">
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_ubah<?= $supplier["id"] ?>">Ubah</button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus<?= $supplier["id"] ?>">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- modal hapus -->
                                <div class="modal fade" id="modal_hapus<?= $supplier["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">KONFIRMASI HAPUS SUPPLIER</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_supplier" value="<?= $supplier["id"] ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label">NAMA SUPPLIER</label>
                                                        <input type="text" name="nama_supplier" class="form-control" value="<?= $supplier["nama"] ?> ">
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
                                <div class="modal fade" id="modal_ubah<?= $supplier["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">FORM EDIT SUPPLIER</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_supplier" value="<?= $supplier["id"] ?>">
                                                    <div class="mb-3">
                                                        <label for="nama_supplier" class="form-label">NAMA SUPPLIER</label>
                                                        <input type="text" class="form-control" name="nama_supplier" value="<?= $supplier["nama"] ?>" id="nama_supplier">
                                                        <div class="mb-3">
                                                            <label for="no_telp" class="form-label">NOMOR TELEPON</label>
                                                            <input type="number" class="form-control" name="no_telp" id="no_telp" value="<?= $supplier["telp"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat" class="form-label">ALAMAT</label>
                                                            <div class="form-floating">
                                                                <textarea required class="form-control" name="alamat" id="alamat" style="height: 100px"><?= $supplier["alamat"] ?></textarea>
                                                            </div>
                                                        </div>

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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">FORM TAMBAH SUPPLIER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_supplier" class="form-label">NAMA SUPPLIER</label>
                            <input type="text" class="form-control" name="nama_supplier" id="nama_supplier">
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">NO TELEPON</label>
                            <input type="tel" class="form-control" name="no_telp" id="no_telp">

                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">ALAMAT</label>
                            <div class="form-floating">
                                <textarea required class="form-control" name="alamat" id="alamat" style="height: 100px"></textarea>
                            </div>
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