<?php
require "../functions.php";
if (isset($_POST["batal"])) {
    header("Location: index.php");
}


if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $telp = $_POST["telp"];
    $alamat = $_POST["alamat"];
    if (!empty($nama) && !empty($telp) && !empty($alamat)) {
        $result = tambahDataSupplier($_POST);
        if ($result > 0) {
            mysqli_close($conn);
            echo '<script>alert("Data berhasil ditambahkan"); window.location.href = "index.php";</script>';
        } else {
            echo '<script>alert("Data Gagal ditambahkan");</script>';
        }
    } else {
        echo '<script>alert("Semua inputan harus diisi");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap");
        * {list-style: none; margin: 0;padding: 0;text-decoration: none;font-family: "poppins", sans-serif;}
        .container {height: 100vh;display: flex;justify-content: center;flex-direction: column;align-items: center;}
        h1 {margin: 1rem;}
        form {margin: 1rem;}
        td {padding: 0.8rem;}
        button {padding: 0.5rem 1rem;color: white;border: none;border-radius: 5px;cursor: pointer;}
        input {padding: 5px 0 10px 5px;width: 300px;}
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah data master Supplier Baru</h1>
        <form action="" method="post">
            <table>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" placeholder="nama" name="nama" id="nama"></td>
                </tr>
                <tr>
                    <td><label for="nama">Nomor Telepon</label></td>
                    <td><input type="text" placeholder="nomor telepon" name="telp" id="telp"></td>
                </tr>
                <tr>
                    <td><label for="email">Alamat</label></td>
                    <td><input type="text" placeholder="alamat" name="alamat" id="alamat"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button style="background-color: rgb(2, 142, 2);" type="submit" class="simpan" name="submit">Simpan</button>
                        <button style="background-color: rgb(203, 3, 3);" class="batal" name="batal">Batal</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>