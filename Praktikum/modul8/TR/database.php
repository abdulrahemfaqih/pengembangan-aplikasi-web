<?php


function query($query)
{
    $result = mysqli_query(DB, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// ================================ TABEL BARANG ===========================

function tambahDataBarang($data)
{
    $kodeBarang = htmlspecialchars($data["kode_barang"]);
    $namaBarang = htmlspecialchars($data["nama_barang"]);
    $hargaBarang = htmlspecialchars($data["harga_barang"]);
    $stokBarang = htmlspecialchars($data["stok_barang"]);
    $supplierId = htmlspecialchars($data["supplier"]);

    $query = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES('$kodeBarang', '$namaBarang', '$hargaBarang', '$stokBarang', '$supplierId')";
    mysqli_query(DB, $query);

    return mysqli_affected_rows(DB);
}

function ubahBarang($data)
{
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
    mysqli_query(DB, $query);
    return mysqli_affected_rows(DB);
};


function hapusbarang($id)
{
    mysqli_query(DB, "DELETE FROM barang WHERE id = $id");
    return mysqli_affected_rows(DB);
}



// ================================ TABEL SUPPLIER =========================


function tambahSupplier($data)
{

    $nama = htmlspecialchars($data["nama"]);
    $telepon = htmlspecialchars($data["telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "INSERT INTO supplier VALUES('', '$nama', '$telepon', '$alamat')";
    return mysqli_query(DB, $query);
}

function hapusSupplier($id)
{

    return mysqli_query(DB, "DELETE FROM supplier WHERE id = $id");
}

function ubahSupplier($data)
{

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
    return mysqli_query(DB, $query);
};

// =============================== TABEL PELANGGAN ========================

function getAllPelanggan()
{
    return mysqli_query(DB, "SELECT * FROM pelanggan");
}


// ================================ TABEL TRANSAKSI & DETAIL ===============


function getAllTransaksi()
{
    return mysqli_query(DB, "SELECT * FROM transaksi");
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
                            VALUES ('$waktu_transaksi', '$keterangan', '$pelanggan_id', 0 ");
}

function hapusTransaksibyID($id)
{
    mysqli_query(DB, "DELETE FROM transaksi WHERE id = $id");
    return mysqli_affected_rows(DB);
}

function getTotalTrans($transaksi_id) {
    mysqli_query(DB, "SELECT total FROM transaksi WHERE transaksi_id = $transaksi_id")->fetch_assoc()[0];

}


function hapusTransDetailById($id)
{
    mysqli_query(DB, "DELETE FROM transaksi_detail WHERE barang_id = $id");
    return mysqli_affected_rows(DB);
}

function updateTotalBayar($totalBayar, $id)
{
    mysqli_query(DB, "UPDATE transaksi SET total = $totalBayar WHERE id = $id");
    return mysqli_affected_rows(DB);
}

function deteleTransNotInTransDetail()
{
    mysqli_query(DB, "DELETE FROM transaksi WHERE id NOT IN (SELECT transaksi_id FROM transaksi_detail");
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
    level = $level
    WHERE id_user = '$id_user'");
    return mysqli_affected_rows(DB);
}

function getUsername($username)
{
    return mysqli_query(DB, "SELECT * FROM user WHERE username = '$username'")->fetch_assoc();
}


// ============================= FUNGSI LAIN ====================
function formatHarga($harga)
{
    return "Rp. " . number_format($harga, 0, ",", ".");
}
