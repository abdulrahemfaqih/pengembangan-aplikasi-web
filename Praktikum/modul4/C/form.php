<?php
$namaLengkap = $email = $tanggal = "";
$namaLengkapErr = $emailErr = $tanggalErr = "";
$isValid = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["namaLengkap"])) {

        if (is_string($_POST["namaLengkap"])) {
            $namaLengkap = $_POST["namaLengkap"];
            if (!preg_match("/^[a-zA-Z\s]+$/", $namaLengkap)) {
                $namaLengkapErr = "Nama Lengkap harus berupa huruf alphabet";
            } else {
                $namaLengkap = strtoupper($namaLengkap);
            }
        } else {
            $namaLengkapErr = "Nama Lengkap harus berupa string";
        }
    } else {
        $namaLengkapErr = "Nama Lengkap harus diisi";
    }

    if (!empty($_POST["email"])) {
        $email = $_POST["email"];
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format Email Address tidak valid";
        }
    } else {
        $emailErr = "Email Address harus diisi";
    }

    if (!empty($_POST["tanggal"])) {
        $tanggal = $_POST["tanggal"];
        if (!DateTime::createFromFormat('Y-m-d', $_POST["tanggal"])) {
            $tanggalErr = "Format Tanggal tidak valid. Gunakan format YYYY-MM-DD.";
        }
    } else {
        $tanggalErr = "Tanggal harus diisi";
    }
    if (empty($namaLengkapErr) && empty($emailErr) && empty($tanggalErr)) {
        $isValid = true;
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
    <?php if ($isValid) : ?>
        <p>Semua validasi berhasil!</p>
    <?php endif; ?>
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