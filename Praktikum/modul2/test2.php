<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal 3 Praktikum PAW</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Komputer</th>
            <th>Ram</th>
            <th>OS</th>
            <th>Processor</th>
            <th>Storage</th>
            <th>Kondisi</th>
        </tr>

        <?php
        for ($i = 2; $i <= 20; $i += 2) {
            echo "<tr>";
            echo "<td>" . ($i / 2) . "</td>";
            echo "<td>Client " . $i . "</td>";
            if ($i == 10) {
                echo "<td>4 GB</td>";
                echo "<td>Windows 7 Home Basic 64 Bit ISO</td>";
                echo "<td>Core 2 Duo</td>";
            } else {
                echo "<td>8 GB</td>";
                echo "<td>Windows 10 Home Single Language</td>";
                echo "<td>8th Generation Intel Core i5</td>";
            }
            if ($i == 4 || $i == 8) {
                echo "<td>Failure</td>";
                echo "<td>Tidak Aktif</td>";
            } else if ($i == 10) {
                echo "<td>HDD 256GB</td>";
                echo "<td>Tidak Layak</td>";
            } else {
                echo "<td>HDD 1TB</td>";
                echo "<td>Aktif</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>