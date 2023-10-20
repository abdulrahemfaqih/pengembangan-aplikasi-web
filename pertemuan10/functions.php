<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "db_warung";

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

function formatHarga(float|int|string $harga): int|float|string
{
    return "Rp. " . number_format($harga, 2, ",", ".");
}

