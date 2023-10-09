<?php
$surnameValue = isset($_POST['surname']) ? $_POST['surname'] : '';
?>
<fieldset style="background-color: #D5E6E4;">
    <legend>Person Details</legend>
    <table cellspacing="15">
        <tr>
            <td><label for="namaLengkap">Surname</label></td>
            <td><input type="text" id="surname" name="surname" value="<?= $surnameValue ?>"></td>
        </tr>
        <tr>
            <td>
                <button type="submit" value="submit" name="submit">Submit</button>
                <button type="reset">Reset</button>
            </td>
        </tr>
    </table>
</fieldset>