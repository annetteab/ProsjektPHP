<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motell Booking</title>
    <link rel="stylesheet" href="css/main.css"> <!-- Eksternt CSS-dokument -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Sørger for at hele høyden fylles */
        }

        /* Stil for header */
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        /* Navigasjon */
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        /* Hovedcontainer */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1; /* Fyller opp ledig plass */
        }

        /* Stil for intro-seksjonen */
        .intro h2 {
            text-align: center;
            color: #333;
        }

/* Stil for søkeboksen */
.search-box {
    background-color: #fff;
    padding: 20px;
    margin: 20px auto;  /* Sentraliserer boksen */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    max-width: 600px;  /* Maksimal bredde på søkeboksen */
    width: 100%;  /* Tar opp hele tilgjengelige bredde innenfor max-width */
}
        /* Stil for footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            width: 100%;
            position: relative; /* Endret fra absolute til relative */
        }
    </style>
</head>
<body>

<header>
    <h1>Velkommen til Motellets Bookingsystem</h1>
    <nav>
        <ul>
            <li><a href="index.php">Hjem</a></li>
            <li><a href="booking.php">Bestill rom</a></li>
            <li><a href="about.php">Om Oss</a></li>
            <li><a href="kontakt.php">Kontakt</a></li>
            <li><a href="gjesteprofil.php">Min profil</a></li>
            <li><a href="login.php">Logg inn</a></li>
            <li class="right-align"><a href="admin.php">Admin</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <section class="intro">
        <h2>Om Motellet</h2>
        <p>Motellet vårt tilbyr komfortable rom til en rimelig pris. Vi har tre forskjellige romtyper: enkeltrom, dobbeltrom og junior suite. Vårt mål er å gi våre gjester en behagelig og avslappende opplevelse.</p>
    </section>

    <section class="search-box">
        <h3>Søk etter ledige rom</h3>
        <form method="post" action="search.php">
            <label for="innsjekk">Innsjekk:</label>
            <input type="date" id="innsjekk" name="innsjekk" required><br><br>

            <label for="utsjekk">Utsjekk:</label>
            <input type="date" id="utsjekk" name="utsjekk" required><br><br>

            <label for="adults">Antall voksne:</label>
            <input type="number" id="adults" name="adults" min="1" required><br><br>

            <label for="children">Antall barn:</label>
            <input type="number" id="children" name="children" min="0"><br><br>

            <input type="submit" value="Søk Rom">
        </form>
    </section>
</div>

<footer>
    <p>&copy; 2024 Motell Booking. Alle rettigheter reservert.</p>
</footer>

</body>
</html>


<?php

// Koble til databasen
$servername = "localhost"; // Brukernavn for databasen
$username = "root"; // Ditt brukernavn
$password = ""; // Ditt passord
$dbname = "motell"; // Din database

$conn = new mysqli($servername, $username, $password, $dbname);

// Sjekk tilkoblingen
if ($conn->connect_error) {
    die("Tilkobling feilet: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Få datoer og antall gjester fra skjemaet
    $innsjekk = $_POST['innsjekk'];
    $utsjekk = $_POST['utsjekk'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];

    // SQL-spørring for å finne tilgjengelige rom
    $sql = "SELECT * FROM rom WHERE tilgjengelighet = 1 AND maks_voksne >= ? AND maks_barn >= ? 
            AND romnummer NOT IN (
                SELECT romnummer FROM reservasjoner 
                WHERE (innsjekk < ? AND utsjekk > ?)
            )";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $adults, $children, $utsjekk, $innsjekk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Vis tilgjengelige rom
        while ($row = $result->fetch_assoc()) {
            echo "Romnummer: " . $row["romnummer"] . " - Type: " . $row["type"] . " - Pris: " . $row["pris"] . "<br>";
        }
    } else {
        echo "Ingen tilgjengelige rom for valgte datoer.";
    }

    $stmt->close();
}

$conn->close();
?>

