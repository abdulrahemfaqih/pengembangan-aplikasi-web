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
        $result = tambahSupplier($_POST);
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
    <link rel="stylesheet" href="../assets/css/tambahData.css">
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