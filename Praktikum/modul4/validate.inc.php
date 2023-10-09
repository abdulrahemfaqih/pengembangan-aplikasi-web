<?php


function validateName(string $namaLengkap)
{
    if (isset($_POST["namaLengkap"]) && isset($_POST["submit"])) {
        if(!preg_match("/^[a-zA-Z+$]", $namaLengkap)) {
            return "field nama hanya boleh berisi huruf alfabet";
        }
    }
}
