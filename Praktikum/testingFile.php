<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1" cellspacing="0" cellpadding="8">
        <!-- celspacng buat jarak antar cell -->
        <!-- celpadding itu arak didalam cell -->
        <tr>
            <th>No</th>
            <th>Nama Komputer</th>
            <th>RAM</th>
            <th>OS</th>
            <th>Processor</th>
            <th>Storage</th>
            <th>Kondisi</th>
        </tr>
        <?php
        for ($i = 2; $i <= 20; $i += 2) {
            $ram = "8gb";
            $os = "Windows 10 Home Single Language";
            $pr = "8th gene inter i5";
            $st = "hdd1tb";
            $kondisi = "aktif";

            if ($i == 4 || $i == 8) {
                $st = "failure";
                $kondisi = "tidak aktif";
            } elseif ($i == 10) {
                $ram = "4gb";
                $os = "windows 7 home basic 64 bt";
                $pr = "core 2 dua";
                $st = "hdd 256";
                $kondisi = "tidak laak";
            }

            echo "<tr>";
            echo "<td>" . ($i / 2) . "</td>";
            echo
            "<td> client $i</td>
                <td> $ram</td>
                <td> $os</td>
                <td> $pr</td>
                <td> $st</td>
                <td> $kondisi</td>
            </tr>";
        }
        ?>
    </table>
</body>

</html>