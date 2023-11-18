<?php
session_start();
include "database.php";


if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = getUsername($username);
    if (!empty($user)) {
        if (md5($password) == $user["password"]) {
            $_SESSION["login"] = true;
            echo "<script>
            alert('login sukses')
            window.location.href = 'index.php';
            </script>";
            exit;
        } else {
            $error = "password dan username tidak cocok";
        }
    } else {
        $error = "username tidak ditemukan";
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <title>Form Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="error-message">
        <?php if (isset($error)) : ?>
            <p><?= $error ?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="login-form">
            <h2>Login</h2>
            <form id="login-form" action="" method="post">
                <input type="text" id="username" placeholder="Username" required name="username">
                <input type="password" id="password" placeholder="Password" required name="password">
                <button type="submit" id="login-button" name="login">Login</button>
            </form>
        </div>
    </div>
</body>

</html>