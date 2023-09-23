<?php
echo "<h1>Hitung jumlah Huruf dan kata</h1>";

function hitungHurufDanKata(string $kalimat) : int {
    return strlen($kalimat) * str_word_count($kalimat);
}

echo "Hasil perkalian jumlah huruf dan jumlah kata: " . hitungHurufDanKata("Teknik Informatika itu prodi paling santuy");
