<?php
require "../functions.php";

if (isset($_GET["transaksi_id"])) {
    $transaksi_id = $_GET["transaksi_id"];
    if (hapusTransaksibyID($transaksi_id) > 0) {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
}


$query = "DELETE FROM `transaksi` WHERE id NOT IN (SELECT transaksi_id FROM transaksi_detail)";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "query gagal : " . mysqli_error($conn);
}

if (isset($_POST["submit"])) {
    $pelanggan = $_POST["pelanggan_id"];
    $keterangan = $_POST["keterangan"];
    $waktu_transaksi = $_POST["tanggal_transaksi"];
    if (!empty($pelanggan) && !empty($keterangan) && !empty($waktu_transaksi)) {
        $query = "INSERT INTO `transaksi` (waktu_transaksi, keterangan, pelanggan_id) VALUES ('$waktu_transaksi', '$keterangan', '$pelanggan')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "query gagal : " . mysqli_error($conn);
        } else {
            $last_id = mysqli_insert_id($conn);
        }
        header("Location: formTransaksiDetail.php?last_id=$last_id&pelanggan=$pelanggan&keterangan=$keterangan&waktu_transaksi=$waktu_transaksi");
    } else {
        echo "<script>alert('semua inputan harus diisi')</script>";
    }
}
$dataTransaksi = query("SELECT * FROM transaksi");
$dataPelanggan = query("SELECT * FROM pelanggan");
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="../assets/css/tabelTransaksi.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <?php include "../assets/layout/navbar.php" ?>
    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="container">
            <h2>Data Transaksi</h2>
            <div class="menu">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Transaksi
                </button>
            </div>
            <div class="table-container" id="table-container">
                <table border="1" cellspacing="0" class="table table-hover">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>ID Transaksi</th>
                        <th>Waktu Transaksi</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th>Pelanggan ID</th>
                        <th>Tindakan</th>
                    </tr>

                    <?php if (!empty($dataTransaksi)) : ?>
                        <?php $i = 1 ?>
                        <?php foreach ($dataTransaksi as $transaksi) : ?>
                            <tr>
                                <td class="nomor">
                                    <p>
                                        <?= $i++ ?>
                                    </p>
                                </td>
                                <td class="nama">
                                    <p>
                                        <?= $transaksi["id"] ?>
                                    </p>
                                </td>
                                <td class="telp">
                                    <p>
                                        <?= $transaksi["waktu_transaksi"] ?>
                                    </p>
                                </td>
                                <td class="alamat">
                                    <p>
                                        <?= $transaksi["keterangan"] ?>
                                    </p>
                                </td>
                                <td class="telp">
                                    <p>
                                        <?= formatHarga($transaksi["total"]) ?>
                                    </p>
                                </td>
                                <td class="telp">
                                    <p>
                                        <?= $transaksi["pelanggan_id"] ?>
                                    </p>
                                </td>
                                <td class="aksi">
                                    <a class="detail" href="detailTransaksi.php?transaksi_id=<?= $transaksi["id"] ?>">
                                        <button type="button" class="btn btn-info">Detail</button>
                                    </a>
                                    <a class="detail" href="index.php?transaksi_id=<?= $transaksi["id"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus supplier ini?')">
                                        <button type="button" class="btn btn-danger">Hapus</button>
                                    </a>
                                </td>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <th colspan="7" style="background-color: white;">Tidak ada data transaksi.</th>
                            </tr>
                        <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
    
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
                                <option selected disabled value="">Pilih Pelanggan</option>
                                <?php foreach ($dataPelanggan as $pelanggan) : ?>
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
                            <input type="text" readonly name="tanggal_transaksi" class="form-control" id="tanggal" value="<?= date("Y-m-d") ?>">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>