
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Form</title>
</head>

<body>
    <section>
        <h1>Form nilai</h1>
        <form action="result.php" method="post">
            <label for="nilai">Nilai</label>
            <input type="number" name="nilai" id="nilai" placeholder="inputkan nilai anda" min="0" max="100">
            <div class="btn">
                <button type="submit" name="submit1">Submit</button>
            </div>
        </form>
        <h1 style="margin-top:2rem">Form Angka</h1>
        <form action="result.php" method="post">
            <label for="nilai">Nilai awal</label>
            <input type="number" name="nilaiAwal" id="nilai" placeholder="inputkan angka awal">
            <label for="nilai">Nilai akhir</label>
            <input type="number" name="nilaiAkhir" id="nilai" placeholder="inputkan angka awal">
            <div class="btn">
                <button type="submit" name="submit2">Submit</button>
            </div>
        </form>
    </section>
</body>

</html>