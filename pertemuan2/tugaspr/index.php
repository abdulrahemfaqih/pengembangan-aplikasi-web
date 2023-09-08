<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap");
        * { padding: 0; margin: 0; font-family: "Poppins", sans-serif; }
        .inputJumlah { display: flex; justify-content: center; padding: 1rem; }
        form { display: flex; flex-direction: column; row-gap: 15px; border: 3px solid black; padding: 1rem; border-radius: 10px; margin: 1rem; }
        label, input { display: block; }
        input { width: 200px; padding: 3px 10px; }
        button { padding: 5px 10px; border-radius: 6px; }
        .form { display: flex; gap: 2rem; flex-wrap: wrap; }
        .input { display: flex; flex-direction: column; row-gap: 0.5rem; border: 1px solid black;
        padding: 1rem; border-radius: 6px;}
    </style>
</head>
<body>
    <section class="inputJumlah">
        <div class="containerForm">
            <form method="post">
                <label for="jumlahSiswa">Ingin menginputkan berapa Mahasiswa</label>
                <input
                    type="number" name="jumlahMahasiswa"required>
                <div class="btn">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <section class="resultForm">
        <?php if (isset($_POST["submit"])) :
            $jumlahMahasiswa = $_POST["jumlahMahasiswa"]
        ?>
            <form action="resultTable.php" method="post">
                <div class="form">
                    <?php for ($i = 1; $i <= $jumlahMahasiswa; $i++) : ?>
                        <div class="input">
                            <h3>Data Mahaiswa ke <?= $i ?></h3>
                            <label for="nilai">Nama Mahasiswa</label>
                            <input type="text" name="<?= "mahasiswa$i" ?>" required>
                            <label for="nilai">Nilai</label>
                            <input type="number" name="<?= "nilaimahasiswa$i" ?>"max="100" required>
                        </div>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="jumlahMahasiswa" value="<?= $jumlahMahasiswa ?>">
                <div class="btn">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        <?php endif; ?>
    </section>
</body>
</html>