<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kalimat = $_POST["kalimat"];

    $hasil1 = strtolower($kalimat);
    $hasil2 = strtoupper($kalimat);
    $hasil3 = ucfirst($kalimat);
    $hasil4 = ucwords($kalimat);
    $hasil5  = substr($kalimat, 0,5);
    $hasil6 = substr($kalimat, -5);
    $hasil7 = strlen($kalimat);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .input {
            width: 500px;
            display: flex;
            justify-content: space-between;
        }

        .input span {
            padding: 2rem 0;
        }

        .hasil {
            width: 500px;
            border: 3px solid black;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            row-gap: 2rem;
            flex-wrap: wrap;
        }
    </style>

</head>

<body>
    <div class="section">
        <div class="input">
            <?= "<span>kalimat yang diinputkan = $kalimat</span>" ?>
        </div>
        <div class="hasil">
            <?=
            "
                <span>1. $hasil1</span>
                <span>2. $hasil2</span>
                <span>3. $hasil3</span>
                <span>4. $hasil4</span>
                <span>5. $hasil5</span>
                <span>6. $hasil6</span>
                <span>7. $hasil7</span>
            "
            ?>
        </div>
    </div>
</body>

</html>