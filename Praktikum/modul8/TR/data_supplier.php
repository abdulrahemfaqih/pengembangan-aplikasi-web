<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
$title = "Data Supplier";
include "layout/header.php"
?>
<div class="container my-4">
    <h1>halaman Data Supplier</h1>
</div>
<?php
include "layout/footer.php"
?>