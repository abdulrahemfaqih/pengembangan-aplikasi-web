<?php

$genap = 10;
$ganjil = 37;
$ganjilPrima = 25;

if (isset($_POST["submit"])) {



    $angka = $_POST["angka"];
    function isPrima(int $angka): bool
    {
        if ($angka <= 1) return false;
        for ($i = 2; $i < $angka; $i++) {
            if ($angka % $i == 0) return false;
        }
        return true;
    }



    function cekBilangan(int ...$bilangan): string
    {
        $hasil = "";
        for ($i = 0; $i < count($bilangan); $i++) {
            $angka = $bilangan[$i];
            $cek = $angka % 2 == 0 ? "genap" : "ganjil";
            $hasil .= "$angka adalah bilangan $cek";
            if (isPrima($angka)) $hasil .= " Prima";
            $hasil .= "<br>";
        }
        return $hasil;
    }

    echo cekBilangan($angka);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="number" name="angka">
        <button type="submit" name="submit">submit</button>
    </form>


</body>

</html>