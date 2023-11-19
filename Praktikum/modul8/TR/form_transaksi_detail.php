<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id_transaksi"])) {
    $id_transaksi = $_GET["id_transaksi"];
    $data_transaksi_now = getTransaksiById($id_transaksi);
    $tanggal_transaksi = $data_transaksi_now["waktu_transaksi"];
    $keterangan_transaksi = $data_transaksi_now["keterangan"];
    $total_bayar = $data_transaksi_now["total"];
}

if (isset($_POST["barang"]) && isset($_POST["qty"]) && isset($_POST["tambah_transaksi_detail"])) {
    $id_barang = $_POST["barang"];
    $qty = $_POST["qty"];
    $harga = getHargaByIdBarang($id_barang);
    if (count($harga) > 0) {
        $harga = $harga["harga"];
        if (!addTransaksiDetail($id_transaksi, $id_barang, $harga, $qty)) {
            echo "<script>alert('barang gagal ditambahkan')</script>";
        }
    }
    updateTotalBayar($id_transaksi);
    $total_bayar = getTotalByIdTrans($id_transaksi)["total"];
}

if (isset($_GET["batal"])) {
    $id_transaksi = $_GET["id_transaksi"];
    if (!hapusTransaksibyID($id_transaksi)) {
        echo "<script>
            alert('id transaksi $id_transaksi gagal dibatalkan');
            window.location.href = 'data_transaksi.php';
        </script>";
    }
    header("Location: data_transaksi.php");
}

if (isset($_GET["barang_id"])) {
    $barang = $_GET["barang_id"];
    if (!hapusTransDetailByBarangId($id_transaksi, $barang)) {
        echo "<script>
            alert('barang id $barang gagal dihapus');
            window.location.href = 'form_transaksi_detail?id_transaksi=$id_transaksi';
            </script>";
    }
    updateTotalBayar($id_transaksi);
    header("Location: form_transaksi_detail.php?id_transaksi=$id_transaksi");
}

if (isset($_POST["selesai"])) {
    header("Location: detail_transaksi.php?id_transaksi?$id_transaksi");
}



$list_barang = getBarangNotInTransDetailByIdTrans($id_transaksi);

$title = "Transaki Detail";
include "layout/header.php"
?>
<div class="container my-4">
    <div class="card my-4">
        <h5 class="card-header">Form Transaksi Detail</h5>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID TRANSAKSI</th>
                            <th>TANGGAL TRANSAKASI</th>
                            <th>KETERANGAN TRANSAKSI</th>
                            <th>TOTAL BAYAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $id_transaksi ?></td>
                            <td><?= $tanggal_transaksi ?></td>
                            <td><?= $keterangan_transaksi ?></td>
                            <td><?= formatHarga($total_bayar) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form action="" method="post">
                <p class="fw-bold text-primary">FORM TAMBAH BARANG</p>
                <div class="table table-responsive">
                    <table class="table table-responsive table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th>PILIH BARANG</th>
                                <th>JUMLAH</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-select" name="barang" id="barang">
                                        <option value="" disabled selected>--- PILIH BARANG---</option>
                                        <?php foreach ($list_barang as $barang) : ?>
                                            <option value="<?= $barang["id"] ?>"><?= $barang["nama_barang"] ?> | <?= formatHarga($barang["harga"]) ?></option>
                                        <?php endforeach; ?>
                                </td>
                                <td>
                                    <input class="form-control" type="number" name="qty" value="1" min="1">
                                </td>
                                <td colspan="2">
                                    <button class="btn btn-primary btn-sm" type="submit" name="tambah_transaksi_detail">Tambah</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="fw-bold text-success">MENU YANG BARU DITAMBAHKAN</p>
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <?php
                        $data_transaksi_detail = getTransaksiDetailByIdTrans($id_transaksi);
                        if (!empty($data_transaksi_detail)) : ?>
                            <thead class="table-secondary">
                                <tr>
                                    <th>KODE BARANG</th>
                                    <th>NAMA BARANG</th>
                                    <th>JUMLAH</th>
                                    <th>HARGA SATUAN</th>
                                    <th>SUBTOTAL</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <?php

                            foreach ($data_transaksi_detail as $detail) :
                                $subtotal = $detail["harga"] * $detail["qty"]
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?= $detail["kode_barang"] ?></td>
                                        <td><?= $detail["nama_barang"] ?></td>
                                        <td><?= $detail["qty"] ?></td>
                                        <td><?= formatHarga($detail["harga"]) ?></td>
                                        <td><?= formatHarga($subtotal) ?></td>
                                        <td>
                                            <a class="btn btn-danger btn-sm" href="form_transaksi_detail.php?id_transaksi=<?= $id_transaksi ?>&barang_id=<?= $detail["barang_id"] ?>">Hapus</a>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                        <?php else :  ?>
                            <tr>
                                <td class="fw-bold text-center">BELUM ADA MENU YANG DITAMBAHKAN</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
                <button class="btn btn-warning" type="submit" name="selesai">Selesai</button>
                <?php if (!isset($_GET["tambahlagi"])) : ?>
                    <a class="btn btn-danger" href="form_transaksi_detail.php?batal=true&id_transaksi=<?= $id_transaksi ?>" onclick="return confirm('yakin ingin membatalkan transaksi ini?')">Batal</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php
include "layout/footer.php"
?>