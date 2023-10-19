<?php
function validateName(string $surname)
{
    if (isset($_POST["surname"]) && isset($_POST["submit"])) {
        if(!preg_match("/^[a-zA-Z]+$/", $surname)) {
            return "field nama hanya boleh berisi huruf alfabet";
        }
    }
}

