<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
$title = "Transaki Detail";
include "layout/header.php"
?>
<div class="container my-4">
    <h1>halaman Form Transaksi Detail</h1>
</div>
<?php
include "layout/footer.php"
?>