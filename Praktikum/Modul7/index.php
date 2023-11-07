<?php
include "database.php";

// $data_rekam_medis = query("SELECT * FROM `tb_rekammedis` ORDER BY id_rm  DESC");
$data_rekam_medis = query("SELECT rm.*, pasien.nama_pasien, dokter.nama_dokter, poli.nama_poli FROM tb_rekammedis AS rm
                            JOIN tb_pasien AS pasien ON rm.id_pasien = pasien.id_pasien
                            JOIN tb_dokter AS dokter ON rm.id_dokter = dokter.id_dokter
                            JOIN tb_poliklinik AS poli ON rm.id_poli = poli.id_poli
                            ORDER BY id_rm DESC");

if (isset($_GET["hapus"])) {
    $id = $_GET["hapus"];
    if (hapus_rekam_medis($id) > 0) {
        echo "berhasil dihapus";
        header("Location: index.php");
    } else {
        echo "tidak berhasil";
        header("Location: index.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Data Rekam Medis </title>
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
            <h5 class="card-header">Data Rekam Medis</h5>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Rekam Medis</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th>NO</th>
                                <th>ID RM</th>
                                <th>NAMA PASIEN</th>
                                <th>KELUHAN</th>
                                <th>NAMA DOKTER</th>
                                <th>DIAGNOSA</th>
                                <th>ID POLI</th>
                                <th>TGL PERIKSA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_rekam_medis as $rm) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $rm["id_rm"] ?></td>
                                    <td><?= $rm["nama_pasien"] ?></td>
                                    <td style="width: 200px;"><?= $rm["keluhan"] ?></td>
                                    <td><?= $rm["nama_dokter"] ?></td>
                                    <td style="width: 250px;"><?= $rm["diagnosa"] ?></td>
                                    <td><?= $rm["nama_poli"] ?></td>
                                    <td><?= $rm["tgl_periksa"] ?></td>
                                    <td style="width: 130px;">
                                        <div class="d-flex justify-content-around">
                                            <a class="btn btn-danger btn-sm" href="index.php?hapus=<?= $rm["id_rm"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus rekammedis ini?')">
                                                hapus
                                            </a>
                                            <a class="btn btn-warning btn-sm" href="ubah.php?id_rm=<?= $rm["id_rm"] ?>">
                                                edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>