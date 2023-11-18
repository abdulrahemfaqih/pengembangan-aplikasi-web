<?php
include "functions.php";
// ambil no meja jika di url ada
if (isset($_GET["no_meja"])) {
    $no_meja = $_GET["no_meja"];
} else {
    $no_meja = null;
}


// menghapus order jika order tidak digunakan di order detil
deleteOrderWhereNotInDetil();

// ambil semua pelayan
$getPelayan = getAllPelayan();

// set timezone daerah indonesia
date_default_timezone_set("Asia/Jakarta");
$tanggal_sekarang = date("Y-m-d");
$jam_sekarang = date("H:i:s");


if (isset($_POST["lanjut_pesan"])) {
    $no_meja = $_POST["no_meja"];
    $info_meja_sebelumnya = getInfoMejaSebelumnya($no_meja);
    if (!empty($info_meja_sebelumnya)) {
        $meja = $info_meja_sebelumnya["no_meja"];
        $jam = $info_meja_sebelumnya["jam_order"];
        $tanggal = $info_meja_sebelumnya["tgl_order"];
        $jam_tersedia = date("H:i:s", strtotime("+15 minutes", strtotime($jam)));
        if ($jam_sekarang < $jam_tersedia && $tanggal_sekarang <= $tanggal) {
            echo "<script>alert('Sorry banget nih, no meja $no_meja masih digunakan, tunggu sampai $jam_tersedia');
            window.location.href = 'form_order.php?no_meja=$no_meja&&qr=true'
            </script>";
            exit;
        }
    }

    if (tambahOrder($_POST) > 0) {
        $id_order = mysqli_insert_id(DB);
        if (isset($_GET["no_meja"])) {
            header("Location: form_order_detil.php?id_order=" . $id_order . "&qr=true");
        } else {
            header("Location: form_order_detil.php?id_order=" . $id_order);
        }
    } else {
        echo "<script>alert('Order gagal ditambah')</script>";
    }
}



$title = "FORM ORDER ";
include "layout/header.php"
?>
<div class="container">
    <div class="card my-4">
        <h5 class="card-header">Form Order </h5>
        <form action="" method="post">
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th>TANGGAL ORDER</th>
                                <th>JAM ORDER</th>
                                <th>NAMA PELAYAN</th>
                                <th>NO MEJA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" required class="form-control" value="<?= $tanggal_sekarang ?>" name="tanggal_order"></td>
                                <td><input type="text" required class="form-control" readonly value="<?= $jam_sekarang ?>" name="jam_order"></td>
                                <td>
                                    <select required class="form-select" name="id_pelayan">
                                        <option value="" disabled selected>Pilih Pelayan</option>
                                        <?php foreach ($getPelayan as $pelayan) : ?>
                                            <option value="<?= $pelayan["id_pelayan"] ?>"><?= $pelayan["nama_pelayan"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><input type="number" required class="form-control" <?= ($no_meja) ? "value = '$no_meja' readonly" : "" ?> name="no_meja" placeholder="Inputkan no_meja"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <?php if (!isset($_GET["qr"])) : ?>
                        <a href="data_order.php" class="btn btn-secondary">Kembali</a>
                    <?php endif; ?>
                    <button type="submit" name="lanjut_pesan" class="btn btn-primary">Lanjut Pemesanan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include "layout/footer.php" ?>