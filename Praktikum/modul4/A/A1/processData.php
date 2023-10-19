<?php
include "validate.inc";
$nama = $_POST["surname"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validasi = validateName($_POST["surname"]);
    if (!empty($validasi)) {
        echo $validasi;
    }
}

