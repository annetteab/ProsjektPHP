<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="main.css"> <!-- Eksternt CSS-dokument -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .search-box {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: absolute;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Velkommen til Motellets adminoversikt</h1>
    <nav>
        <ul>
            <li><a href="index.php">Hjem</a></li>
            <li><a href="booking.php">Bestill rom</a></li>
            <li><a href="about.php">Om Oss</a></li>
            <li><a href="contact.php">Kontakt</a></li>
            <li><a href="gjesteprofil.php">Min profil</a></li>
            <li><a href="login.php">Logg inn</a></li>
            <li class="right-align"><a href="admin.php">Admin</a></li>
        </ul>
    </nav>
</header>
<?php
/*
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

echo "<table class='room-table'>";
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

*/


// Database tilkoblingsdetaljer
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "motell";

// Opprett tilkobling
$conn = new mysqli($servername, $username, $password, $dbname);

// Sjekk tilkobling
if ($conn->connect_error) {
    die("Tilkobling feilet: " . $conn->connect_error);
}

// SQL-spørring for å hente alle romdataene
$sql = "SELECT Romnummer, Type, Pris, Maks_voksne, Maks_barn, Tilgjengelighet, Etasje, Nar_heis FROM Rom";
$result = $conn->query($sql);

// Sjekk om vi har resultater
if ($result->num_rows > 0) {
    echo "<table class='room-table'>";
    echo "<tr><th>Rom</th><th>Type</th><th>Pris (NOK)</th><th>Maks Voksne</th><th>Maks Barn</th><th>Tilgjengelighet</th><th>Etasje</th><th>Nær heis</th></tr>";

    // Loop gjennom og vis hvert rom
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Romnummer"] . "</td>";
        echo "<td>" . $row["Type"] . "</td>";
        echo "<td>" . $row["Pris"] . "</td>";
        echo "<td>" . $row["Maks_voksne"] . "</td>";
        echo "<td>" . $row["Maks_barn"] . "</td>";
        echo "<td>" . $row["Tilgjengelighet"] . "</td>";
        echo "<td>" . $row["Etasje"] . "</td>";
        echo "<td>" . $row["Nar_heis"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Ingen rom funnet.";
}

// Lukk tilkoblingen
$conn->close();


?>
