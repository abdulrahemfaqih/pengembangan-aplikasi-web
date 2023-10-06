<?php

$saldoRekA = 100000;
$saldoRekB = 15000;

function beliBeli(int $saldo): void
{
    $saldo_awal = $saldo;
    $hargaMelon = 5000;
    $hargajeruk = 10000;
    $hargaSemangka = 15000;
    $totalHarga = 0;
    echo "<h1>Total saldo saya adalah $saldo</h1>";
    if ($saldo >= $hargaMelon) {
        $totalHarga += $hargaMelon;
        $sisaSaldo = $saldo - $hargaMelon;
        echo "<p>Saya membeli 1 melon dengan harga $hargaMelon, sisa saldo saya adalah = $sisaSaldo</p>";
        if ($sisaSaldo >= $hargajeruk) {
            $totalHarga += $hargajeruk;
            $sisaSaldo = $sisaSaldo - $hargajeruk;
            echo "<p>Saya membeli 1 jeruk dengan harga $hargajeruk, sisa saldo saya adalah = $sisaSaldo</p>";
            if ($sisaSaldo >= $hargaSemangka) {
                $totalHarga += $hargaSemangka;
                $sisaSaldo = $sisaSaldo - $hargaSemangka;
                echo "<p>Saya membeli 1 semangka dengan harga $hargaSemangka, sisa saldo saya adalah = $sisaSaldo</p>";
                echo "<h3>Jumlah total buah yang terbeli yaitu = $totalHarga dan uang sisa adalah $sisaSaldo</h3>";
            } else {
                echo "<p>Saldo anda tidak cukup, sisa saldo anda : $saldo_awal</p>";
            }
        } else {
            echo "<p>Saldo anda tidak cukup, sisa saldo anda : $saldo_awal</p>";
        }
    } else {
        echo "<p>Saldo anda tidak cukup, sisa saldo anda : $saldo_awal</p>";
    }
}

beliBeli($saldoRekA);
beliBeli($saldoRekB);
