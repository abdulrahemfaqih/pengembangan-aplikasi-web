<?php

$banyakMahasiswa = $_POST["jumlahSiswa"];
$dataMahasiswa = [];

for ($i = 1; $i <= $banyakMahasiswa; $i++) {
    $namaMahasiswa = $_POST["mahasiswa$i"];
    $nilaiMahasiswa = $_POST["nilaimahasiswa$i"];

    $dataMahasiswa[] = [
        "nama" => $namaMahasiswa,
        "nilai" => $nilaiMahasiswa
    ];
}

if (!empty($dataMahasiswa)) {
    $nilaiNilai = array_column($dataMahasiswa, "nilai");
    $nilaiMin = min($nilaiNilai);
    $nilaiMax = max($nilaiNilai);
    $nilaiTotal = array_sum($nilaiNilai);
    $jumlahNilai = count($nilaiNilai);

    $rataRata = $jumlahNilai > 0 ? $nilaiTotal / $jumlahNilai : 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Nilai</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahaiswa</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataMahasiswa as $index => $mahasiswa) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $mahasiswa["nama"] ?></td>
                    <td><?= $mahasiswa["nilai"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><?= $nilaiMin ?></p>
    <p><?= $nilaiMax ?></p>
    <p><?= $rataRata ?></p>
</body>

</html>