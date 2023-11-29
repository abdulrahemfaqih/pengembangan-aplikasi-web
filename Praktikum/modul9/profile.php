<?php
session_start();
include "function_database.php";
$username = $_SESSION["username"];
$data_user = getDataUser($username);


if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
$title = "Data Transaksi";
include "layout/header.php"
?>
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="mt-2">User Profile</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>ID User:</strong>
                            <?= $data_user['id_user']; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Username:</strong>
                            <?= $data_user['username']; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Nama:</strong>
                            <?= $data_user['nama']; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Alamat:</strong>
                            <?= $data_user['alamat']; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>No. HP:</strong>
                            <?= $data_user['hp']; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Level:</strong>
                            <?php $user_level = ($data_user["level"] == 1 ? "Admin" : "User Biasa") ?>
                            <?= $user_level ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "layout/footer.php"
?>