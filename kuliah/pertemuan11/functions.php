<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "db_warung";

// koneksi
$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error($conn));
} else {
    
}



function query($query): array
{
    global $conn;
    $rows = [];
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;

}

// ============================ FUNCTIONS MENU ======================

function tambahMenu(array $data): int
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $harga = htmlspecialchars($data["harga"]);

    $query = "INSERT INTO menu (nama, jenis, harga)
                VALUES ('$nama', '$jenis', '$harga')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}



function editMenu(array $data): int
{
    global $conn;
    $id = $_POST["id_menu"];
    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $harga = htmlspecialchars($data["harga"]);

    $query = "UPDATE menu SET
                nama = '$nama',
                jenis = '$jenis',
                harga = '$harga'
            WHERE id_menu = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusMenu(array $data): int
{
    global $conn;
    $id = $_POST["id_menu"];
    mysqli_query($conn, "DELETE FROM menu WHERE id_menu = $id");
    return mysqli_affected_rows($conn);
}


// ====================== FUNCTIONS ORDER ==========================



function tambahOrder($data)
{
    global $conn;
    $id_order = htmlspecialchars($data["id_order"]);
    $tanggal = htmlspecialchars($data["tanggal_order"]);
    $jam = htmlspecialchars($data["jam_order"]);
    $namaPelayan = htmlspecialchars($data["pelayan"]);
    $noMeja = htmlspecialchars($data["no_meja"]);

    $query = "INSERT INTO `order` (id_order, tgl_order, jam_order, pelayan, no_meja)
              VALUES ('$id_order', '$tanggal', '$jam', '$namaPelayan', '$noMeja')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusOrderByOrderId($id_order)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM `order` WHERE id_order = $id_order");
    return mysqli_affected_rows($conn);
}



function editOrder(array $data) {
    global $conn;
    $id = $_POST["id_order"];
    $pelayan = htmlspecialchars($data["pelayan"]);
    $noMeja = htmlspecialchars($data["no_meja"]);

    $query = "UPDATE `order` SET
                pelayan = '$pelayan',
                no_meja = '$noMeja'
            WHERE id_order = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahOrderDetail($id_order, $id_menu, $harga, $jumlah, $subtotal)
 {
    global $conn;
    $query = "INSERT INTO `order_detil` (id_order, id_menu, harga, jumlah, subtotal)
            VALUES ('$id_order', '$id_menu', '$harga', '$jumlah', '$subtotal')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
 }


 function getHargaByIdMenu($id_menu) {
    $harga = query("SELECT harga FROM menu WHERE id_menu = $id_menu")[0];
    return $harga;
 }


 function hapusOrderIdByIdMenu($id_order,$id_menu) {
    global $conn;
    mysqli_query($conn,"DELETE FROM order_detil WHERE id_order = $id_order AND id_menu = $id_menu");
    return mysqli_affected_rows($conn);
 }









function formatHarga(float|int|string $harga): int|float|string
{
    return "Rp. " . number_format($harga, 2, ",", ".");
}

