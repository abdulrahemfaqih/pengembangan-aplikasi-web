<?php
include "functions.php";
if (isset($_GET["last_id"]) && isset($_GET["no_meja"])) {
    $id_order = $_GET["last_id"];
    $no_meja = $_GET["no_meja"];
}

if (isset($_POST["id_menu"]) && isset($_POST["jumlah"])) {

    $id_menu = $_POST["id_menu"];
    $jumlah = $_POST["jumlah"];
    $query = "SELECT harga FROM menu WHERE id_menu = $id_menu";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Query gagal: " . mysqli_error($conn);
    }
    $row = mysqli_fetch_assoc($result);
    $harga = $row["harga"];
    $subtotal = $harga * $jumlah;

    $query = "INSERT INTO order_detil (id_order, id_menu, jumlah, harga, subtotal) VALUES ('$id_order', '$id_menu', '$jumlah', '$harga', '$subtotal')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Query gagal: " . mysqli_error($conn);
    }
}

?>

<?php include "layout/header.php" ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Order Detil</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p>ID Order: <?= $id_order ?></p>
                <p>No Meja: <?= $no_meja ?></p>
            </div>
            <div class="mb-3">
                <table class="table">
                    <tr>
                        <th>id_order_detil</th>
                        <th>id_order</th>
                        <th>id_menu</th>
                        <th>nama menu</th>
                        <th>jumlah</th>
                        <th>harga</th>
                        <th>subtotal</th>
                    </tr>
                    <?php
                    $query = "SELECT order_detil.id_order_detil, order_detil.id_order, order_detil.id_menu, menu.nama, menu.harga, order_detil.jumlah, order_detil.subtotal
                            FROM order_detil
                            LEFT JOIN menu ON menu.id_menu = order_detil.id_menu
                            WHERE order_detil.id_order = $id_order
                            ORDER BY order_detil.id_order_detil";
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        echo "Query gagal: " . mysqli_error($conn);
                    }
                    if (mysqli_num_rows($result) > 0) : ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?= $row["id_order_detil"] ?></td>
                                <td><?= $row["id_order"] ?></td>
                                <td><?= $row["id_menu"] ?></td>
                                <td><?= $row["nama"] ?></td>
                                <td><?= $row["jumlah"] ?></td>
                                <td><?= formatHarga($row["harga"]) ?></td>
                                <td><?= formatHarga($row["subtotal"])?></td>
                            </tr>
                        <?php endwhile ?>
                    <?php endif ?>
                </table>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="pelayan" class="form-label">Pilih Menu</label>
                        <?php
                        $menu_query = "SELECT id_menu, nama FROM menu ORDER BY nama";
                        $menu_result = mysqli_query($conn, $menu_query);
                        if (!$menu_result) {
                            echo "Query gagal: " . mysqli_error($conn);
                        }
                        ?>
                        <select required class="form-select" id="id_menu" name="id_menu">
                            <option value="" disabled selected>Pilih menu</option>
                            <?php while ($menu_row = mysqli_fetch_assoc($menu_result)) : ?>
                                <option value="<?= $menu_row["id_menu"] ?>"><?= $menu_row["nama"] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" placeholder="Inputkan jumlah" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "layout/footer.php" ?>
