<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
</head>

<body>
    <h1>Register</h1>
    <form method='get' action="processData.php">
        <fieldset style="background-color: #D5E6E4;">
            <legend>Person Details</legend>
            <table cellspacing="15">
                <tr>
                    <td><label for="namaLengkap">Nama Lengkap</label></td>
                    <td><input type="text" id="namaLengkap" name="namaLengkap"></td>
                </tr>
                <tr>
                    <td><label for="emailAddres">Email Address</label></td>
                    <td><input type="email" name="emailAddres" id="emailAddres"></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <td><label for="alamat">Alamat</label></td>
                    <td><textarea name="alamat" id="alamat" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td><label for="provinsi">Provinsi</label></td>
                    <td>
                        <select name="provinsi" id="provinsi">
                            <option value="1">Jawa Timur</option>
                            <option value="2">Jawa Barat</option>
                            <option value="3">Jawa Tengah</option>
                        </select>
                    </td>
                </tr>
                <input type="hidden" name="country" value="Indonesia">
                <tr>
                    <td><label for="jenisKelamin">Jenis Kelamnin</label></td>
                    <td>
                        <label for="male">Laki Laki</label>
                        <input type="radio" name="jenis kelamin" value="male" id="male">
                        <label for="female">Perempuan</label>
                        <input type="radio" name="jenis kelamin" value="female" id="female">
                    </td>
                </tr>
                <tr>
                    <td><label for="bekerja">Sudah Bekerja?</label></td>
                    <td><input type="checkbox" name="bekerja" id="bekerja"></td>
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