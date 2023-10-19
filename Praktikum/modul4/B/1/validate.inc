<?php
function validateName(string $surname)
{
    $errors = [];
    if (isset($_POST["surname"]) && isset($_POST["submit"])) {
        if (!preg_match("/^[a-zA-Z\s]+$/", $surname)) {
            $errors[] = "field surname hanya boleh dengan format alphabet";
        }
    }
    return $errors;
}
