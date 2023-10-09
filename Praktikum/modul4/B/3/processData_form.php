<?php
if (isset($_POST["submit"])) {
    if (!empty($_POST["surname"])) {
        require_once "processData.php";
    }
}
?>
<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="padding: 0 1rem;">
    <h1>Register</h1>
    <form action="processData_form.php" method="post">
        <?php include "form.inc.php" ?>
    </form>
</body>

</html>