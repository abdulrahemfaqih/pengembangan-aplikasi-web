<?php
include "database.php";
$dataPasien = query("SELECT id_pasien, nama_pasien FROM `tb_pasien`");
$dataDokter = query("SELECT id_dokter, nama_dokter FROM `tb_dokter`");
$dataPoli = query("SELECT id_poli, nama_poli FROM `tb_poliklinik`");


if (isset($_POST["submit"])) : ?>
    <?php if (tambah_rekam_medis($_POST) > 0) : ?>
        <script>
            alert("data rekam medis berhasil di tambahkan");
            window.location.href = "index.php"
        </script>
    <?php else : ?>
        <script>
            alert("data rekam medis gagal ditambahkan");
            window.location.href = "index.php"
        </script>
    <?php endif; ?>
<?php endif; ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Tambah Rekam Medis</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container py-2">
            <a class="navbar-brand fw-bold" href="#">Rumah Sakit Trunojoyo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="index.php">Data Rekam Medis</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="card">
            <h5 class="card-header">Tambah Data Rekam Medis</h5>
            <form action="" method="post">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="pasien" class="form-label h6">Pasien</label>
                        <select id="pasien" name="id_pasien" class="form-select" aria-label="Default select example">
                            <option value="" disabled selected>--- Pilih Pasien ---</option>
                            <?php foreach ($dataPasien as $ps) : ?>
                                <option value="<?= $ps["id_pasien"] ?>"><?= $ps["nama_pasien"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keluhan" class="form-label h6">Keluhan</label>
                        <textarea class="form-control" name="keluhan" id="keluhan" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="dokter" class="form-label h6">Dokter</label>
                        <select id="dokter" name="id_dokter" class="form-select" aria-label="Default select example">
                            <option value="" disabled selected>--- Pilih Dokter ---</option>
                            <?php foreach ($dataDokter as $db) : ?>
                                <option value="<?= $db["id_dokter"] ?>"><?= $db["nama_dokter"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="diagnosa" class="form-label h6">Diagnosa</label>
                        <textarea class="form-control" name="diagnosa" id="diagnosa" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="poli" class="form-label h6">Poliklinik</label>
                        <select id="poli" name="id_poli" class="form-select" aria-label="Default select example">
                            <option value="" disabled selected>--- Pilih Poliklinik ---</option>
                            <?php foreach ($dataPoli as $pl) : ?>
                                <option value="<?= $pl["id_poli"] ?>"><?= $pl["nama_poli"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <?php
                        date_default_timezone_set("Asia/Jakarta");
                        $tanggal = date("Y/m/d");
                        ?>
                        <label for="tgl_periksa" class="form-label h6">Tanggal Periksa</label>
                        <input type="text" readonly class="form-control" name="tgl_periksa" id="tgl_periksa" value="<?= $tanggal ?>">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-success m-2">Simpan</button>
                        <a href="index.php" class="btn btn-warning m-2">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>