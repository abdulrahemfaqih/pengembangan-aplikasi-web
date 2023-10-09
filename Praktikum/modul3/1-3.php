<?php

//1
echo "no 1<br>";
$fruits = array("Avocado", "Blueberry", "Cherry");
$fruits[] = "Banana";
$fruits[] = "Grape";
$fruits[] = "Watermelon";
$fruits[] = "Coconut";
$fruits[] = "Orange";

$dataTertinggi = end($fruits);
$indexTertinggi = key($fruits);

echo "Nilai dengan index tertinggi = $dataTertinggi<br>";
echo "index tertinggi dari array = $indexTertinggi";

//2
echo "<br>no 2<br>";
unset($fruits[5]);
array_splice($fruits, 5);
var_dump($fruits);
$dataTertinggi = end($fruits);
$indexTertinggi = key($fruits);

echo "Nilai dengan index tertinggi = $dataTertinggi<br>";
echo "index tertinggi dari array = $indexTertinggi<br>";
// var_dump($fruits);

// 3
echo "no 3<br>";
$vegies = ["Wortel", "Kangkung", "Bayam"];
echo $vegies[0]. "<br>";
echo $vegies[1]. "<br>";
echo $vegies[2]. "<br>";



