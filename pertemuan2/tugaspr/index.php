<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <section class="inputJumlah">
        <div class="containerForm">
            <form method="post">
                <h1>Form</h1>
                <label for="jumlahSiswa">Ingin menginputkan berapa siswa</label>
                <input type="number" name="jumlahSiswa" id="jumlahsiswa" placeholder="inputkan jumlah siswa">
                <div class="btn">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <section class="resultForm">
        <?php if (isset($_POST["submit"])) :
            $banyakMahasiswa = $_POST["jumlahSiswa"]
        ?>
            <form action="resultTable.php" method="post">
                <div class="form">
                    <?php for ($i = 1; $i <= $banyakMahasiswa; $i++) : ?>
                        <section>
                            <div class="input">
                                <label for="nilai">Nama Mahasiswa</label>
                                <input type="text" name="<?= "mahasiswa$i" ?>" id="mahasiswa" placeholder="inputkan nama mahasiswa">
                                <label for="nilai">Nilai</label>
                                <input type="number" name="<?= "nilaimahasiswa$i" ?>" id="nilaimahasiswa" placeholder="inputkan nilai anda" min="0" max="100">
                            </div>
                        </section>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="jumlahSiswa" value="<?= $banyakMahasiswa ?>">
                <div class="btn">
                    <button type="submit" name="submit1">Submit</button>
                </div>
            </form>
        <?php endif; ?>
    </section>
</body>

</html>