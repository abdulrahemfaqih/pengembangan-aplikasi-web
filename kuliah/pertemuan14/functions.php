<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "db_warung";

// koneksi
define("DB", mysqli_connect($server, $username, $password, $database));




function query($query): array
{
    $rows = [];
    $result = mysqli_query(DB, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// ============================ FUNCTIONS MENU ======================

function tambahMenu(array $data): int
{
    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);

    $query = "INSERT INTO menu (nama, jenis, harga, stok)
                VALUES ('$nama', '$jenis', '$harga', '$stok')";
    mysqli_query(DB, $query);
    return mysqli_affected_rows(DB);
}



function editMenu(array $data): int
{
    $id = $_POST["id_menu"];
    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);

    $query = "UPDATE menu SET
                nama = '$nama',
                jenis = '$jenis',
                harga = '$harga',
                stok = '$stok'

            WHERE id_menu = $id";

    mysqli_query(DB, $query);

    return mysqli_affected_rows(DB);
}

function hapusMenu($id_menu)
{
    mysqli_query(DB, "DELETE FROM menu WHERE id_menu = $id_menu");
    return mysqli_affected_rows(DB);
}

function updateStok($id_menu, $stok) {
    mysqli_query(DB, "UPDATE menu SET stok = $stok WHERE id_menu = $id_menu");
    return mysqli_affected_rows(DB);
}


// ====================== FUNCTIONS ORDER ==========================

function tambahOrder($data)
{
    $tanggal = htmlspecialchars($data["tanggal_order"]);
    $jam = htmlspecialchars($data["jam_order"]);
    $noMeja = htmlspecialchars($data["no_meja"]);
    $id_pelayan = htmlspecialchars($data["id_pelayan"]);

    $query = "INSERT INTO `order` (tgl_order, jam_order, id_pelayan, no_meja, total_bayar)
              VALUES ('$tanggal', '$jam', '$id_pelayan', '$noMeja', 0)";

    mysqli_query(DB, $query);
    return mysqli_affected_rows(DB);
}

function hapusOrderByOrderId($id_order)
{
    mysqli_query(DB, "DELETE FROM `order` WHERE id_order = $id_order");
    return mysqli_affected_rows(DB);
}

function tambahOrderDetail($id_order, $id_menu, $harga, $jumlah, $subtotal)
{
    $query = "INSERT INTO `order_detil` (id_order, id_menu, harga, jumlah, subtotal)
            VALUES ('$id_order', '$id_menu', '$harga', '$jumlah', '$subtotal')";
    mysqli_query(DB, $query);
    return mysqli_affected_rows(DB);
}

function getHargaByIdMenu($id_menu)
{
    $harga = query("SELECT harga FROM menu WHERE id_menu = $id_menu")[0];
    return $harga;
}

function hapusOrderDetil($id_order_detil)
{
    mysqli_query(DB, "DELETE FROM order_detil WHERE id_order_detil = $id_order_detil");
    return mysqli_affected_rows(DB);
}

function updateStatusDetilOrder($id_order_detil, $status)
{
    mysqli_query(DB, "UPDATE `order_detil` SET status_order_detil = '$status' WHERE id_order_detil = $id_order_detil");
    return mysqli_affected_rows(DB);
}

function updateTotalBayar($id_order)
{
    mysqli_query(DB, "UPDATE `order` SET total_bayar = (SELECT sum(subtotal) FROM order_detil WHERE id_order = $id_order) WHERE id_order = $id_order");

    return mysqli_affected_rows(DB);
}

function updateStatusOrder($id_order, $keterangan_status) {
    mysqli_query(DB, "UPDATE `order` SET status_order = '$keterangan_status' WHERE id_order = $id_order");
}

function getAllPelayan() {
    return mysqli_query(DB, "SELECT * FROM pelayan")->fetch_all(MYSQLI_ASSOC);
}

function getInfoMejaSebelumnya($no_meja) {
    return mysqli_query(DB, "SELECT no_meja, jam_order, tgl_order FROM `order` WHERE no_meja = '$no_meja' ORDER BY id_order DESC LIMIT 1")->fetch_assoc();
}

function deleteOrderWhereNotInDetil() {
    return mysqli_query(DB, "DELETE FROM `order` WHERE id_order NOT IN (SELECT id_order FROM order_detil)");
}

function cari($keyword)
{
    $query = "SELECT `order`.*, pelayan.nama_pelayan
          FROM `order`
          JOIN `pelayan` ON `order`.id_pelayan = pelayan.id_pelayan
          WHERE
          `order`.id_order LIKE '%$keyword%' OR
          `order`.tgl_order LIKE '%$keyword%' OR
          `order`.jam_order LIKE '%$keyword%' OR
          `pelayan`.nama_pelayan LIKE '%$keyword%' OR
          `order`.no_meja LIKE '%$keyword%' OR
          `order`.total_bayar LIKE '%$keyword%' OR
          `order`.status_order LIKE '%$keyword%'";


    return mysqli_query(DB, $query)->fetch_all(MYSQLI_ASSOC);
}

//========================= OTHER FUNCTIONS ====================
function formatHarga(float|int|string $harga): int|float|string
{
    return "Rp. " . number_format($harga, 2, ",", ".");
}



