<?php
include "database.php";

$id_rm = $_GET["id_rm"];
$rekam_medis = query("SELECT * FROM `tb_rekammedis`= $id_rm")[0];

$dataPasien = query("SELECT id_pasien, nama_pasien FROM tb_pasien");
$dataDokter = query("SELECT id_dokter, nama_dokter FROM tb_dokter");
$dataPoli = query("SELECT id_poli, nama_poli FROM tb_poliklinik");

if (isset($_POST["submit"])) : ?>
    <?php if (ubahrm($_POST) > 0) : ?>
        <script>
            alert("data rekam medis berhasil di rubah");
            window.location.href = "index.php"
        </script>
    <?php else : ?>
        <script>
            alert("gagal dirubah");
            window.location.href = "index.php"
        </script>
    <?php endif; ?>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Rekam Medis</title>
</head>

<body>
    <form action="" method="post">
        <input type="hidden" name="id_rm" value="<?= $rekam_medis["id_rm"]; ?>">

        <label for="pasien">Nama Pasien:</label>
        <select name="id_pasien" id="pasien" required>
            <option value="" disabled selected>--- Pilih Pasien ---</option>
            <?php foreach ($dataPasien as $ps) : ?>
                <option value="<?= $ps["id_pasien"] ?>" <?= ($ps["id_pasien"] == $rekam_medis["id_pasien"]) ? "selected" : "" ?>>
                    <?= $ps["nama_pasien"] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="keluhan">Keluhan:</label>
        <textarea name="keluhan" id="keluhan" cols="30" rows="10"><?= $rekam_medis["keluhan"] ?></textarea><br>

        <label for="dokter">Dokter:</label>
        <select name="id_dokter" id="dokter">
            <option value="" disabled selected>--- Pilih Dokter ---</option>
            <?php foreach ($dataDokter as $db) : ?>
                <option value="<?= $db["id_dokter"] ?>" <?= ($db["id_dokter"] == $rekam_medis["id_dokter"]) ? "selected" : "" ?>>
                    <?= $db["nama_dokter"] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="diagnosa">Diagnosa:</label>
        <textarea name="diagnosa" id="diagnosa" cols="30" rows="10"><?= $rekam_medis["diagnosa"] ?></textarea><br>

        <label for="poli">Poli:</label>
        <select name="id_poli" id="poli">
            <option value="" disabled selected>--- Pilih Poli ---</option>
            <?php foreach ($dataPoli as $pl) : ?>
                <option value="<?= $pl["id_poli"] ?>" <?= ($pl["id_poli"] == $rekam_medis["id_poli"]) ? "selected" : "" ?>>
                    <?= $pl["nama_poli"] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="tgl">Tanggal Periksa:</label>
        <input type="text" name="tanggal_periksa"  value="<?= $rekam_medis["tgl_periksa"] ?>"><br>

        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>
    <a href="index.php"><button>Kembali</button></a>
</body>

</html>