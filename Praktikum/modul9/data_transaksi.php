<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["limit"])) {
    $limitDataPerHalaman = $_GET["limit"];
} else {
    $limitDataPerHalaman = 5;
}

$data_limit = [
    5, 10, 15, 20, 25
];



$keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : '';
$awal = isset($_GET["awal"]) ? $_GET["awal"] : '';
$akhir = isset($_GET["akhir"]) ? $_GET["akhir"] : '';

$where_cluse = '';
if (!empty($keyword)) {
    $where_cluse = "WHERE
    id LIKE '%$keyword%' OR
    waktu_transaksi LIKE '%$keyword%' OR
    keterangan LIKE '%$keyword%' OR
    total LIKE '%$keyword%' OR
    pelanggan_id LIKE '%$keyword%'";
} elseif (!empty($awal) && !empty($akhir)) {
    $where_cluse = "WHERE waktu_transaksi BETWEEN '$awal' AND '$akhir'";
}

$jumlahData = count(query("SELECT * FROM transaksi $where_cluse"));
$jumlahHalaman = ceil($jumlahData / $limitDataPerHalaman);
$halamanAktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awalData = ($limitDataPerHalaman * $halamanAktif) - $limitDataPerHalaman;

$data_pelanggan = getAllPelanggan();

if (isset($_GET["keyword"])) {
    $data_transaksi = cari($keyword, $awalData, $limitDataPerHalaman);
    $key = "keyword=" . $_GET["keyword"] . "&";
} elseif (isset($_GET["awal"]) && isset($_GET["akhir"])) {
    $data_transaksi = getAllTransaksiByTanggal($awal, $akhir, $awalData, $limitDataPerHalaman);
    $key = "awal=" . $_GET["awal"] . "&" . "akhir=" . $_GET["akhir"];
} elseif (isset($_GET["sort"])) {
    if (isset($_GET["sort_id_transaksi"])) {
        if ($_GET["sort_id_transaksi"] == "asc") {
            $data_transaksi = query("SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN `pelanggan` ON transaksi.pelanggan_id= pelanggan.id ORDER BY transaksi.id ASC LIMIT $awalData, $limitDataPerHalaman");
            $key = "sort&sort_id_transaksi=asc&";
        } else {
            $data_transaksi = query("SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN `pelanggan` ON transaksi.pelanggan_id= pelanggan.id ORDER BY transaksi.id DESC LIMIT $awalData, $limitDataPerHalaman");
            $key = "sort&sort_id_transaksi=desc&";
        }
    } else if (isset($_GET["sort_tanggal"])) {
        if ($_GET["sort_tanggal"] == "asc") {
            $key = "sort&sort_tanggal=asc&";
            $data_transaksi = query("SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN `pelanggan` ON transaksi.pelanggan_id= pelanggan.id ORDER BY waktu_transaksi ASC LIMIT $awalData, $limitDataPerHalaman");
        } else {
            $data_transaksi = query("SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN `pelanggan` ON transaksi.pelanggan_id= pelanggan.id ORDER BY waktu_transaksi DESC  LIMIT $awalData, $limitDataPerHalaman");
            $key = "sort&sort_tanggal=desc&";
        }

    } else if (isset($_GET["sort_keterangan"])) {
        if ($_GET["sort_keterangan"] == "asc") {
            $key = "sort_keterangan=asc&";
            $data_transaksi = query("SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN `pelanggan` ON transaksi.pelanggan_id= pelanggan.id ORDER BY keterangan ASC  LIMIT $awalData, $limitDataPerHalaman");
        } else {
            $key = "sort_keterangan=desc&";
            $data_transaksi = query("SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN `pelanggan` ON transaksi.pelanggan_id= pelanggan.id ORDER BY keterangan DESC  LIMIT $awalData, $limitDataPerHalaman");
        }
    } else if (isset($_GET["sort_total"])) {
        if ($_GET["sort_total"] == "asc") {
            $key = "sort&total=asc&";
            $data_transaksi = query("SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN `pelanggan` ON transaksi.pelanggan_id= pelanggan.id ORDER BY total ASC  LIMIT $awalData, $limitDataPerHalaman");
        } else {
            $key = "sort&total=desc&";
            $data_transaksi = query("SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN `pelanggan` ON transaksi.pelanggan_id= pelanggan.id ORDER BY total DESC  LIMIT $awalData, $limitDataPerHalaman");
        }
    } else if (isset($_GET["sort_pelanggan"])) {
        if ($_GET["sort_pelanggan"] == "asc") {
            $key = "sort&pelanggan=asc&";
            $data_transaksi = query("SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN `pelanggan` ON transaksi.pelanggan_id= pelanggan.id ORDER BY pelanggan.nama ASC  LIMIT $awalData, $limitDataPerHalaman");
        } else {
            $key = "sort&pelanggan=desc&";
            $data_transaksi = query("SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN `pelanggan` ON transaksi.pelanggan_id= pelanggan.id ORDER BY pelanggan.nama DESC  LIMIT $awalData, $limitDataPerHalaman");
        }
    }
} else {
    $data_transaksi = getAllTransaksi($awalData, $limitDataPerHalaman);
    $key = '';
}





deleteTransWhereNotInDetil();

