<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
</head>

<body style="padding: 0 1rem;">
    <h1>Register</h1>
    <form method="post" action="processData.php">
        <fieldset style="background-color: #D5E6E4;">
            <legend>Person Details</legend>
            <table cellspacing="15">
                <tr>
                    <td><label for="namaLengkap">Surname</label></td>
                    <td><input type="text" id="surname" name="surname"></td>
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