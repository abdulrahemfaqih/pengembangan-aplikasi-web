<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = htmlspecialchars($_POST["firstname"]);
    $lastName = htmlspecialchars($_POST["lastname"]);
    $keterangan = htmlspecialchars($_POST["keterangan"]);

    if (empty($firstName)  || empty($lastName)) {
        echo "inputan first name dan lastname tidak boleh kosong";
    } else {
        echo "Berikut data yang tersimpan dari inputan user melalui form:<br>";
        echo "First name = " . $firstName . "<br>";
        echo "Last name = " . $lastName . "<br>";
        echo "Keterangan = " . $keterangan . "<br>";
    }


    // header("Location: index.php");
}
else {
    header("Location: index.php");
    exit;
}
