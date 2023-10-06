<?php

$height = [
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
];

foreach ($height as $x => $x_value) {
    echo "key = " . $x . ", Value = " . $x_value . "<br>";
}

//9
echo "<br>no 9<br>";
$height["faqih"] = "100";
$height["ilham"] = "90";
$height["xakaria"] = "165";
$height["udin"] = "176";
$height["akbar"] = "171";
echo "<br>setelah 5 data di tambahkkan<br>";
foreach ($height as $x => $x_value) {
    echo "key = " . $x . ", Value = " . $x_value . "<br>";
}

//10
echo "<br>no 10<br>";
$weight = [
    "faqih" => "40",
    "akbar" => "79",
    "farish" => "50"
];

echo "<br> Array Weight<br>";
foreach ($weight as $x => $x_value) {
    echo "key = " . $x . ", Value = " . $x_value . "<br>";
}



