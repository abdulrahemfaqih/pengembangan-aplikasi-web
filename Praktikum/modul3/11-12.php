<?php
//11
$students = [
    ["Alex", "220401", "0812345678"],
    ["Bianca", "220402", "0812345678"],
    ["Alex", "220403", "0812345678"]
];

echo "<br>no 11<br>";
$students[] = array("Jamal", "220404", "081234562345");
$students[] = array("Suparjo", "220405", "0812323453");
$students[] = array("Akbar ganteng", "220406", "081267893");
$students[] = array("sukani", "220407", "0812365432");
$students[] = array("alham", "220408", "081234234564");

for ($row = 0; $row < 8; $row++) {
    echo "<p><b>Row Number $row</b></p>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++) {
        echo "<li>" . $students[$row][$col] . "</li>";
    }
    echo "</ul>";
}

echo "<br>no 12<br>";
?>

<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <td>no</td>
        <td>nama</td>
        <td>nim</td>
        <td>nomor hp</td>
    </tr>
    <?php for ($row = 0; $row < count($students); $row++) :  ?>
        <tr>
            <td><?= $row + 1 ?></td>
            <?php for ($col = 0; $col < count($students[$row]); $col++) :  ?>
                <td><?= $students[$row][$col] ?></td>
            <?php endfor;  ?>
        </tr>
    <?php endfor; ?>
</table>
