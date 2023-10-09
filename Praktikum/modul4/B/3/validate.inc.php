<?php
function validateName(string $surname)
{
    $errors = [];
    if (isset($_POST["surname"]) && isset($_POST["submit"])) {
        if (!preg_match("/^[a-zA-Z]+$/", $surname)) {
            $errors[] = "field surname hanya boleh berisi alphabet";
        }
    }
    return $errors;
}

function validateEmail(string $email)
{
    $errors = [];
    if (isset($_POST["emailAddres"]) && isset($_POST["submit"])) {
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
            $errors[] = "Format email tidak valid -> user@example.com";
        }
    }
    return $errors;
}

function validatePassword(string $password)
{
    $errors = [];
    if (isset($_POST["password"]) && isset($_POST["submit"])) {
        // Validasi password sesuai dengan kebutuhan Anda.
        // Berikut adalah contoh validasi password dengan minimal 8 karakter,
        // minimal satu huruf besar, satu huruf kecil, dan satu angka.
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
            $errors[] = "Password harus terdiri dari minimal 8 karakter, minimal satu huruf besar, satu huruf kecil, dan satu angka";
        }
    }
    return $errors;
}

