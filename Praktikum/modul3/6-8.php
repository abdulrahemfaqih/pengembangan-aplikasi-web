<?php
//6
$height = [
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
];

//6
echo "<br>no 6<br>";
$height["faqih"] = "100";
$height["ilham"] = "90";
$height["xakaria"] = "165";
$height["udin"] = "176";
$height["akbar"] = "171";

$nilaiTerakhir = end($height);
echo "nilai pada indeks terkhir = " .  $nilaiTerakhir . "<br>";

//7
echo "<br>no 7<br>";
unset($height["faqih"]);
echo "nilai pada indeks terkhir = " .  $nilaiTerakhir . "<br>";

//8
echo "<br>no 8<br>";
$weight = [
    "faqih" => "40",
    "akbar" => "79",
    "farish" => "50"
];

echo "data kedua = " . $weight["akbar"];