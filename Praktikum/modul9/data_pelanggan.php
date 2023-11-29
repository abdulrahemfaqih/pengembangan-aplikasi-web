<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$nama_pelanggan = isset($_POST["nama_pelanggan"]) ? $_POST["nama_pelanggan"] : '';

if (isset($_POST["t_tambah"])) {
    if (!tambahPelanggan($_POST)) {
        echo "<script>
            alert('pelanggan dengan nama $nama_pelanggan Gagal ditambahkan');
            window.location.href = 'data_pelanggan.php';
        </script>";
    } else {
        echo "<script>
            alert('pelanggan dengan nama $nama_pelanggan berhasil ditambahkan');
            window.location.href = 'data_pelanggan.php';
        </script>";
    }
}

if (isset($_POST["t_hapus"])) {
    $id_pelanggan = $_POST["id_pelanggan"];
    $count_pelanggan = countPelangganInTransDetail($id_pelanggan);
    if ($count_pelanggan["jumlah"] > 0) {
        echo "<script>alert('pelanggan dengan nama $nama_pelanggan tidak bisa dihapus karena digunakan pada transaksi detail')</script>";
    } else {
        if (!hapusPelanggan($id_pelanggan)) {
            echo "<script>
                alert('pelanggan dengan nama $nama_pelanggan gagal dihapus');
                window.location.href = 'data_pelanggan.php';
            </script>";
        } else {
            echo "<script>
                alert('pelanggan dengan nama $nama_pelanggan berhasil dihapus');
                window.location.href = 'data_pelanggan.php';
            </script>";
        }
    }
}

if (isset($_POST["t_ubah"])) {
    if (!editPelangan($_POST)) {
        echo "<script>
                alert('pelanggan dengan nama $nama_pelanggan gagal diubah');
                window.location.href = 'data_pelanggan.php';
            </script>";
    } else {
        echo "<script>
                alert('pelanggan dengan nama $nama_pelanggan berhasil diubah');
                window.location.href = 'data_pelanggan.php';
            </script>";
    }
}

$allPelanggan = getAllPelanggan();

$opsi_jenis_kelamin = [
    "p", "L"
];

$title = "Data Pelanggan";
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
                            <th>NAMA PELANGGAN</th>
                            <th>JENIS KELAMIN</th>
                            <th>TELEPON</th>
                            <th>ALAMAT</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <?php if (!empty($allPelanggan)) : ?>
                        <?php $i = 1 ?>
                        <tbody>
                            <?php foreach ($allPelanggan as $pelanggan) : ?>
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td>
                                        <?= $pelanggan["nama"] ?>
                                    </td>
                                    <?php $jenis_kelamin = $pelanggan["jenis_kelamin"] == "P" ? "Perempuan" : "Laki Laki" ?>
                                    <td>
                                        <?= $jenis_kelamin ?>
                                    </td>
                                    <td>
                                        <?= $pelanggan["telp"] ?>
                                    </td>
                                    <td>
                                        <?= $pelanggan["alamat"] ?>
                                    </td>
                                    <td style="width: 150px;">
                                        <div class="d-flex justify-content-around">
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_ubah<?= $pelanggan["id"] ?>">Ubah</button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal_hapus<?= $pelanggan["id"] ?>">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- modal hapus -->
                                <div class="modal fade" id="modal_hapus<?= $pelanggan["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus pelanggan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_pelanggan" value="<?= $pelanggan["id"] ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label">NAMA PELANGGAN</label>
                                                        <input type="text" name="nama_pelanggan" class="form-control" value="<?= $pelanggan["nama"] ?> ">
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
                                <div class="modal fade" id="modal_ubah<?= $pelanggan["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">FORM EDIT PELANGGAN</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_pelanggan" value="<?= $pelanggan["id"] ?>">
                                                    <div class="mb-3">
                                                        <label for="nama_pelanggan" class="form-label">NAMA PELANGGAN</label>
                                                        <input type="text" class="form-control" name="nama_pelanggan" value="<?= $pelanggan["nama"] ?>" id="nama_pelanggan">
                                                        <div class="mb-3">
                                                            <label for="nama_barang" class="form-label">JENIS KELAMIN</label>
                                                            <select class="form-select" name="supplier" id="supplier">
                                                                <?php
                                                                foreach ($opsi_jenis_kelamin as $kel) : ?>
                                                                    <option value="<?= $kel ?>" <?= $kel == $pelanggan["jenis_kelamin"] ? "selected" : '' ?>><?= $kel ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="no_telp" class="form-label">NOMOR TELEPON</label>
                                                            <input type="number" class="form-control" name="no_telp" id="no_telp" value="<?= $pelanggan["telp"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat" class="form-label">ALAMAT</label>
                                                            <div class="form-floating">
                                                                <textarea required class="form-control" name="alamat" id="alamat" style="height: 100px"><?= $pelanggan["alamat"] ?></textarea>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">FORM TAMBAH PELANGGAN</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">NAMA PELANGGAN</label>
                            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">JENIS KELAMIN</label>
                            <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="" disabled selected>--- PILIH GENDER ---</option>
                                <option value="P">Perempuan</option>
                                <option value="L">Laki Laki</option>
                            </select>
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