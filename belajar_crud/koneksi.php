<?php

$host = "localhost";
$username = "faqih";
$password = "faqih3935";
$database = "cafe";

$koneksi = mysqli_connect($host, $username, $password, $database);

if(!$koneksi) {
    die("koneksi gagal : " . mysqli_connect_error($koneksi));
}

function query($query) {
    global $koneksi;
    $hasil = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($hasil)) {
        $rows[] = $row;
    }
    return $rows;
}