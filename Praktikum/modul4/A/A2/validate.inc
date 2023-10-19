<?php
function validateName(string $surname)
{
    $errors = [];
    if (isset($_POST["surname"]) && isset($_POST["submit"])) {
        if(!preg_match("/^[a-zA-Z]+$/", $surname)) {
            $errors[] =  "field nama hanya diisi dengan format alfabet";
        }
    }
    if(!empty($errors)) {
        return $errors;
    }
}
