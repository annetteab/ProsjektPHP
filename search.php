<?php
$motell = array (
    "Rom 101" => array(
        "Type" => "Enkeltrom",
        "Pris" => 800,
        "Maks_voksne" => 1,
        "Maks_barn" => 0,
        "Tilgjengelighet" => "Ledig",
        "Etasje" => "Lavere",
        "Nær_heis" => "Ja",
    ),
    "Rom 205" => array(
        "Type" => "Dobbeltrom",
        "Pris" => 1200,
        "Maks_voksne" => 2,
        "Maks_barn" => 1,
        "Tilgjengelighet" => "Ledig",
        "Etasje" => "Lavere",
        "Nær_heis" => "Nei",
    ),
    "Rom 301" => array(
        "Type" => "Junior Suite",
        "Pris" => 2000,
        "Maks_voksne" => 2,
        "Maks_barn" => 2,
        "Tilgjengelighet" => "Ledig",
        "Etasje" => "Høyere",
        "Nær_heis" => "Ja",
    ),
);

echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Rom</th><th>Type</th><th>Pris (NOK)</th><th>Maks Voksne</th><th>Maks Barn</th><th>Tilgjengelighet</th><th>Etasje</th><th>Nær heis</th></tr>";

foreach ($motell as $rom => $info) {
    echo "<tr>";
    echo "<td>$rom</td>";
    echo "<td>{$info['Type']}</td>";
    echo "<td>{$info['Pris']}</td>";
    echo "<td>{$info['Maks_voksne']}</td>";
    echo "<td>{$info['Maks_barn']}</td>";
    echo "<td>{$info['Tilgjengelighet']}</td>";
    echo "<td>{$info['Etasje']}</td>";
    echo "<td>{$info['Nær_heis']}</td>";
    echo "</tr>";
}

echo "</table>";
?>