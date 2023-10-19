<?php

require "functions.php";

if (isset($_POST["submit"])) : ?>
    <?php if (tambah($_POST) > 0) :  ?>
        <script>
            alert('Data berhasil ditambahkan')
            window.location.href = 'index.php'
        </script>
    <?php else : ?>
        <script>
            alert('Data Gagal ditambahkan')
        </script>
    <?php endif; ?>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tambah.css">
    <title>Tambah Supplier</title>
</head>

<body>
    <div class="container">
        <h1>Tambah data master Supplier Baru</h1>
        <form action="" method="post">
            <table>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name="nama" id="nama"></td>
                </tr>
                <tr>
                    <td><label for="nama">Nomor Telepon</label></td>
                    <td><input type="text" name="telp" id="telp"></td>
                </tr>
                <tr>
                    <td><label for="email">Alamat</label></td>
                    <td><input type="text" name="alamat" id="alamat"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button style="background-color: green;" type="submit" name="submit">Simpan</button>
                        <button style="background-color: red;" type="reset" name="submit">Batal</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>