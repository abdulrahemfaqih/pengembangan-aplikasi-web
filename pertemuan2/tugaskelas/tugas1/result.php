<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $nilai = $_POST["nilai"];
    // if ($nilai >= 80) {
    //     $hasil = "A";
    // } elseif ($nilai >= 70 && $nilai < 80) {
    //     $hasil = "B";
    // } elseif ($nilai >= 60 && $nilai < 70) {
    //     $hasil = "C";
    // } elseif ($nilai >= 55 && $nilai < 60) {
    //     $hasil = "D";
    // } else {
    //     $hasil = "E";
    // }

    // if ($hasil) {
    //     echo "nilai anda " . $nilai . " mendapatakan predikat = " . $hasil;
    // }


    $nilaiAwal = $_POST["nilaiAwal"];
    $nilaiAkhir = $_POST["nilaiAkhir"];

    // while ($nilaiAwal <= $nilaiAkhir) {
    //     echo "$nilaiAwal<br>";
    //     $nilaiAwal++;
    // }
    // for ($i = $nilaiAwal; $i <= $nilaiAkhir; $i++) {
    //     echo "$i<br>";
    // }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .input {
            width: 500px;
            display: flex;
            justify-content: space-between;
        }

        .hasil {
            width: 500px;
            border: 3px solid black;
            padding: 2rem;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
    </style>

</head>

<body>
    <div class="section">
        <div class="input">
            <?= "<span>niali awal = $nilaiAwal</span>" ?>
            <?= "<span>nilai akhir = $nilaiAkhir</span>" ?>
        </div>
        <div class="hasil">
            <?php
            // while ($nilaiAwal <= $nilaiAkhir) {
            //     echo "$nilaiAwal<br>";
            //     $nilaiAwal++;
            // }
            for ($i = $nilaiAwal; $i <= $nilaiAkhir; $i++) {
                echo "<span>$i</span>";
            }
            ?>
        </div>
    </div>
</body>

</html>