<?php

$server = "localhost";
$username = "faqih";
$password = "faqih3935";
$database = "produk_gadgetin";

// koneksi
$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error($conn));
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


function tambahData(array $data): int
{
    global $conn;
    $nama = htmlspecialchars($data["nama_produk"]);
    $jenis = htmlspecialchars($data["jenis_produk"]);
    $stok = htmlspecialchars($data["stok_produk"]);
    $harga = htmlspecialchars($data["harga_produk"]);
    $deskripsi = htmlspecialchars($data["deskripsi_produk"]);

    $query = "INSERT INTO tbl_produk (nama_produk, jenis_produk, stok_produk, harga_produk, deskripsi_produk)
                VALUES ('$nama', '$jenis', '$stok', '$harga', '$deskripsi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}   


function ubahProduk(array $data) : int {
    global $conn;
    $id = $_POST["id_produk"];
    $nama = htmlspecialchars($data["nama_produk"]);
    $jenis = htmlspecialchars($data["jenis_produk"]);
    $stok = htmlspecialchars($data["stok_produk"]);
    $harga = htmlspecialchars($data["harga_produk"]);
    $deskripsi = htmlspecialchars($data["deskripsi_produk"]);

    $query = "UPDATE tbl_produk SET
                nama_produk = '$nama',
                jenis_produk = '$jenis',
                stok_produk = '$stok',
                harga_produk = '$harga',
                deskripsi_produk = '$deskripsi'
            WHERE id_produk = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusProduk(array $data) : int {
    global $conn;
    $id = $_POST["id_produk"];
    mysqli_query($conn, "DELETE FROM tbl_produk WHERE id_produk = $id");
    return mysqli_affected_rows($conn);

}

function formatHarga(float|int|string $harga): int|float|string
{
    return "Rp. " . number_format($harga, 2, ",", ".");
}
