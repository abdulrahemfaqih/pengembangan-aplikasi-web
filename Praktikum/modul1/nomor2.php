<div style="padding: .5rem 2rem;">
    <?php
    echo "<h1>Hitung volume kerucut</h1><img src='rumusVkerucut.png'><br>";
    function hitungVolKerucut(int|float $jariJari, int|float $tinggi) : void {
        $phi = ($jariJari % 7 == 0) ? 22/7 : 3.14;
        $volume =  (1/3) * $phi * $jariJari**2 * $tinggi;
        echo "Jari-jari kerucut(r): $jariJari<br>
        Tinggi kerucut(t): $tinggi<br>
        Volume kerucut: $volume cm<sup>3</sup><br>";
    }
    echo "<br>Kerucut A<br>";
    hitungVolKerucut(12,18);
    echo "<br>Kerucut B<br>";
    hitungVolKerucut(21,9);
    ?>
</div>

