<div style="padding: .5rem 2rem;">
    <?php
    echo "<h1>Hitunng volume kerucut</h1><img src='rumusVkerucut.png'><br>";

    $jariA = 12;
    $tinggiA = 18;
    $phiA = ($jariA == 0) ? 22/7 : 3.14;
    $volumeA = 1 / 3 * $phiA * $jariA ** 2 * $tinggiA;
    $jariB = 12;
    $tinggiB = 18;
    $phiB = ($jariB == 0) ? 22/7 : 3.14;
    $volumeB = 1 / 3 * $phiB * $jariB ** 2 * $tinggiB;

    echo "
    <br>Kerucut A<br>
    Jari-jari kerucut(r): $jariA<br>
    Tinggi Kerucut(t): $tinggiA<br>
    Volume Kerucut: $volumeA cm<sup>3</sup>
    <br>
    <br>Kerucut B<br>
    Jari-jari kerucut(r): $jariB<br>
    Tinggi Kerucut(t): $tinggiB<br>
    Volume Kerucut: $volumeB cm<sup>3</sup>";
    ?>
</div>