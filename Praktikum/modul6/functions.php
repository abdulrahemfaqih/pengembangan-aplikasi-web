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


// =============================== CRUD SUPPLIER ============================
function tambahSupplier($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $telepon = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "INSERT INTO supplier VALUES('', '$nama', '$telepon', '$alamat')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function hapusSupplier($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM supplier WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubahSupplier($data)
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



// =========================== CRUD BARANG =========================
function tambahDataBarang($data)
{
    global $conn;
    $kodeBarang = htmlspecialchars($data["kode_barang"]);
    $namaBarang = htmlspecialchars($data["nama_barang"]);
    $hargaBarang = htmlspecialchars($data["harga_barang"]);
    $stokBarang = htmlspecialchars($data["stok_barang"]);
    $supplierId = htmlspecialchars($data["supplier"]);

    $query = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES('$kodeBarang', '$namaBarang', '$hargaBarang', '$stokBarang', '$supplierId')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahBarang($data)
{
    global $conn;
    $id = $data["id"];
    $kodeBarang = htmlspecialchars($data["kode_barang"]);
    $namaBarang = htmlspecialchars($data["nama_barang"]);
    $hargaBarang = htmlspecialchars($data["harga_barang"]);
    $stokBarang = htmlspecialchars($data["stok_barang"]);
    $supplierId = htmlspecialchars($data["supplier"]);

    $query = "UPDATE barang SET
                kode_barang = '$kodeBarang',
                nama_barang = '$namaBarang',
                harga = '$hargaBarang',
                stok = '$stokBarang',
                supplier_id = '$supplierId'
            WHERE id = $id
          ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
};


function hapusbarang($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE id = $id");
    return mysqli_affected_rows($conn);
}


// ==================== CRUD TRANSAKSI  ==============


function hapusTransDetailByBarangId($transId,$id) {
    global $conn;
    mysqli_query($conn,"DELETE FROM transaksi_detail WHERE transaksi_id = $transId AND barang_id = $id");
    return mysqli_affected_rows($conn);
}

function updateTotalBayarbyTransID($totalBayar, $id) {
    global $conn;
    mysqli_query($conn,"UPDATE transaksi SET total = $totalBayar WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function hapusTransaksibyID($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM transaksi WHERE id = $id");
    return mysqli_affected_rows($conn);
}



// ======================== OTHER FUNCTIONS =====================
function formatHarga($harga)
{
    return "Rp. " . number_format($harga,0, ",", ".");
}