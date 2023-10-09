<?php
function validateName(string $surname)
{
    $errors = [];
    if (isset($_POST["surname"]) && isset($_POST["submit"])) {
        // if(!preg_match("/^[a-zA-Z]+$/", $surname)) {
        //     return "field nama hanya boleh berisi huruf alfabet";
        // }
        if (!preg_match("/^[a-zA-Z]+$/", $surname)) {
            $errors[] = "field surname hanya boleh berisi alphabet";
        }
    }
    return $errors;
}
