<?php
$currentMenu = isset($_GET['menu']) ? $_GET['menu'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="assets/style.css">
    <title>Penjualan | <?= $title ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container py-2">
            <a class="navbar-brand fw-bold text-secondary" href="index.php">Dashboard Penjualan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentMenu == 'home') ? 'text-light fw-bold' : '' ?>" href="index.php?menu=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentMenu == 'transaksi') ? 'text-light fw-bold' : '' ?>" href="data_transaksi.php?menu=transaksi">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentMenu == 'laporan') ? 'text-light fw-bold' : '' ?>" href="laporan.php?menu=laporan">Laporan</a>
                    </li>
                    <?php if ($_SESSION["level"] == 1) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= ($currentMenu == 'data_barang' || $currentMenu == 'data_supplier' || $currentMenu == 'data_pelanggan' || $currentMenu == 'data_user') ? 'text-light fw-bold' : 'secondary'; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Data Master
                            </a>
                            <div class="dropdown-menu dropdown-menu-dark">
                                <a class="dropdown-item <?= ($currentMenu == 'data_barang') ? 'active' : ''; ?>" href="data_barang.php?menu=data_barang">Data Barang</a>
                                <a class="dropdown-item <?= ($currentMenu == 'data_supplier') ? 'active' : ''; ?>" href="data_supplier.php?menu=data_supplier">Data Supplier</a>
                                <a class="dropdown-item <?= ($currentMenu == 'data_pelanggan') ? 'active' : ''; ?>" href="data_pelanggan.php?menu=data_pelanggan">Data Pelanggan</a>
                                <a class="dropdown-item <?= ($currentMenu == 'data_user') ? 'active' : ''; ?>" href="data_user.php?menu=data_user">Data User</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if (isset(($_SESSION["nama"]))) :
                    $nama = $_SESSION["nama"];
                ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-<?= ($currentMenu == 'profile') ? 'light fw-bold' : 'secondary'; ?>"><?= $nama ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="profile.php?menu=profile">Profile</a></li>
                                <li><a class="dropdown-item bg-danger" href="logout.php" onclick="return confirm('apakah anda yakin ingin logout')">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>