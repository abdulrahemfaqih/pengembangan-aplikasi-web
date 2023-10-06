<html>

<head>
    <title>Nomor 3</title>
</head>

<body>
    <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Komputer</th>
                <th>Ram</th>
                <th>OS</th>
                <th>Processor</th>
                <th>Storage</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 2; $i <= 20; $i += 2) :
                $namaKomputer = "Client " . $i;
                $ram = "8 GB";
                $os = "Windows 10 home Single Language";
                $processor = "8th Generation Intel Core i5";
                $storage = "HDD 1TB";
                $kondisi = "Aktif";

                if ($i == 4 || $i == 8) {
                    $storage = "Failure";
                    $kondisi = "Tidak Aktif";
                } elseif ($i == 10) {
                    $ram = "4 GB";
                    $os = "Windows 7 Home Basic 64 Bit ISO";
                    $processor = "Core 2 Duo";
                    $storage = "HDD 256GB";
                    $kondisi = "Tidak Layak";
                }

            ?>
                <tr>
                    <td><?= $i / 2 ?></td>
                    <td><?= $namaKomputer ?></td>
                    <td><?= $ram ?></td>
                    <td><?= $os ?></td>
                    <td><?= $processor ?></td>
                    <td><?= $storage ?></td>
                    <td><?= $kondisi ?></td>
                </tr>
            <?php endfor; ?>
        </tbody>

    </table>
</body>

</html>