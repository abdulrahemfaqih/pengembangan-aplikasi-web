<?php

session_start();
if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


$title = "BERANDA";
include "layout/header.php"
?>
<div>
    <div class="container d-flex align-items-center justify-content-center" style="height: 90.5vh;">
        <div class="text-center">
            <h1 class="display-2 fw-bold mb-4">Selamat Datang Di Warung Faqih</h1>
            <div class="menu">
                <a class="btn btn-primary mr-2" href="data_menu.php">Data Menu</a>
                <a class="btn btn-secondary" href="data_order.php">Data Order</a>
            </div>
        </div>
    </div>
</div>

<?php include "layout/footer.php" ?>