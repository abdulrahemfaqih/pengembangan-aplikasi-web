<?php
session_start();
include "function_database.php";


if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$jumlah_transaksi = CountTransaksi()["jumlah_transaksi"];
$jumlah_supplier = countSupplier()["jumlah_supplier"];
$jumlah_barang = countBarang()["jumlah_barang"];
$jumlah_pendapatan = getAllIncome()["jumlah_pendapatan"];


$title = "Beranda";
include "layout/header.php"
?>
<div class="container my-4">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-blue">
                <div class="inner">
                    <h3><?= $jumlah_transaksi ?></h3>
                    <p>Transaksi</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-cash-register"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-green">
                <div class="inner">
                    <h3><?= $jumlah_supplier ?></h3>
                    <p>Supplier</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-truck-droplet"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3><?= $jumlah_barang ?></h3>
                    <p>Barang</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-red">
                <div class="inner">
                    <h3><?= formatHarga($jumlah_pendapatan); ?></h3>
                    <p>Jumlah Pendapatan</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "layout/footer.php"
?>