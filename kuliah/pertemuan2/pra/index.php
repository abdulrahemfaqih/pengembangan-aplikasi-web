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
        <h1>form</h1>
        <form action="formHandler.php" method="post">
            <label for="fname">Nama depan</label>
            <input type="text" name="firstname" id="fname" placeholder="nama depan anda">
            <label for="lname">Nama belakang</label>
            <input type="text" name="lastname" id="lname" placeholder="nama belakang anda">
            <label for="who">Siapa Anda</label>
            <select name="keterangan" id="who" required>
                <option value="none">Pilih</option>
                <option value="murid">Murid</option>
                <option value="guru">Guru</option>
            </select>
            <div class="btn">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </section>
</body>

</html>