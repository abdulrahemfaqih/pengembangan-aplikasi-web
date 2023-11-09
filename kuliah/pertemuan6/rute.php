<?php

function hitung_haversine($lat1, $lon1, $lat2, $lon2)
{
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;

    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $radius = 6371;

    return $c * $radius;
}

$data_koordinat = [
    "Surabaya" => ["latitude" => -7.255859181105917, "longitude" => 112.75799779607146],
    "Banten" => ["latitude" => -6.403731703056451,  "longitude" => 106.05933104389545],
    "Bogor" => ["latitude" => -6.597574089116659, "longitude" => 106.80836692644529],
    "Bandung" => ["latitude" => -6.916053058158814, "longitude" => 107.60607412705717],
    "Yogyakarta" => ["latitude" => -7.787361111089316, "longitude" =>  110.3622707339422],
    "Semarang" => ["latitude" => -6.969002755840674, "longitude" => 110.43024352928138],
    "Bekasi" => ["latitude" => -6.365639709304437, "longitude" => 107.19013475107063],
    "Cirebon" => ["latitude" => -6.69536307085594, "longitude" => 108.5587586437141],
    "Tuban" => ["latitude" => -6.8860692117137825, "longitude" => 112.0390017630515],
    "Pekalongan" => ["latitude" => -6.897477005152818,  "longitude" => 109.67660019023775],
    "Tasikmalaya" => ["latitude" => -7.324976342663581,  "longitude" => 108.22411983517829],
    "Jakarta" => ["latitude" => -6.207877571749103,  "longitude" => 106.83293282757978],
    "Klaten" => ["latitude" => -7.726256860406675,  "longitude" => 110.64806589487056],
    "Madiun" => ["latitude" => -7.641841047711919,  "longitude" => 111.52623845626613],
    "Magelang" => ["latitude" => -7.476981274010894,   "longitude" => 110.19782502001567],
];

$data_jarak = [];

function hitung_jarak($kota1, $kota2)
{
    global $data_koordinat;
    return hitung_haversine($data_koordinat[$kota1]['latitude'], $data_koordinat[$kota1]['longitude'], $data_koordinat[$kota2]['latitude'], $data_koordinat[$kota2]['longitude']);
}

