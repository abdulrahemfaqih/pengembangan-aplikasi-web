<?php
require "rute.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Rute Terpendek</title>
</head>

<body>
    <div class="container my-4">
        <h2 class="text-center">Mencari Rute Terpendek 15 Kota di Pulau Jawa</h2>
        <div class="container my-4 w-50 card">
            <div class="card-header">
                Perutean Jalur Terpendek
            </div>
            <form action="" method="post">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="kota_awal" class="py-2">Pilih Kota Awal</label>
                        <select class="form-select" aria-label="Default select example" name="kota_asal">
                            <option selected>Pilih Kota Awal</option>
                            <?php foreach ($data_koordinat as $index => $value) : ?>
                                <option value="<?= $index ?>"><?= $index ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kota_tujuan" class="py-2">Pilih Kota Tujuan</label>
                        <select class="form-select" aria-label="Default select example" id="kota_tujuan" name="kota_tujuan">
                            <option selected>Pilih Kota Tujuan</option>
                            <?php foreach ($data_koordinat as $index => $value) : ?>
                                <option value="<?= $index ?>"><?= $index ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST["submit"])) :
            $kota_asal = $_POST["kota_asal"];
            $kota_tujuan = $_POST["kota_tujuan"];
            $hasil = dijkstra($data_jarak, $kota_asal, $kota_tujuan);; ?>
            <h4 class="text-center">Rute terpendek dari <?= $kota_asal ?> ke <?= $kota_tujuan ?></h4>
            <p class="text-center">⬇️</p>
            <p class="text-center"><?= implode(" -> ", $hasil["rute"]) . ' (' . number_format($hasil['totalJarak'], 2). ' Km)' ?></p>

            <img src="graph.svg" class="mx-auto d-block">


        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>