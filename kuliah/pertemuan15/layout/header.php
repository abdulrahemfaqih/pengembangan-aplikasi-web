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
    <link rel="stylesheet" href="assets/css/global.css">
    <title>Penjualan | <?= $title ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="pembungkus container py-2">
            <?php if (isset($_SESSION["login"])) : ?>
            <a class="navbar-brand fw-bold text-secondary <?= ($currentMenu == 'beranda') ? 'text-light fw-bold' : '' ?>" href="index.php?menu=beranda">Waroeng Faqih</a>
            <?php else : ?>
                <a class="navbar-brand fw-bold text-secondary">Waroeng Faqih</a>
            <?php endif; ?>
            <?php if (isset($_SESSION["login"])) : ?>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav mx-auto">
                        <?php if($_SESSION["level"] == "admin") : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($currentMenu == 'menu') ? 'text-light fw-bold' : '' ?>" href="data_menu.php?menu=menu">Menu</a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($currentMenu == 'order') ? 'text-light fw-bold' : '' ?>" href="data_order.php?menu=order">Order</a>
                        </li>

                    </ul>
                    <?php if (isset($_SESSION["login"]) && isset($_SESSION["nama"])) :
                    $nama = $_SESSION["nama"];
                    ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-secondary"><?= $nama ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item bg-danger" href="logout.php" onclick="return confirm('apakah anda yakin ingin logout')">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </nav>