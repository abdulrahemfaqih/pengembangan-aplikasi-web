<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $telepon = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "INSERT INTO supplier VALUES('', '$nama', '$telepon', '$alamat')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM supplier WHERE id = $id");
    return mysqli_affected_rows($conn);
}



function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $telepon = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "UPDATE supplier SET
              nama = '$nama',
              telp = '$telepon',
              alamat = '$alamat'
            WHERE id = $id
          ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
};
