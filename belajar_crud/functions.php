<?php
$server = "localhost";
$user = "faqih";
$password = "faqih3935";
$database = "gadgetin";

$conn = mysqli_connect($server, $user, $password, $database);

if (!$conn) {
    die("Koneksi Gagal : " . mysqli_connect_error());
}

function query(String $query): array
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahPoduk(array $data): int
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $stok = htmlspecialchars($data["stok"]);
    $harga = htmlspecialchars($data["harga"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    // query tambah
    $query = "INSERT INTO data_produk (nama_produk, jenis_produk, stok_produk, harga_produk, deskripsi_produk)
              VALUES ('$nama', '$jenis', '$stok', '$harga', '$deskripsi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function ubahProduk(array $data): int
{
    global $conn;
    $id = $data["id_produk"];
    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $stok = htmlspecialchars($data["stok"]);
    $harga = htmlspecialchars($data["harga"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    $query = "UPDATE data_produk SET
                nama_produk = '$nama',
                jenis_produk = '$jenis',
                stok_produk = '$stok',
                harga_produk = '$harga',
                deskripsi_produk = '$deskripsi'
            WHERE id_produk = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function hapusProduk(array $data): int
{
    $id = $data["id_produk"];
    global $conn;
    mysqli_query($conn, "DELETE FROM data_produk WHERE id_produk = $id");
    return mysqli_affected_rows($conn);
}


function formatHarga(float|int $harga): String
{
    return "Rp. " . number_format($harga, 2, ",", ".");
}
