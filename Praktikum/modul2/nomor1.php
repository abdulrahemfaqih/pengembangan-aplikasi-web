<?php

$genap = 10;
$ganjil = 37;
$ganjilPrima = 25;

function isPrima(int $angka): bool {
    if ($angka <= 1) return false;
    for ($i = 2; $i < $angka; $i++) {
        if ($angka % $i == 0) return false;
    } return true;
}

function cekBilangan(int ...$bilangan) : string {
    $hasil = "";
    for ($i = 0; $i < count($bilangan); $i++) {
        $angka = $bilangan[$i];
        $cek = $angka % 2 == 0 ? "genap" : "ganjil";
        $hasil .= "$angka adalah bilangan $cek";
        if (isPrima($angka)) $hasil .= " Prima";
        $hasil .= "<br>";
    } return $hasil;
}

echo cekBilangan($genap, $ganjil, $ganjilPrima);
