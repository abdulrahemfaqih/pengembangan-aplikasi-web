<?php
$surnameValue = isset($_POST['surname']) ? $_POST['surname'] : '';
$emaiValue = isset($_POST['emailAddres']) ? $_POST['emailAddres'] : '';
$pasValue = isset($_POST['password']) ? $_POST['password'] : '';
$alamatValue = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$provinsiValue = isset($_POST['provinsi']) ? $_POST['provinsi'] : '';
$countryValue = isset($_POST['country']) ? $_POST['country'] : '';
$jenisValue = isset($_POST['jenisKelamin']) ? $_POST['jenisKelamin'] : '';
$bekerjaValue = isset($_POST['bekerja']) ? $_POST['bekerja'] : '';
?>
<fieldset style="background-color: #D5E6E4;">
    <legend>Person Details</legend>
    <table cellspacing="15">
        <tr>
            <td><label for="surname">Surname</label></td>
            <td><input type="text" id="surname" name="surname" value="<?= $surnameValue ?>"></td>
        </tr>
        <tr>
            <td><label for="emailAddres">Email Address</label></td>
            <td><input type="text" name="emailAddres" id="emailAddres" value="<?= $emaiValue ?>"></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" name="password" id="password" value="<?= $pasValue ?>"></td>
        </tr>
        <tr>
            <td><label for="alamat">Alamat</label></td>
            <td><textarea name="alamat" id="alamat" cols="30" rows="10"><?= $alamatValue ?></textarea></td>
        </tr>
        <tr>
            <td><label for="provinsi">Provinsi</label></td>
            <td>
                <select name="provinsi" id="provinsi">
                    <option value="1" <?= ($provinsiValue == '1') ? 'selected' : '' ?>>Jawa Timur</option>
                    <option value="2" <?= ($provinsiValue == '2') ? 'selected' : '' ?>>Jawa Barat</option>
                    <option value="3" <?= ($provinsiValue == '3') ? 'selected' : '' ?>>Jawa Tengah</option>
                </select>
            </td>
        </tr>
        <input type="hidden" name="country" value="<?= $countryValue ?>">
        <tr>
            <td><label for="jenisKelamin">Jenis Kelamin</label></td>
            <td>
                <label for="male">Laki Laki</label>
                <input type="radio" name="jenisKelamin" value="male" id="male" <?= ($jenisValue == 'male') ? 'checked' : '' ?>>
                <label for="female">Perempuan</label>
                <input type="radio" name="jenisKelamin" value="female" id="female" <?= ($jenisValue == 'female') ? 'checked' : '' ?>>
            </td>
        </tr>
        <tr>
            <td><label for="bekerja">Sudah Bekerja?</label></td>
            <td><input type="checkbox" name="bekerja" id="bekerja" <?= ($bekerjaValue == 'on') ? 'checked' : '' ?>></td>
        </tr>
        <tr>
            <td>
                <button type="submit" value="submit" name="submit">Submit</button>
                <button type="reset">Reset</button>
            </td>
        </tr>
    </table>
</fieldset>