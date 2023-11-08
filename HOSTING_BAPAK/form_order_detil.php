<?php
require("functions.php");


if (isset($_GET["orderId"]) ) {
    $id_order = $_GET["orderId"];
    $data_order_id = query("SELECT * FROM `order` WHERE id_order = $id_order")[0];
    $tanggal = $data_order_id["tgl_order"];
    $jam = $data_order_id["jam_order"];
    $no_meja = $data_order_id["no_meja"];
    $total_bayar = $data_order_id["total_bayar"];
}

if (isset($_POST["menu"]) && isset($_POST["jumlah"]) && isset($_POST["tambahMenu"])) {
    $id_menu = $_POST["menu"];
    $jumlah = $_POST["jumlah"];
    $ambilHarga = query("SELECT harga FROM menu WHERE id_menu = $id_menu")[0];
    if (count($ambilHarga) > 0) {
        $harga = $ambilHarga["harga"];
        $subtotal = $jumlah * $harga;
        if (tambahOrderDetail($id_order, $id_menu, $harga, $jumlah, $subtotal) <= 0) {
            echo "menu gagal ditambahkan";
        }
    }
    $getSubTotal = query("SELECT subtotal FROM `order_detil` WHERE id_order = $id_order");
    $total = 0;
    foreach ($getSubTotal as $subtotal) {
        $total += $subtotal["subtotal"];
    }
    updateTotalBayar($total, $id_order);
    $total_bayar = query("SELECT total_bayar FROM `order` WHERE id_order = $id_order")[0];
    $total_bayar = $total_bayar["total_bayar"];
}

if (isset($_GET["id_order_detil"])) {
    $id_order_detil = $_GET["id_order_detil"];
    hapusOrderDetil($id_order_detil);
    header("Location: form_order_detil.php?orderId=" . $id_order);
}

if (isset($_POST["batal"])) {
    hapusOrderByOrderId($id_order);
    header("Location: data_order.php");
}

if (isset($_POST["selesai"])) {
    header("Location: detil_order.php?id_order=" . $id_order);
}


$listMenu = query("SELECT * FROM menu ");
?>


<?php include "layout/header.php" ?>
    <div class="container">
        <div class="card my-4">
            <h5 class="card-header">Form Order Detil</h5>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th>ID ORDER</th>
                                <th>TANGGAL ORDER</th>
                                <th>JAM ORDER</th>
                                <th>NO MEJA</th>
                                <th>TOTAL BAYAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $id_order ?></td>
                                <td><?= $tanggal ?></td>
                                <td><?= $jam ?></td>
                                <td><?= $no_meja ?></td>
                                <td><?= formatHarga($total_bayar) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form action="" method="post">
                    <p class="fw-bold text-primary">FORM TAMBAH MENU</p>
                    <div class="table table-responsive">
                        <table class="table table-responsive table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th>PILIH MENU</th>
                                    <th>JUMLAH</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-select" name="menu" id="menu">
                                            <option value="" disabled selected>--- Pilih Menu ---</option>
                                            <?php foreach ($listMenu as $menu) : ?>
                                                <option value="<?= $menu["id_menu"] ?>"><?= $menu["nama"] ?> - <?= $menu["harga"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control" type="number" name="jumlah" value="1" min="1">
                                    </td>
                                    <td colspan="2">
                                        <button  class="btn btn-primary" type="submit" name="tambahMenu">Tambah</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="fw-bold text-success">MENU YANG BARU DITAMBAHKAN</p>
                    <div class="table table-responsive">
                        <table class="table  table-bordered">
                            <?php
                            $data_order_detil = query("SELECT  order_detil.id_order_detil, order_detil.id_order, order_detil.subtotal, order_detil.id_menu, menu.nama, menu.harga, order_detil.jumlah
                            FROM order_detil
                            LEFT JOIN menu ON menu.id_menu = order_detil.id_menu
                            WHERE order_detil.id_order = $id_order
                            ORDER BY order_detil.id_order");
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
                                               <a class="btn btn-danger" href="form_order_detil.php?orderId=<?= $id_order ?>&id_order_detil=<?= $detil["id_order_detil"] ?>">Hapus</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php endforeach; ?>
                            <?php else :  ?>
                                <tr>
                                    <td>BELUM ADA MENU YANG DITAMBAHKAN</td>
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
<?php include "layout/footer.php" ?>