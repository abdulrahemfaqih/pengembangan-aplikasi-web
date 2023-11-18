<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$data_pelanggan = getAllPelanggan();
$data_transaksi = getAllTransaksi();

deleteTransWhereNotInDetil();

if (isset($_GET["transaksi_id"])) {
    $transaksi_id = $_GET["transaksi_id"];
    if (hapusTransaksibyID($transaksi_id) > 0) {
        echo "<meta http-equiv=refresh content=1;URL='index.php'>";
    } else {
        echo "<meta http-equiv=refresh content=1;URL='index.php'>";
    }
}
if (isset($_POST["submit"])) {
    $pelanggan = $_POST["pelanggan_id"];
    $keterangan = $_POST["keterangan"];
    $waktu_transaksi = $_POST["waktu_transaksi"];
    if (!empty($pelanggan) && !empty($keterangan) && !empty($waktu_transaksi)) {
        if (!tambahTransaksi($_POST)) {
            echo "query gagal : " . mysqli_error(DB);
        } else {
            $id_transaksi = mysqli_insert_id(DB);
        }
        header("Location: form_transaksi_detail.php?id_transaksi    =$id_transaksi");
    } else {
        echo "<script>alert('semua inputan harus diisi')</script>";
    }
}


$title = "Data Transaksi";
include "layout/header.php"
?>
<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mt-2">Data Transaksi</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Transaksi
                </button>
            </div>
            <div class="table table-responsive mt-2">
                <table class="table table-hover table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>No.</th>
                            <th>ID Transaksi</th>
                            <th>Waktu Transaksi</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Pelanggan ID</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>

                    <?php if (!empty($data_transaksi)) : ?>
                        <?php $i = 1 ?>
                        <tbody>
                            <?php foreach ($data_transaksi as $transaksi) : ?>
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td>
                                        <?= $transaksi["id"] ?>
                                    </td>
                                    <td>
                                        <?= $transaksi["waktu_transaksi"] ?>
                                    </td>
                                    <td>
                                        <?= $transaksi["keterangan"] ?>
                                    </td>
                                    <td>
                                        <?= formatHarga($transaksi["total"]) ?>
                                    </td>
                                    <td>
                                        <?= $transaksi["nama"] ?>
                                    </td>
                                    <td style="width: 150px;">
                                        <div class="d-flex justify-content-around">
                                            <a href="detailTransaksi.php?transaksi_id=<?= $transaksi["id"] ?>">
                                                <button type="button" class="btn btn-info btn-sm">Detail</button>
                                            </a>
                                            <a href="index.php?transaksi_id=<?= $transaksi["id"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus supplier ini?')">
                                                <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                            </a>
                                        </div>
                                    </td>
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
</div>
<!-- modal tambah -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="pelanggan" class="form-label">Pelanggan</label>
                        <select required id="pelanggan" name="pelanggan_id" class="form-select" aria-label="Default select example">
                            <option selected disabled>Pilih Pelanggan</option>
                            <?php foreach ($data_pelanggan as $pelanggan) : ?>
                                <option value="<?= $pelanggan["id"] ?>"><?= $pelanggan["nama"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <div class="form-floating">
                            <textarea required class="form-control" name="keterangan" id="keterangan" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Transaksi</label>
                        <?php date_default_timezone_set('Asia/Jakarta') ?>
                        <input type="text" name="waktu_transaksi" readonly class="form-control" id="tanggal" value="<?= date("Y-m-d") ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Sumbit</button>
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