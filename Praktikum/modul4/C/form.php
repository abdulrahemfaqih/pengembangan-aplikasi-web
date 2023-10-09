<?php
$namaLengkap = $email = $tanggal = "";
$namaLengkapErr = $emailErr = $tanggalErr = "";

// Inisialisasi nilai default
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["namaLengkap"])) {
        $namaLengkap = $_POST["namaLengkap"];
        if (!preg_match("/^[a-zA-Z\s]+$/", $namaLengkap)) {
            $namaLengkapErr = "Nama Lengkap harus berupa huruf alphabet ";
        }
    } else {
        $namaLengkapErr = "Nama Lengkap harus diisi";
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email Address harus diisi";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format Email Address tidak valid";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["tanggal"])) {
        $tanggalErr = "Tanggal harus diisi";
    } elseif (!DateTime::createFromFormat('Y-m-d', $_POST["tanggal"])) {
        $tanggalErr = "Format Tanggal tidak valid. Gunakan format YYYY-MM-DD.";
    } else {
        $tanggal = $_POST["tanggal"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
</head>

<body style="padding: 0 1rem;">
    <h1>Register</h1>
    <form method="post" action="form.php">
        <fieldset style="background-color: #D5E6E4;">
            <legend>Person Details</legend>
            <table cellspacing="15">
                <tr>
                    <td><label for="namaLengkap">Nama Lengkap</label></td>
                    <td><input type="text" id="namaLengkap" name="namaLengkap" value="<?= htmlspecialchars($namaLengkap) ?>"></td>
                    <td><span class="error"><?= $namaLengkapErr ?></span></td>
                </tr>
                <tr>
                    <td><label for="email">Email Address</label></td>
                    <td><input type="text" name="email" id="email" value="<?= htmlspecialchars($email) ?>"></td>
                    <td><span class="error"><?= $emailErr ?></span></td>
                </tr>
                <tr>
                    <td><label for="tanggal">Tanggal</label></td>
                    <td><input type="text" name="tanggal" id="tanggal" value="<?= htmlspecialchars($tanggal) ?>"></td>
                    <td><span class="error"><?= $tanggalErr ?></span></td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" value="submit" name="submit">Submit</button>
                        <button type="reset">Reset</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>

</html>