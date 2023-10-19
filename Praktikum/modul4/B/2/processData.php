<?php
include "validate.inc";

$nama = $_POST["surname"];
// echo validateName($nama);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validasi = validateName($_POST["surname"]);
    if (!empty($validasi)) {
        echo "<h3>hasil validasi</h3>";
        foreach ($validasi as $val) {
            echo "$val<br>";
        }
    } else {
        die("form berhasil di kirim tanpa adanya error");

    }
}
