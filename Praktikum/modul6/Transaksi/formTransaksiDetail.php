<?php
require "../functions.php";


if (isset($_GET["last_id"]) && isset($_GET["pelanggan"]) && isset($_GET["keterangan"]) && isset($_GET["waktu_transaksi"])) {
    $transaksi_id = $_GET["last_id"];
    $pelanggan = $_GET["pelanggan"];
    $keterangan = $_GET["keterangan"];
    $waktu_transaksi = $_GET["waktu_transaksi"];
}
if (isset($_POST["batal"])) {
    hapusTransaksibyID($transaksi_id);
    header("Location: index.php");
}

if (isset($_POST["selesai"])) {
    $total_bayar = 0;
    $getHargaQty = query("SELECT harga, qty FROM transaksi_detail WHERE transaksi_id = $transaksi_id");
    foreach ($getHargaQty as $g) {
        $total_bayar += $g["harga"] * $g["qty"];
    }
    updateTotalBayarbyTransID($total_bayar, $transaksi_id);
    header("Location: index.php");
}

if (isset($_POST["barang"]) && isset($_POST["qty"]) && isset($_POST["tambahTransaksi"])) {
    $id_barang = $_POST["barang"];
    $qty = $_POST["qty"];
    $getHargaQty = query("SELECT harga FROM barang WHERE id = $id_barang")[0];
    if (count($getHargaQty) > 0) {
        $harga = $getHargaQty["harga"];
        $insert_query = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$transaksi_id', '$id_barang', '$harga', '$qty')";
        $insert_result = mysqli_query($conn, $insert_query);
        if (!$insert_result) {
            echo "data gagal ditambahkan: " . mysqli_error($conn);
        }
    }
}


$queryBarangBelumDitambahkan = "SELECT * FROM barang WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $transaksi_id)";
$barangBelumDitambahkan = query($queryBarangBelumDitambahkan);

if (isset($_GET["barang_id"])) {
    hapusTransDetailByBarangId($_GET["barang_id"]);
    header("Location: formTransaksiDetail.php?last_id=$transaksi_id&pelanggan=$pelanggan&keterangan=$keterangan&waktu_transaksi=$waktu_transaksi");

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form DetaiL Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card my-4" style="width: 30%;">
            <h5 class="card-header bg-primary">Form Transaksi Detail</h5>
            <div class="card-body">
                <div class="transaksiid">
                    <P>Transaksi ID : <?= $transaksi_id ?></P>
                    <P>Pelanggan : <?= $pelanggan ?></P>
                    <P>Transaksi ID : <?= $transaksi_id ?></P>

                </div>
            </div>
        </div>
        <form action="" method="post">
            <table class="table table-bordered border border-secondary">
                <tr>
                    <td><label for="barang">Pilih Barang</label></td>
                    <td>
                        <select class="form-select" name="barang" id="barang">
                            <option value="" disabled selected>--- Pilih Barang ---</option>
                            <?php foreach ($barangBelumDitambahkan as $b) : ?>
                                <option value="<?= $b["id"] ?>"><?= $b["id"] ?> - <?= $b["nama_barang"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="number" name="qty" value="1" min="1">
                    </td>
                    <td colspan="2">
                        <button style="display: flex; justify-content: center;" class="btn btn-primary" type="submit" name="tambahTransaksi">Tambah</button>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered border border-secondary">
                <?php
                $query = "SELECT transaksi_detail.transaksi_id, transaksi_detail.barang_id, barang.kode_barang, barang.nama_barang, barang.harga, transaksi_detail.qty
                FROM transaksi_detail
                LEFT JOIN barang ON barang.id = transaksi_detail.barang_id
                WHERE transaksi_detail.transaksi_id = $transaksi_id
                ORDER BY transaksi_detail.transaksi_id";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "Query gagal: " . mysqli_error($conn);
                }
                if (mysqli_num_rows($result) > 0) : ?>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th style="width: 300px;">Quantity</th>
                        <th style="width: 200px;">Harga Satuan</th>
                        <th>Subharga</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $total = 0;
                    while ($row = mysqli_fetch_assoc($result)) :
                        $subharga =  $row["qty"] * $row["harga"];
                        $total += $subharga;
                    ?>
                        <tr>
                            <td><?= $row["kode_barang"] ?></td>
                            <td><?= $row["nama_barang"] ?></td>
                            <td><?= $row["qty"] ?></td>
                            <td><?= formatHarga($row["harga"]) ?></td>
                            <td><?= formatHarga($subharga) ?></td>
                            <td><a class="btn btn-danger" href="formTransaksiDetail.php?last_id=<?= $transaksi_id ?>&pelanggan=<?= $pelanggan ?>&keterangan=<?= $keterangan ?>&waktu_transaksi=<?= $waktu_transaksi ?>&barang_id=<?= $row["barang_id"] ?>">Hapus</a></td>
                        </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="4">Total :</td>
                        <td><?= formatHarga($total) ?></td>
                    </tr>
                <?php endif; ?>
            </table>
            <button class="btn btn-warning" type="submit" name="selesai">Selesai</button>
            <button class="btn btn-danger" type="submit" name="batal">Batal</button>
        </form>
    </div>
</body>
</html>