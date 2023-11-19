<?php
session_start();
include "function_database.php";

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
if (isset($_POST["tampil"])) {
    $start = $_POST["start"];
    $end = $_POST["end"];
    $data_penjualan = getRangeDate($start, $end);

    if (!empty($data_penjualan)) {
        $total_pendapatan = array_sum(array_column($data_penjualan, 'total'));
        $total_pelanggan = array_sum(array_column($data_penjualan, 'pelanggan'));
    } else {
        $message = "Tidak ada data transaksi di range tanggal tersebut.";
    }
}
$title = "Laporan";
include "layout/header.php"
?>

<div class="pembungkus container">


    <?php if (isset($_POST["tampil"])) : ?>
        <?php if (!empty($data_penjualan)) : ?>
            <div class="visible mt-5">
                <a href="laporan.php" class="btn btn-warning">Kembali</a>
                <button class="btn btn-primary" onclick="printPage()">Print</button>
                <a href="laporan_excel.php?start=<?= $start ?>&end=<?= $end ?>" class="btn btn-success">Excel</a>
            </div>

            <H3 class="mt-4">REKAP LAPORAN PENJUALAH <?= $start ?> SAMPAI <?= $end ?></H3>
            <canvas id="grafik_penjualan"></canvas>
            <div class="table-responsive mt-5">
                <table class="table table-hover table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>NO</th>
                            <th>TOTAL</th>
                            <th>TANGGAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_penjualan as $no => $data) : ?>
                            <tr>
                                <td><?= $no + 1 ?></td>
                                <td><?= formatHarga($data["total"]) ?></td>
                                <td><?= $data["waktu_transaksi"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <table class="table table-hover table-bordered mt-4">
                    <tr class="table-secondary">
                        <th>JUMLAH PELANGGAN</th>
                        <th>JUMLAH PENDAPATAN</th>
                    </tr>
                    <tr>
                        <td><?= $total_pelanggan ?></td>
                        <td><?= formatHarga($total_pendapatan) ?></td>
                    </tr>
                </table>
            </div>
            <script>
                var labels = <?= json_encode(array_column($data_penjualan, 'waktu_transaksi')) ?>;
                var data = <?= json_encode(array_column($data_penjualan, 'total')) ?>;

                var ctx = document.getElementById("grafik_penjualan").getContext("2d");

                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Total Harga",
                            backgroundColor: "rgb(56, 145, 254)",
                            data: data
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                        }
                    }
                });

                function printPage() {
                    $('.container').removeClass('container');

                    window.print();
                    $('.pembungkus').addClass('container');
                }
            </script>
        <?php else : ?>
            <div class="alert alert-warning mt-5 mb-2" role="alert">
                <?= $message ?>
            </div>
            <a href="laporan.php" class="btn btn-warning btn-sm">Kembali</a>
        <?php endif; ?>
    <?php else :  ?>
        <div class="d-flex justify-content-center">
            <div class="card my-4 visible">
                <h5 class="card-header bg-secondary-emphasis">Filter Rekap Penjualan Berdasarkan Tanggal</h5>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row d-flex align-items-center">
                            <div class="col-4">
                                <input name="start" type="date" class="form-control">
                            </div>
                            <div class="col-4">
                                <input name="end" type="date" class="form-control">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-dark btn-sm" type="submit" name="tampil">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php
include "layout/footer.php"
?>