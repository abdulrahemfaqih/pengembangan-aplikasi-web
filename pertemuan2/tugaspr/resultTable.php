<?php
$jumlahMahaiswa = $_POST["jumlahMahasiswa"];

for ($i = 1; $i <= $jumlahMahaiswa; $i++) {
    $nama = trim($_POST["mahasiswa$i"]);
    $nilai = trim($_POST["nilaimahasiswa$i"]);
    if (!empty($nama) && !empty($nilai)) {
        $dataMahasiswa[] = [
            "nama" => $nama,
            "nilai" => $nilai
        ];
    }
}
if (!empty($dataMahasiswa)) {
    $nilaiList = array_column($dataMahasiswa, "nilai");
    $minNilai = min($nilaiList);
    $maxNilai = max($nilaiList);
    foreach ($dataMahasiswa as $mahasiswa) {
        if ($mahasiswa["nilai"] == $minNilai) {
            $namaMahasiswaNilaiRendah[] = $mahasiswa["nama"];
        } elseif ($mahasiswa["nilai"] == $maxNilai) {
            $namaMahasiswaNilaiTinggi[] = $mahasiswa["nama"];
        }
    }
    var_dump($namaMahasiswaNilaiRendah);
    $totalNilai = array_sum($nilaiList);
    $countNilai = count($nilaiList);
    $averageNilai = $countNilai > 0 ? $totalNilai / $countNilai : 0;
} else {
    echo "data tidak valid";
    die;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Nilai</title>
     <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap");
        * { padding: 0; margin: 0; font-family: "Poppins", sans-serif; }
        body { padding: 2rem; }
        h1, table, ol { margin-bottom: 1rem; }
        thead th { padding: 0 1rem; }
        tbody td { text-align: center; padding: 0.2rem; }
        tbody td:nth-child(2) {text-align: left;}
        ol,ul { padding-left: 1rem; }
    </style>
</head>

<body>
    <div class="container">
        <h1>Table Rekap Nilai</h1>
        <table border="1" cellspacing="0">
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
        <ul>
            <li>
                Nama dengan nilai tertinggi:
                <ol>
                    <?php foreach ($namaMahasiswaNilaiTinggi as $nama) : ?>
                    <li><?= "$nama-> $maxNilai"  ?></li>
                    <?php endforeach ?>
                </ol>
            </li>
            <li>Nama dengan nilai terendah =
                <ol>
                    <?php foreach ($namaMahasiswaNilaiRendah as $nama) : ?>
                    <li><?= "$nama -> $minNilai"  ?></li>
                    <?php endforeach ?>
                </ol>
            </li>
            <li>Nilai Rata-Rata = <?= round($averageNilai,2)?></li>
        </ul>
    </div>
</body>

</html>