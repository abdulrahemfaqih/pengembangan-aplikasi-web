<?php
// koneksi database
$conn = mysqli_connect("localhost","root","","db_menu");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $ketersediaan = htmlspecialchars($data["ketersediaan"]);
    $harga = htmlspecialchars($data["harga"]);

    $query = "INSERT INTO menu VALUES('', '$nama', '$harga', '$ketersediaan')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahMenu($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $ketersediaan = htmlspecialchars($data["ketersediaan"]); // Ambil data ketersediaan

    $query = "UPDATE menu SET
              nama = '$nama',
              harga = '$harga',
              ketersediaan = '$ketersediaan'
            WHERE id = $id
          ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function hapusMenu($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM menu WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function formatHarga($harga)
{
    return "Rp " . number_format($harga, 0, ",", ".");
}