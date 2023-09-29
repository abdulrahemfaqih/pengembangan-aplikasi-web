<?php


$data_koordinat = [
    "Surabaya" => ["latitude" => -7.255859181105917, "longitude" => 112.75799779607146],
    "Banten" => ["latitude" => -6.403731703056451,  "longitude" => 106.05933104389545],
    "Bogor" => ["latitude" => -6.597574089116659, "longitude" => 106.80836692644529],
    "Bandung" => ["latitude" => -6.916053058158814, "longitude" => 107.60607412705717],
    "Yogyakarta" => ["latitude" => -7.787361111089316, "longitude" =>  110.3622707339422],
    "Semarang" => ["latitude" => -6.969002755840674, "longitude" => 110.43024352928138],
    "Bekasi" => ["latitude" => -6.365639709304437,, "longitude" => 107.19013475107063],
    "Cirebon" => ["latitude" => -6.69536307085594, "longitude" => 108.5587586437141],
    "Tuban" => ["latitude" => -6.8860692117137825, "longitude" => 112.0390017630515],
    "Pekalongan" => ["latitude" => -6.897477005152818,  "longitude" => 109.67660019023775],
    "Tasikmalaya" => ["latitude" => -7.324976342663581,  "longitude" => 108.22411983517829],
    "Jakarta" => ["latitude" => -6.207877571749103,  "longitude" => 106.83293282757978],
    "Klaten" => ["latitude" => -7.726256860406675,  "longitude" => 110.64806589487056],
    "Madiun" => ["latitude" => -7.641841047711919,  "longitude" => 111.52623845626613],
    "Magelang" => ["latitude" => -7.476981274010894,   "longitude" => 110.19782502001567],
];

$data_jarak = [
    "Banten" => [
        "Jakarta" => "jaraknya",
        "Bogor" => "jaraknya",
    ],
    "Jakarta" => [
        "Bogor" => "jaraknya",
        "Bekasi" => "jaraknya",
        "Banten" => "jaraknya"
    ],
    "Bogor" => [
        "Bekasi" => "jaraknya",
        "Bandung" => "jaraknya",
        "Jakarta" => "jaraknya",
        "Banten" => "jaraknya"
    ],
    "Bekasi" => [
        "Jakarta" => "jaraknya",
        "Bogor" => "jaraknya",
        "Bandung" => "jaraknya",
        "Cirebon" => "jaraknya",
    ],
    "Bandung" => [
        "Bogor" => "jaraknya",
        "Bekasi" => "jaraknya",
        "Cirebon" => "jaraknya",
        "Tasikmalaya" => "jaraknya",
    ],
    "Cirebon" => [
        "Bekasi" => "jaraknya",
        "Bandung" => "jaraknya",
        "Tasikmalaya" => "jaraknya",
        "Pekalongan" => "jaraknya"
    ],
    "Tasikmalaya" => [
        "Bandung" => "jaraknya",
        "Cirebon" => "jaraknya",
        "Pekalongan" => "jaraknya",
        "Magelang" => "jaraknya",
        "Yogyakarta" => "jaraknya"
    ],
    "Pekalongan" => [
        "Cirebon" => "jaraknya",
        "Magelang" => "jaraknya",
        "Semarang" => "jaraknya",
        "Tasikmalaya" => "jaraknya"
    ],
    "Magelang" => [
        "Tasikmalaya" => "jaraknya",
        "Pekalongan" => "jaraknya",
        "Semarang" => "jaraknya",
        "Madiun" => "jaraknya",
        "Klaten" => "jaraknya",
        "Yogyakarta" => "jaraknya"
    ],
    "Yogyakarta" => [
        "Tasikmalaya" => "jaraknya",
        "Magelang" => "jaraknya",
        "Klaten" => "jaraknya"
    ],
    "Klaten" => [
        "Yogyakarta" => "jaraknya",
        "Magelang" => "jaraknya",
        "Madiun" => "jaraknya",
        "Surabaya" => "jaraknya"
    ],
    "Madiun" => [
        "Klaten" => "jaraknya",
        "Magelang" => "jaraknya",
        "Semarang" => "jaraknya",
        "Tuban" => "jaraknya",
        "Surabaya" => "jaraknya"
    ],
    "Semarang" => [
        "Pekalongan" => "jaraknya",
        "Magelang" => "jaraknya",
        "Madiun" => "jaraknya",
        "Tuban" => "jaraknya"
    ],
    "Tuban" => [
        "Semarang" => "jaraknya",
        "Madiun" => "jaraknya",
        "Surabaya" => "jaraknya"
    ],
    "Surabaya" => [
        "Tuban" => "jaraknya",
        "Madiun" => "jaraknya",
        "Klaten" => "jaraknya"
    ]
];
