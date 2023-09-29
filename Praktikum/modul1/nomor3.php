
<?php
echo "<h1>Hitung Jumlah Huruf dan Kata</h1>";
function hitungHurufDanKata(string $kalimat): void {
    echo "jumlah kata : " . str_word_count($kalimat) . "<br>";
    // return strlen($kalimat) * str_word_count($kalimat);
}
hitungHurufDanKata("Teknik Informatika itu prodi paling santuy");
