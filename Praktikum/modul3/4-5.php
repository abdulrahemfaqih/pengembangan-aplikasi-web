<?php
//skrip
$fruits = ["Avocado", "Blueberry", "Cherry"];
$arrLength = count($fruits);
for ($x = 0; $x < $arrLength; $x++) {
    echo $fruits[$x] . "<br>";
}

//4
echo "<br>no 4<br>setelah penambahan 5 data<br>";

$data = ["Banana", "Orange", "Watermelon", "Coconut", "Grape"];
for ($i = 0; $i <count($data); $i++) {
    $fruits[] = $data[$i];
}
$arrLength = count($fruits);
echo "Panjang  (jumlah data) array saat ini : $arrLength <br>";
for ($x = 0; $x < $arrLength; $x++) {
    echo $fruits[$x] . "<br>";
}

//5
echo "<br>no 5<br>";
$vegies = ["Wortel", "Kangkung", "Bayam"];
for ($i = 0; $i < count($vegies); $i++) {
    echo $vegies[$i] . "<br>";
}