if (isset($_GET["transaksi_id"])) {
    $transaksi_id = $_GET["transaksi_id"];
    if (hapusTransaksibyID($transaksi_id) > 0) {
        echo "<script>
            alert('transaksi id $transaksi_id berhasil dihapus');
            window.location.href = 'data_transaksi.php';
            </script>";
    } else {
        echo "<script>
            alert('transaksi id $transaksi_id gagal dihapus');
            window.location.href = 'data_transaksi.php';
            </script>";
    }
}
if (isset($_POST["submit"])) {
    $pelanggan = $_POST["pelanggan_id"];
    $keterangan = $_POST["keterangan"];
    $waktu_transaksi = $_POST["waktu_transaksi"];
    if (!empty($pelanggan) && !empty($keterangan) && !empty($waktu_transaksi)) {
        if (!tambahTransaksi($_POST)) {
            echo "<script>
            alert('transaksi gagal ditambahkan');
            window.location.href = 'data_transaksi.php';
            </script>";
        } else {
            $id_transaksi = mysqli_insert_id(DB);
        }
        header("Location: form_transaksi_detail.php?id_transaksi=$id_transaksi");
    } else {
        echo "<script>alert('semua inputan harus diisi')</script>";
    }
}


$title = "Data Transaksi";
include "layout/header.php"
?>
<div class="container my-4">
    <div class="card">
        <div class="card-header mb-3 d-flex align-items-center justify-content-between">
            <h5 class="mt-2">Data Transaksi</h5>
            <a href="data_transaksi.php?menu=transaksi" class="btn btn-secondary btn-sm">Reset</a>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <form action="" method="get">
                    <div class="d-flex align-items-center">
                        <div class="input-group">
                            <input name="awal" type="date" class="form-control">
                            <input name="akhir" type="date" class="form-control">
                            <button class="btn btn-primary btn-sm" type="submit">Tampilkan</button>
                        </div>
                    </div>
                </form>
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari disini..." value="<?= isset($_GET["keyword"]) ? $keyword : '' ?>" name="keyword" id="keyword">
                        <button class="btn btn-primary" type="submit" id="cari">Cari</button>
                    </div>
                </form>

            </div>
            <div class="d-flex justify-content-between my-4">
                <a class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Banyak Data</a>
                <ul class="dropdown-menu sm">
                    <a class="dropdown-item" href="?<?= $key ?>&limit=5">5</a>
                    <a class="dropdown-item" href="?<?= $key ?>&limit=10">10</a>
                    <a class="dropdown-item" href="?<?= $key ?>&limit=15">15</a>
                    <a class="dropdown-item" href="?<?= $key ?>&limit=20">20</a>
                    <a class="dropdown-item" href="?<?= $key ?>&limit=25">25</a>
                </ul>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Transaksi
                </button>

            </div>
            <div class="table table-responsive mt-2">
                <table class="table table-hover table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>No.</th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    ID Transaksi
                                    <a href="data_transaksi.php?limit=<?= $limitDataPerHalaman ?>&sort=true&sort_id_transaksi=<?php echo isset($_GET["sort_id_transaksi"]) && $_GET["sort_id_transaksi"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sort_id_transaksi"]) && $_GET["sort_id_transaksi"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sort_id_transaksi"]) && $_GET["sort_id_transaksi"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    Waktu Transaksi
                                    <a href="data_transaksi.php?limit=<?= $limitDataPerHalaman ?>&sort=true&sort_tanggal=<?php echo isset($_GET["sort_tanggal"]) && $_GET["sort_tanggal"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sort_tanggal"]) && $_GET["sort_tanggal"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sort_tanggal"]) && $_GET["sort_tanggal"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    Keterangan
                                    <a href="data_transaksi.php?limit=<?= $limitDataPerHalaman ?>&sort=true&sort_keterangan=<?php echo isset($_GET["sort_keterangan"]) && $_GET["sort_keterangan"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sort_keterangan"]) && $_GET["sort_keterangan"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sort_keterangan"]) && $_GET["sort_keterangan"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    Total
                                    <a href="data_transaksi.php?limit=<?= $limitDataPerHalaman ?>&sort=true&sort_total=<?php echo isset($_GET["sort_total"]) && $_GET["sort_total"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sort_total"]) && $_GET["sort_total"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sort_total"]) && $_GET["sort_total"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between">
                                    Pelanggan
                                    <a href="data_transaksi.php?limit=<?= $limitDataPerHalaman ?>&sort=true&sort_pelanggan=<?php echo isset($_GET["sort_pelanggan"]) && $_GET["sort_pelanggan"] === "asc" ? "desc" : "asc"; ?>">
                                        <?php if (isset($_GET["sort_pelanggan"]) && $_GET["sort_pelanggan"] == "asc") : ?>
                                            <i class="fa fa-sort-asc"></i>
                                        <?php elseif (isset($_GET["sort_pelanggan"]) && $_GET["sort_pelanggan"] == "desc") : ?>
                                            <i class="fa fa-sort-desc"></i>
                                        <?php else : ?>
                                            <i class="fa fa-sort"></i>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>

                    <?php if (!empty($data_transaksi)) : ?>
                        <?php $i = 1 + $awalData ?>
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
                                            <a href="detail_transaksi.php?id_transaksi=<?= $transaksi["id"] ?>">
                                                <button type="button" class="btn btn-info btn-sm">Detail</button>
                                            </a>
                                            <a href="data_transaksi.php?transaksi_id=<?= $transaksi["id"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus supplier ini?')">
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

            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($halamanAktif > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $halamanAktif - 1 ?>&limit=<?= $limitDataPerHalaman ?>&keyword=<?= $keyword ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <?php if ($i == $halamanAktif) : ?>
                            <li class="page-item active"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php else : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $i ?>&limit=<?= $limitDataPerHalaman ?>&keyword=<?= $keyword ?>"><?= $i ?></a></li>
                        <?php endif ?>
                    <?php endfor; ?>

                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $halamanAktif + 1 ?>&limit=<?= $limitDataPerHalaman ?>&keyword=<?= $keyword ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- end pagination -->
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