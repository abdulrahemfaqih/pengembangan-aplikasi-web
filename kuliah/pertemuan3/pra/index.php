<?php
$data_menu = [
    [
        "nama" => "mie ayam",
        "harga" => 7_500
    ],
    [
        "nama" => "bakso",
        "harga" => 8_000
    ],
    [
        "nama" => "soto",
        "harga" => 7_000
    ]
];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kasir</title>
    <style>
        label, input {
            display: block;
        }

    </style>
</head>

<body>
    <div class="container">
        <form action="">
            <div id="form-input">
                <label for="pilihMenu">Pilih Menu</label>
                <select id="pilihan" name="pilihan">
                    <?php foreach ($data_menu as $index => $menu) : ?>
                        <option value="<?= $menu["nama"] ?>"><?= $menu["nama"] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah">
            </div>
        </form>
    </div>
    <script src="jquery.min.js"></script>
    <script>
        function copyForm() {
            $("#input").clone().appendTo($("#form-result"))
        }
    </script>
</body>

</html>