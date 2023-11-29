<?php
session_start();
include "functions.php";

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = getDataUser($username);
    if (!empty($user)) {
        if ($password == $user["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["level"] = $user["level"];
            $_SESSION["nama"] = $user["username"];
            $nama = $_SESSION["nama"];
            echo "<script>
            alert('login sukses, Selamat Datang $nama ')
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
    <link rel="stylesheet" href="assets/css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <span class="guest">Masuk sebagai <a href="form_order.php">guest?</a></span>
    </div>
</body>

</html>