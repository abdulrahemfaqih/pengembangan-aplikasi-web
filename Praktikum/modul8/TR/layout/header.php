<?php
$currentMenu = isset($_GET['menu']) ? $_GET['menu'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Penjualan | <?= $title ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="pembungkus container py-2">
            <a class="navbar-brand fw-bold text-secondary" href="#">Dashboard Penjualan</a>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto"> <!-- mx-auto untuk membuat menu berada di tengah -->
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentMenu == 'home') ? 'active' : '' ?>" href="index.php?menu=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentMenu == 'transaksi') ? 'active' : '' ?>" href="data_transaksi.php?menu=transaksi">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentMenu == 'laporan') ? 'active' : '' ?>" href="laporan.php?menu=laporan">Laporan</a>
                    </li>
                    <?php if ($_SESSION["level"] == 1) : ?>
                        <li class="nav-item dropdown ">
                            <button class="btn btn-dark  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-<?= ($currentMenu == 'data_barang' || $currentMenu == 'data_supplier' || $currentMenu == 'data_pelanggan' || $currentMenu == 'data_user') ? 'light' : 'secondary'; ?>">Data Master</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item <?= ($currentMenu == 'data_barang') ? 'active' : ''; ?>" href="data_barang.php?menu=data_barang">Data Barang</a></li>
                                <li><a class="dropdown-item <?= ($currentMenu == 'data_supplier') ? 'active' : ''; ?>" href="data_supplier.php?menu=data_supplier">Data Supplier</a></li>
                                <li><a class="dropdown-item <?= ($currentMenu == 'data_pelanggan') ? 'active' : ''; ?>" href="data_pelanggan.php?menu=data_pelanggan">Data Pelanggan</a></li>
                                <li><a class="dropdown-item <?= ($currentMenu == 'data_user') ? 'active' : ''; ?>" href="data_user.php?menu=data_user">Data User</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if (isset(($_SESSION["username"]))) :
                    $username = $_SESSION["username"];
                ?>
                    <ul class="navbar-nav ml-auto"> <!-- ml-auto untuk membuat menu di sebelah kanan -->
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-<?= ($currentMenu == 'profile') ? 'light' : 'secondary'; ?>"><?= $username ?></span>
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