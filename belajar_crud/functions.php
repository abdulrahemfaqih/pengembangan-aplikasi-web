<?php

$conn = new mysqli("localhost", "faqih", "faqih3935", "warungIT");

if(!$conn) {
    die("Koneksi gagal : " . mysqli_connect_error());
}


