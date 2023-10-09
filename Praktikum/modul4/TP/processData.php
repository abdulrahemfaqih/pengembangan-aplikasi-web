<?php
$data = $_POST;
echo "<h2>Posted Data</h3>";
foreach ($data as $key => $d_value) {
    echo "($key) => ($d_value)<br>";
}