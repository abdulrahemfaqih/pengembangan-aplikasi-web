<?php
$conn = mysqli_connect("localhost", "root", "", "db_rumahsakit");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function generateID($table, $kolom, $prefix) {

    $lastID = query("SELECT MAX($kolom) as maxID FROM $table")[0];
    $id = $lastID["maxID"];
    $urutan = (int)substr($id, 2, 4);
    $urutan++;
    $new_id = $prefix . sprintf("%04s", $urutan);
    return $new_id;
    return $urutan;
}

function tambah_rekam_medis($data) {
    global $conn;
    $id_rm = $data["id_rm"];
    $id_pasien = htmlspecialchars($data["id_pasien"]);
    $keluhan = htmlspecialchars($data["keluhan"]);
    $id_dokter = htmlspecialchars($data["id_dokter"]);
    $diagnosa = htmlspecialchars($data["diagnosa"]);
    $id_poli = htmlspecialchars($data["id_poli"]);
    $tanggal = htmlspecialchars($data["tgl_periksa"]);

    mysqli_query($conn, "INSERT INTO `tb_rekammedis`
                (id_rm, id_pasien, keluhan, id_dokter, diagnosa, id_poli, tgl_periksa)
                VALUES ('$id_rm', '$id_pasien', '$keluhan', '$id_dokter', '$diagnosa', '$id_poli', '$tanggal')");
    return mysqli_affected_rows($conn);
}

function hapus_rekam_medis($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM `tb_rekammedis` WHERE id_rm = '$id'");
    return mysqli_affected_rows($conn);
}

function ubahrm($data) {
    global $conn;
    $id_rm = $data["id_rm"];
    $id_pasien = $data["id_pasien"];
    $keluhan = $data["keluhan"];
    $id_dokter = $data["id_dokter"];
    $diagnosa = $data["diagnosa"];
    $id_poli = $data["id_poli"];
    $tgl_periksa = $data["tanggal_periksa"];

    $result = mysqli_query( $conn,"UPDATE tb_rekammedis SET
                            id_pasien = '$id_pasien',
                            keluhan = '$keluhan',
                            id_dokter = '$id_dokter',
                            diagnosa = '$diagnosa',
                            id_poli = '$id_poli',
                            tgl_periksa = '$tgl_periksa'
                            WHERE id_rm = '$id_rm'");
    return mysqli_affected_rows($conn);
}

?>