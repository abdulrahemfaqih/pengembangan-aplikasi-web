<?php
include "validate.inc";

$surname = $_POST["surname"];
$email = $_POST["emailAddres"];
$password = $_POST["password"];
$alamat = $_POST["alamat"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $surnameValidation = validateName($surname);
    if (!empty($surnameValidation)) {
        $errors = array_merge($errors, $surnameValidation);
    }

    $emailValidation = validateEmail($email);
    if (!empty($emailValidation)) {
        $errors = array_merge($errors, $emailValidation);
    }

    // Validasi password
    $passwordValidation = validatePassword($password);
    if (!empty($passwordValidation)) {
        $errors = array_merge($errors, $passwordValidation);
    }

    $addressValidation = validateAddress($alamat);
    if (!empty($addressValidation)) {
        $errors = array_merge($errors, $addressValidation);
    }

    if (!empty($errors)) {
        echo "<h3>Hasil Validasi</h3>";
        foreach ($errors as $error) {
            echo "$error<br>";
        }
    } else {
        die("form berhasil di kirim tanpa adanya error");
    }
}

