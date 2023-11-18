<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST["barang"]) && isset($_POST["qty"]) && isset($_POST["tambah_transaksi_detail"])) {
    $id_barang = $_POST["barang"];
    $qty = $_POST["qty"];
    $harga = getHargaByIdBarang($id_barang);
    if (count($harga) > 0) {
        $harga = $harga["harga"];
        $insert_query = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$transaksi_id', '$id_barang', '$harga', '$qty')";
        $insert_result = mysqli_query($conn, $insert_query);
        if (!$insert_result) {
            echo "data gagal ditambahkan: " . mysqli_error($conn);
        }
    }
}


if (isset($_GET["id_transaksi"])) {
    $id_transaksi = $_GET["id_transaksi"];
    $data_transaksi_now = getTransaksiById($id_transaksi);


    $tanggal_transaksi = $data_transaksi_now["waktu_transaksi"];
    $keterangan_transaksi = $data_transaksi_now["keterangan"];
    $total_bayar = $data_transaksi_now["total"];
}

$list_barang = getBarangNotInTransDetailByIdTrans($id_transaksi);

$title = "Transaki Detail";
include "layout/header.php"
?>
<div class="container my-4">
    <?php var_dump($data_transaksi_now) ?>
    <div class="container">
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
                                                <option value="<?= $barang["id"] ?>"><?= $barang["nama_barang"] ?>  | <?= $barang["harga"] ?></option>
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
                            $data_order_detil = getTransaksiDetailByIdTrans($id_transaksi);
                            var_dump($data_order_detil);
                            if (!empty($data_order_detil)) : ?>
                                <thead class="table-secondary">
                                    <tr>
                                        <th>ID ORDER DETIL</th>
                                        <th>NAMA MENU</th>
                                        <th>JUMLAH</th>
                                        <th>HARGA SATUAN</th>
                                        <th>SUBTOTAL</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($data_order_detil as $detil) :
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $detil["id_order_detil"] ?></td>
                                            <td><?= $detil["nama"] ?></td>
                                            <td><?= $detil["jumlah"] ?></td>
                                            <td><?= formatHarga($detil["harga"]) ?></td>
                                            <td><?= formatHarga($detil["subtotal"]) ?></td>
                                            <td>
                                                <a class="btn btn-danger btn-sm" href="form_order_detil.php?orderId=<?= $id_order ?>&id_order_detil=<?= $detil["id_order_detil"] ?>">Hapus</a>
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
                        <button class="btn btn-danger" type="submit" name="batal">Batal</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "layout/footer.php"
?>