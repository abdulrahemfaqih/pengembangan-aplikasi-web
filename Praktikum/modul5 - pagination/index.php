<?php
require "functions.php";


$limitDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM supplier"));
$jumlahHalaman = ceil($jumlahData / $limitDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($limitDataPerHalaman * $halamanAktif) - $limitDataPerHalaman;

$dataSupplier = query("SELECT * FROM supplier LIMIT $awalData, $limitDataPerHalaman");
mysqli_close($conn);

$pesan = "";

if (empty($dataSupplier)) {
    $pesan = "Data tidak ditemukan.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Halaman Admin</title>
</head>

<body>
    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="container">
            <div class="header">
                <h1>Data Master Supplier</h1>
                <div class="menu">
                    <a href="tambahData.php" class='tambah'>Tambah Data</a>
                </div>
            </div>
            <div class="table-container" id="table-container">
                <table border="1">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th>Tindakan</th>
                    </tr>
                    <?php if (!empty($dataSupplier)) : ?>
                        <?php $i = 1 ?>
                        <?php foreach ($dataSupplier as $sp) : ?>
                            <tr>
                                <td class="nomor">
                                    <p>
                                        <?= $i++ ?>
                                    </p>
                                </td>
                                <td class="nim">
                                    <p>
                                        <?= $sp["nama"] ?>
                                    </p>
                                </td>
                                <td class="nama">
                                    <p>
                                        <?= $sp["telp"] ?>
                                    </p>
                                </td>
                                <td class="email">
                                    <p>
                                        <?= $sp["alamat"] ?>
                                    </p>
                                </td>
                                <td class="aksi">
                                    <a class="edit" href="ubahData.php?id=<?= $sp["id"] ?>">Edit</a>
                                    <a class="hapus" href="hapusData.php?id=<?= $sp["id"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus supplier ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <th colspan="5">Data tidak ditemukan.</th>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
            <div class="navigasi">
                <?php if ($halamanAktif > 1) : ?>
                    <a href="?halaman=<?= $halamanAktif - 1 ?>"><img src="right.png" alt="left"></a>
                <?php endif ?>
                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <?php if ($i == $halamanAktif) : ?>
                        <a href="?halaman=<?= $i ?>" style="background-color:rgb(60, 114, 214);color:white;"><?= $i ?></a>
                    <?php else : ?>
                        <a href="?halaman=<?= $i ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                    <a href="?halaman=<?= $halamanAktif + 1 ?>"><img src="left.png" alt="right"></a>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>

</html>