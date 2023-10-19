<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Pengolahan Bilangan</title>
</head>

<body>
    <h2>Menu Program</h2>
    <form action="" method="post">
        <button name="modus">Mencari Modus</button>
        <button name="ascending">Mengurutkan Bilangan (Terkecil ke Terbesar)</button><br><br>
        <button name="median">Mencari Nilai Tengah (Median)</button>
        <button name="descending">Mengurutkan Bilangan (Terbesar ke Terkecil)</button>
    </form>

    <?php if (isset($_POST["modus"])) : ?>
        <h3>Menu Mencari Modus</h3>
        <form action="" method="post">
            <label for="inputBilanganModus">Masukkan sejumlah bilangan bulat (pisahkan dengan spasi)</label><br><br>
            <input type="text" name="inputBilanganModus" placeholder="2 3 1 2 2 5 5 6 7"><br><br>
            <button type="submit" name="hitungModus">Cari Modus</button>
        </form>
    <?php endif; ?>

    <?php if (isset($_POST["ascending"])) : ?>
        <h3>Menu Mengurutkan Bilangan dari Terkecil ke Terbesar</h3>
        <form action="" method="post">
            <label for="inputBilanganAscending">Masukkan sejumlah bilangan bulat (pisahkan dengan spasi)</label><br><br>
            <input type="text" name="inputBilanganAscending" placeholder="2 3 1 2 2 5 5 6 7"><br><br>
            <button type="submit" name="sortingAsc">Urutkan</button>
        </form>
    <?php endif; ?>

    <?php if (isset($_POST["median"])) : ?>
        <h3>Menu Mencari Nilai Tengah (Median)</h3>
        <form action="" method="post">
            <label for="inputBilanganMedian">Masukkan sejumlah bilangan bulat (pisahkan dengan spasi)</label><br><br>
            <input type="text" name="inputBilanganMedian" placeholder="2 3 1 2 2 5 5 6 7"><br><br>
            <button type="submit" name="hitungMedian">Cari Median</button>
        </form>
    <?php endif; ?>

    <?php if (isset($_POST["descending"])) : ?>
        <h3>Menu Mengurutkan Bilangan dari Terbesar ke Terkecil</h3>
        <form action="" method="post">
            <p>Masukkan sejumlah bilangan bulat (pisahkan dengan spasi)</p>
            <label for="inputX">Bilangan X</label>
            <input type="text" name="inputX" placeholder="2 3 1 2 2 5 5 6 7"><br><br>
            <label for="inputY">Bilangan Y</label>
            <input type="text" name="inputY" placeholder="2 3 1 2 2 5 5 6 7"><br><br>
            <button type="submit" name="sortingDesc">Urutkan</button>
        </form>
    <?php endif; ?>

    <?php
    $hasilModus = "";
    $hasilAscending = "";
    $hasilMedian = "";
    $hasilDescending = "";

    if (isset($_POST["hitungModus"])) {
        if (isset($_POST["inputBilanganModus"])) {
            $inputBilanganModus = $_POST["inputBilanganModus"];
            $bilanganModus = explode(" ", $inputBilanganModus);
            $countModus = array_count_values($bilanganModus);
            arsort($countModus);
            $modesModus = array_keys($countModus);
            $hasilModus = "Modus: " . $modesModus[0];
        }
    }

    if (isset($_POST["sortingAsc"])) {
        if (isset($_POST["inputBilanganAscending"])) {
            $inputBilanganAscending = $_POST["inputBilanganAscending"];
            $bilanganAscending = explode(" ", $inputBilanganAscending);

            sort($bilanganAscending);
            $hasilAscending = "Bilangan terurut dari terkecil ke terbesar: " . implode(" ", $bilanganAscending);
        }
    }

    if (isset($_POST["hitungMedian"])) {
        if (isset($_POST["inputBilanganMedian"])) {
            $inputBilanganMedian = $_POST["inputBilanganMedian"];
            $bilanganMedian = explode(" ", $inputBilanganMedian);

            sort($bilanganMedian);
            $countMedian = count($bilanganMedian);
            $middleMedian = floor($countMedian / 2);

            if ($countMedian % 2 == 0) {
                $median = ($bilanganMedian[$middleMedian - 1] + $bilanganMedian[$middleMedian]) / 2;
            } else {
                $median = $bilanganMedian[$middleMedian];
            }
            $hasilMedian = "Nilai Tengah (Median): " . $median;
        }
    }

    if (isset($_POST["sortingDesc"])) {
        if (isset($_POST["inputX"]) && isset($_POST["inputY"])) {
            $inputX = $_POST["inputX"];
            $inputY = $_POST["inputY"];
            $bilanganX = explode(" ", $inputX);
            $bilanganY = explode(" ", $inputY);

            $gabungkanBilangan = array_merge($bilanganX, $bilanganY);
            rsort($gabungkanBilangan);
            $hasilDescending = "Bilangan X dan Y urut dari terbesar ke terkecil: " . implode(" ", $gabungkanBilangan);
        }
    }
    ?>

    <?php if (!empty($hasilModus)) : ?>
        <h3>Hasil Perhitungan Modus</h3>
        <p><?php echo $hasilModus; ?></p>
    <?php endif; ?>

    <?php if (!empty($hasilAscending)) : ?>
        <h3>Hasil Perhitungan Mengurutkan (Ascending)</h3>
        <p><?php echo $hasilAscending; ?></p>
    <?php endif; ?>

    <?php if (!empty($hasilMedian)) : ?>
        <h3>Hasil Perhitungan Median</h3>
        <p><?php echo $hasilMedian; ?></p>
    <?php endif; ?>

    <?php if (!empty($hasilDescending)) : ?>
        <h3>Hasil Perhitungan Mengurutkan (Descending)</h3>
        <p><?php echo $hasilDescending; ?></p>
    <?php endif; ?>
</body>

</html>