<?php
require("functions.php");


if (isset($_GET["orderId"]) || isset($_GET["tanggal"]) || isset($_GET["jam"]) || isset($_GET["no"])) {

    $id_order = $_GET["orderId"];
    $tanggal = $_GET["tanggal"];
    $jam = $_GET["jam"];
    $no = $_GET["no"];
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
}

if (isset($_GET["id_menu"])) {
    $id_menu = $_GET["id_menu"];
    hapusOrderIdByIdMenu($id_order, $id_menu);
    header("Location: formOrderDetil.php?orderId=" . $id_order . "&tanggal=" . $tanggal . "&jam=" . $jam . "&no=" . $no);
}

if (isset($_POST["batal"])) {
    hapusOrderByOrderId($id_order);
    header("Location: data_order.php");
}

if (isset($_POST["selesai"])) {
    header("Location: data_order.php");
}


$listMenu = query("SELECT * FROM menu ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Order Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card my-4" style="width: 50%;">
            <h5 class="card-header bg-primary">Form Order Detil</h5>
            <div class="card-body">
                <div class="transaksiid">
                    <P>ID Order: <?= $id_order ?></P>
                    <P>Tanggal Ordder : <?= $tanggal ?></P>
                    <P>Jam Order : <?= $jam ?></P>
                    <p>No Meja : <?= $no ?></p>
                </div>
            </div>
        </div>
        <form action="" method="post">
            <table class="table table-bordered border border-secondary">
                <tr>
                    <td><label for="menu">Pilih Menu</label></td>
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
                        <button style="display: flex; justify-content: center;" class="btn btn-primary" type="submit" name="tambahMenu">Tambah</button>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered border border-secondary">
                <?php
                $query = "SELECT order_detil.id_order, order_detil.id_menu, menu.nama, menu.harga, order_detil.jumlah
                FROM order_detil
                LEFT JOIN menu ON menu.id_menu = order_detil.id_menu
                WHERE order_detil.id_order = $id_order
                ORDER BY order_detil.id_order";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "Query gagal: " . mysqli_error($conn);
                }
                if (mysqli_num_rows($result) > 0) : ?>
                    <tr>
                        <th>Id Menu</th>
                        <th>Nama Menu</th>
                        <th style="width: 300px;">Jumlah</th>
                        <th style="width: 200px;">Harga Satuan</th>
                        <th>Sub Total</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $total = 0;
                    while ($row = mysqli_fetch_assoc($result)) :
                        $subTotal =  $row["jumlah"] * $row["harga"];
                        $total += $subTotal;
                    ?>
                        <tr>
                            <td><?= $row["id_menu"] ?></td>
                            <td><?= $row["nama"] ?></td>
                            <td><?= $row["jumlah"] ?></td>
                            <td><?= formatHarga($row["harga"]) ?></td>
                            <td><?= formatHarga($subTotal) ?></td>
                            <td><a class="btn btn-danger" href="formOrderDetil.php?orderId=<?= $id_order ?>&tanggal=<?= $tanggal ?>&jam=<?= $jam ?>&no=<?= $no ?>&id_menu=<?= $row["id_menu"] ?>">Hapus</a></td>
                        </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="4">Total :</td>
                        <td><?= formatHarga($total) ?></td>
                    </tr>
                <?php endif; ?>
            </table>
            <button class="btn btn-warning" type="submit" name="selesai">Selesai</button>
            <?php if (!isset($_GET["tambahlagi"])) : ?>
                <button class="btn btn-danger" type="submit" name="batal">Batal</button>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>