$data_jarak = [
    "Banten" => [
        "Jakarta" => hitung_jarak("Banten", "Jakarta"),
        "Bogor" => hitung_jarak("Banten", "Bogor"),
    ],
    "Jakarta" => [
        "Bogor" => hitung_jarak("Jakarta", "Bogor"),
        "Bekasi" => hitung_jarak("Jakarta", "Bekasi"),
        "Banten" => hitung_jarak("Jakarta", "Banten")
    ],
    "Bogor" => [
        "Bekasi" => hitung_jarak("Bogor", "Bekasi"),
        "Bandung" => hitung_jarak("Bogor", "Bandung"),
        "Jakarta" => hitung_jarak("Bogor", "Jakarta"),
        "Banten" => hitung_jarak("Bogor", "Banten")
    ],
    "Bekasi" => [
        "Jakarta" => hitung_jarak("Bekasi", "Jakarta"),
        "Bogor" => hitung_jarak("Bekasi", "Bogor"),
        "Bandung" => hitung_jarak("Bekasi", "Bandung"),
        "Cirebon" => hitung_jarak("Bekasi", "Cirebon"),
    ],
    "Bandung" =>   [
        "Bogor" => hitung_jarak("Bandung", "Bogor"),
        "Bekasi" => hitung_jarak("Bandung", "Bekasi"),
        "Cirebon" => hitung_jarak("Bandung", "Cirebon"),
        "Tasikmalaya" => hitung_jarak("Bandung", "Tasikmalaya"),
    ],
    "Cirebon" => [
        "Bekasi" => hitung_jarak("Cirebon", "Bekasi"),
        "Bandung" => hitung_jarak("Cirebon", "Bandung"),
        "Tasikmalaya" => hitung_jarak("Cirebon", "Tasikmalaya"),
        "Pekalongan" => hitung_jarak("Cirebon", "Pekalongan")
    ],
    "Tasikmalaya" => [
        "Bandung" => hitung_jarak("Tasikmalaya", "Bandung"),
        "Cirebon" => hitung_jarak("Tasikmalaya", "Cirebon"),
        "Pekalongan" => hitung_jarak("Tasikmalaya", "Pekalongan"),
        "Magelang" => hitung_jarak("Tasikmalaya", "Magelang"),
        "Yogyakarta" => hitung_jarak("Tasikmalaya", "Yogyakarta")
    ],
    "Pekalongan" => [
        "Cirebon" => hitung_jarak("Pekalongan", "Cirebon"),
        "Magelang" => hitung_jarak("Pekalongan", "Magelang"),
        "Semarang" => hitung_jarak("Pekalongan", "Semarang"),
        "Tasikmalaya" => hitung_jarak("Pekalongan", "Tasikmalaya")
    ],
    "Magelang" => [
        "Tasikmalaya" => hitung_jarak("Magelang", "Tasikmalaya"),
        "Pekalongan" => hitung_jarak("Magelang", "Pekalongan"),
        "Semarang" => hitung_jarak("Magelang", "Semarang"),
        "Madiun" => hitung_jarak("Magelang", "Madiun"),
        "Klaten" => hitung_jarak("Magelang", "Klaten"),
        "Yogyakarta" => hitung_jarak("Magelang", "Yogyakarta")
    ],
    "Yogyakarta" => [
        "Tasikmalaya" => hitung_jarak("Yogyakarta", "Tasikmalaya"),
        "Magelang" => hitung_jarak("Yogyakarta", "Magelang"),
        "Klaten" => hitung_jarak("Yogyakarta", "Klaten")
    ],
    "Klaten" => [
        "Yogyakarta" => hitung_jarak("Klaten", "Yogyakarta"),
        "Magelang" => hitung_jarak("Klaten", "Magelang"),
        "Madiun" => hitung_jarak("Klaten", "Madiun"),
        "Surabaya" => hitung_jarak("Klaten", "Surabaya")
    ],
    "Madiun" => [
        "Klaten" => hitung_jarak("Madiun", "Klaten"),
        "Magelang" => hitung_jarak("Madiun", "Magelang"),
        "Semarang" => hitung_jarak("Madiun", "Semarang"),
        "Tuban" => hitung_jarak("Madiun", "Tuban"),
        "Surabaya" => hitung_jarak("Madiun", "Surabaya")
    ],
    "Semarang" => [
        "Pekalongan" => hitung_jarak("Semarang", "Pekalongan"),
        "Magelang" => hitung_jarak("Semarang", "Magelang"),
        "Madiun" => hitung_jarak("Semarang", "Madiun"),
        "Tuban" => hitung_jarak("Semarang", "Tuban")
    ],
    "Tuban" => [
        "Semarang" => hitung_jarak("Tuban", "Semarang"),
        "Madiun" => hitung_jarak("Tuban", "Madiun"),
        "Surabaya" => hitung_jarak("Tuban", "Surabaya")
    ],
    "Surabaya" => [
        "Tuban" => hitung_jarak("Surabaya", "Tuban"),
        "Madiun" => hitung_jarak("Surabaya", "Madiun"),
        "Klaten" => hitung_jarak("Surabaya", "Klaten")
    ]
];

// var_dump($data_jarak);
function dijkstra($graf, $asal, $tujuan)
{
    $jarak = [];
    $sebelumnya = [];
    $antrian = new SplPriorityQueue();

    foreach ($graf as $kota => $tetangga) {
        $jarak[$kota] = INF;
        $sebelumnya[$kota] = null;
    }


    $jarak[$asal] = 0;
    // var_dump($jarak, $sebelumnya);

    $antrian->insert($asal, 0);

    while (!$antrian->isEmpty()) {
        $saatIni = $antrian->extract();
        echo "Saat ini: $saatIni<br>";

        if ($saatIni === $tujuan) {
            break;
        }

        foreach ($graf[$saatIni] as $tetangga => $jarakTetangga) {
            $alternatif = $jarak[$saatIni] + $jarakTetangga;
            if ($alternatif < $jarak[$tetangga]) {
                $jarak[$tetangga] = $alternatif;
                $sebelumnya[$tetangga] = $saatIni;
                $antrian->insert($tetangga, -$alternatif);
                echo "perbarui jarak ke $tetangga: $alternatif (via $saatIni)<br>";
            }
        }
    }

    // var_dump($jarak, $sebelumnya);

    $rute = [];
    $saatIni = $tujuan;
    $totalJarak = 0;
    while ($saatIni !== null) {
        $rute[] = $saatIni;
        $kotaSebelumnya = $sebelumnya[$saatIni];
        if ($kotaSebelumnya !== null) {
            $jarakKeSebelumnya = $graf[$saatIni][$kotaSebelumnya];
            $totalJarak += $jarakKeSebelumnya;
        }
        $saatIni = $kotaSebelumnya;
        echo "saat ini : $saatIni<br>";
    }

    $rute = array_reverse($rute);
    var_dump($rute);
    return ["rute" => $rute, "totalJarak" => $totalJarak];
}

