<?php
define("DB", mysqli_connect("localhost", "root", "", "penjualan"));


// ================================ TABEL BARANG ===========================


function getAllDataBarang()
{
    return mysqli_query(DB, "SELECT supplier.nama, barang.* FROM barang
    JOIN supplier ON barang.supplier_id = supplier.id;")->fetch_all(MYSQLI_ASSOC);
}

function tambahDataBarang($data)
{
    $kodeBarang = htmlspecialchars($data["kode_barang"]);
    $namaBarang = htmlspecialchars($data["nama_barang"]);
    $hargaBarang = htmlspecialchars($data["harga_barang"]);
    $stokBarang = htmlspecialchars($data["stok_barang"]);
    $supplierId = htmlspecialchars($data["supplier"]);

    $query = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES('$kodeBarang', '$namaBarang', '$hargaBarang', '$stokBarang', '$supplierId')";
    return mysqli_query(DB, $query);
}



function ubahBarang($data)
{
    $id = $data["id_barang"];
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
    return mysqli_query(DB, $query);
};


function hapusbarang($id)
{
    return mysqli_query(DB, "DELETE FROM barang WHERE id = $id");
}

function countBarang()
{
    return mysqli_query(DB, "SELECT COUNT(id) AS jumlah_barang FROM barang")->fetch_assoc();
}
function getBarangNotInTransDetailByIdTrans($transaksi_id)
{
    return mysqli_query(DB, "SELECT * FROM barang WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $transaksi_id)")->fetch_all(MYSQLI_ASSOC);
}

function countBarangInTransDetail($id_barang)
{
    return mysqli_query(DB, "SELECT COUNT(barang_id) AS jumlah FROM transaksi_detail WHERE barang_id = $id_barang")->fetch_assoc();
}
function getHargaByIdBarang($id_barang)
{
    return mysqli_query(DB, "SELECT harga FROM barang WHERE id = $id_barang")->fetch_assoc();
}



// ================================ TABEL SUPPLIER =========================


function tambahSupplier($data)
{

    $nama = htmlspecialchars($data["nama_supplier"]);
    $telepon = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    return mysqli_query(DB, "INSERT INTO supplier (nama, telp, alamat)
    VALUES
    ('$nama', '$telepon', '$alamat')");
}

function hapusSupplier($id_supplier)
{

    return mysqli_query(DB, "DELETE FROM supplier WHERE id = $id_supplier");
}

function ubahSupplier($data)
{

    $id = $data["id_supplier"];
    $nama = htmlspecialchars($data["nama_supplier"]);
    $telepon = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "UPDATE supplier SET
              nama = '$nama',
              telp = '$telepon',
              alamat = '$alamat'
            WHERE id = $id
          ";
    return mysqli_query(DB, $query);
};

function getAllSupplier()
{
    return mysqli_query(DB, "SELECT * FROM supplier")->fetch_all(MYSQLI_ASSOC);
}

function countSupplier()
{
    return mysqli_query(DB, "SELECT count(id) AS jumlah_supplier FROM supplier")->fetch_assoc();
}
function countSupplierInBarang($id_supplier) {
    return mysqli_query(DB, "SELECT COUNT(supplier_id) AS jumlah FROM barang WHERE supplier_id = $id_supplier")->fetch_assoc();
}

// =============================== TABEL PELANGGAN ========================

function getAllPelanggan()
{
    return mysqli_query(DB, "SELECT * FROM pelanggan")->fetch_all(MYSQLI_ASSOC);
}

function tambahPelanggan($data)
{
    $nama = htmlspecialchars($data["nama_pelanggan"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $no_telp = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    return mysqli_query(DB, "INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat)
    VALUES
    ('$nama','$jenis_kelamin', '$no_telp', '$no_telp')");
}


function editPelangan($data)
{
    $id_pelanggan = htmlspecialchars($data["id_pelanggan"]);
    $nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $no_telp = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    return mysqli_query(DB, "UPDATE pelanggan SET
    nama = '$nama_pelanggan', jenis_kelamin = '$jenis_kelamin', telp = '$no_telp', alamat = '$alamat'
    WHERE id = $id_pelanggan
    ");
}

function hapusPelanggan($id_pelanggan)
{
    return mysqli_query(DB, "DELETE FROM pelanggan WHERE id = $id_pelanggan");
}

function countPelangganInTransDetail($id_pelanggan)
{
    return mysqli_query(DB, "SELECT COUNT(pelanggan_id) AS jumlah FROM transaksi WHERE pelanggan_id = $id_pelanggan")->fetch_assoc();
}
// ================================ TABEL TRANSAKSI & DETAIL ===============


function getAllTransaksi()
{
    return mysqli_query(DB, "SELECT pelanggan.nama, transaksi.* FROM transaksi
    JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id")->fetch_all(MYSQLI_ASSOC);
}

function getTransaksiJoinBarang($transaksi_id)
{
    return mysqli_query(DB, "SELECT transaksi_detail.transaksi_id, transaksi_detail.barang_id, barang.nama_barang, transaksi_detail.harga, transaksi_detail.qty, barang.kode_barang
        FROM transaksi_detail
        LEFT JOIN barang ON barang.id = transaksi_detail.barang_id
        WHERE transaksi_detail.transaksi_id = $transaksi_id
        ORDER BY transaksi_detail.transaksi_id")->fetch_all(MYSQLI_ASSOC);
}

function tambahTransaksi($data)
{
    $waktu_transaksi = htmlspecialchars($data["waktu_transaksi"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $pelanggan_id = htmlspecialchars($data["pelanggan_id"]);

    return mysqli_query(DB, "INSERT INTO transaksi (waktu_transaksi, keterangan, pelanggan_id, total)
                            VALUES ('$waktu_transaksi', '$keterangan', '$pelanggan_id', 0) ");
}

function hapusTransaksibyID($id)
{
    return mysqli_query(DB, "DELETE FROM transaksi WHERE id = $id");
}

function getTotalTrans($transaksi_id)
{
    mysqli_query(DB, "SELECT total FROM transaksi WHERE id = $transaksi_id")->fetch_assoc();
}


function hapusTransDetailByBarangId($transId, $id)
{
    return mysqli_query(DB, "DELETE FROM transaksi_detail WHERE transaksi_id = $transId AND barang_id = $id");
}

function updateTotalBayar($transaksi_id)
{
    mysqli_query(DB, "UPDATE transaksi SET total = (SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_id = $transaksi_id) WHERE id = $transaksi_id");
    return mysqli_affected_rows(DB);
}

function deteleTransNotInTransDetail()
{
    mysqli_query(DB, "DELETE FROM transaksi WHERE id NOT IN (SELECT transaksi_id FROM transaksi_detail");
}
function getRangeDate($start, $end)
{
    return mysqli_query(DB, "SELECT count(pelanggan_id) as pelanggan, waktu_transaksi, sum(total) as total
    FROM transaksi WHERE waktu_transaksi BETWEEN '$start' AND '$end' GROUP BY waktu_transaksi")->fetch_all(MYSQLI_ASSOC);
}


function getAllIncome()
{
    return mysqli_query(DB, "SELECT SUM(total) as jumlah_pendapatan FROM transaksi")->fetch_assoc();
}

function CountTransaksi()
{
    return mysqli_query(DB, "SELECT COUNT(id) as jumlah_transaksi FROM transaksi")->fetch_assoc();
}

function deleteTransWhereNotInDetil()
{
    mysqli_query(DB, "DELETE FROM transaksi WHERE id NOT IN (SELECT transaksi_id FROM transaksi_detail)");
}

function getTransaksiById($id_transaksi)
{
    return mysqli_query(DB, "SELECT transaksi.* , pelanggan.nama FROM transaksi
    JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    WHERE transaksi.id = $id_transaksi")->fetch_assoc();
}

function getTransaksiDetailByIdTrans($transaksi_id)
{
    return mysqli_query(DB, "SELECT transaksi_detail.transaksi_id, transaksi_detail.barang_id, barang.kode_barang, barang.nama_barang, barang.harga, transaksi_detail.qty
    FROM transaksi_detail
    LEFT JOIN barang ON barang.id = transaksi_detail.barang_id
    WHERE transaksi_detail.transaksi_id = $transaksi_id
    ORDER BY transaksi_detail.transaksi_id")->fetch_all(MYSQLI_ASSOC);
}

function addTransaksiDetail($transaksi_id, $barang_id, $harga, $qty)
{
    return mysqli_query(DB, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
    VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')");
}

function getTotalByIdTrans($id_transaksi)
{
    return mysqli_query(DB, "SELECT total FROM transaksi WHERE id = $id_transaksi")->fetch_assoc();
}


// ================================ TABEL USER ==============================
function getAllUser()
{
    return mysqli_query(DB, "SELECT * FROM user")->fetch_all(MYSQLI_ASSOC);
}

function tambah_user($data)
{
    $username = htmlspecialchars($data["username"]);
    $password = md5(htmlspecialchars($data["password"]));
    $nama = htmlspecialchars($data["nama_user"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $level = htmlspecialchars($data["level"]);

    mysqli_query(DB, "INSERT INTO `user`
    (username, password, nama, alamat, hp, level)
    VALUES ('$username', '$password', '$nama', '$alamat', '$no_hp', $level)");
    return mysqli_affected_rows(DB);
}

function hapus_user($id_user)
{
    mysqli_query(DB, "DELETE FROM `user` WHERE id_user = '$id_user'");
    return mysqli_affected_rows(DB);
}

function ubah_user($data)
{
    $id_user = $data["id_user"];
    $username = htmlspecialchars($data["username"]);
    $nama = htmlspecialchars($data["nama_user"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $level = htmlspecialchars($data["level"]);

    mysqli_query(DB, "UPDATE user SET
    username = '$username',
    nama = '$nama',
    alamat = '$alamat',
    hp = '$no_hp',
    `level` = '$level'
    WHERE id_user = '$id_user'");
    return mysqli_affected_rows(DB);
}

function getDataUser($username)
{
    return mysqli_query(DB, "SELECT * FROM user WHERE username = '$username'")->fetch_assoc();
}


// ============================= FUNGSI LAIN ====================

function generateID($table, $kolom, $prefix)
{

    $lastID = mysqli_query(DB, "SELECT MAX($kolom) as maxID FROM $table")->fetch_assoc();
    $id = $lastID["maxID"];
    $urutan = (int)substr($id, 2, 3);
    $urutan++;
    $new_id = $prefix . sprintf("%03s", $urutan);
    return $new_id;
}

function formatHarga($harga)
{
    return "Rp. " . number_format($harga, 0, ",", ".");
}
