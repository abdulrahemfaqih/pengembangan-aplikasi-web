<?php
include "database.php";
$dataPasien = query("SELECT id_pasien, nama_pasien FROM `tb_pasien`");
$dataDokter = query("SELECT id_dokter, nama_dokter FROM `tb_dokter`");
$dataPoli = query("SELECT id_poli, nama_poli FROM `tb_poliklinik`");


if (isset($_POST["submit"])) {
    if (tambah_rekam_medis($_POST) > 0) {
        echo "berhasil";
    } else {
        echo "tidak berhasil";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah rekam medis</title>
</head>

<body>
    <form action="" method="post">
        <label for="pasien">id pasien : </label>
        <select name="id_pasien" id="pasien" required>
            <option value="" disabled selected>--- pilih pasien ---</option>
            <?php
            foreach ($dataPasien as $ps) : ?>
                <option value="<?= $ps["id_pasien"] ?>"><?= $ps["nama_pasien"] ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="keluhan">keluhan :</label>
        <textarea name="keluhan" id="keluhan" cols="30" rows="10"></textarea><br>
        <label for="dokter">dokter : </label>
        <select name="id_dokter" id="dokter">
            <option value="" disabled selected>--- pilih dokter ---</option>
            <?php foreach ($dataDokter as $db) : ?>
                <option value="<?= $db["id_dokter"] ?>"><?= $db["nama_dokter"] ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="diagnosa">Diagnosa</label>
        <textarea name="diagnosa" id="diagnosa" cols="30" rows="10"></textarea><br>
        <label for="poli">nama poli</label>
        <select name="id_poli" id="poli">
            <option value="" disabled selected>--- nama poli ---</option>
            <?php foreach ($dataPoli as $pl) : ?>
                <option value="<?= $pl["id_poli"] ?>"><?= $pl["nama_poli"] ?></option>

            <?php endforeach; ?>
        </select><br>
        <label for="tgl">tanggal periksa</label>
        <?php
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date("Y/m/d");
        ?>
        <input type="text" name="tanggal_periksa" readonly value="<?= $tanggal ?> "><br>
        <button type="submit" name="submit">tambah</button>


    </form>
    <a href="index.php"><button>kembali</button></a>

</body>

</html>