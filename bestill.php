<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motell Booking</title>
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
    <h1>Tilgjengelige rom</h1>
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
session_start(); // Start sesjonen for å få tilgang til brukerdata

// Koble til databasen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "motell";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Tilkobling feilet: " . $conn->connect_error);
}

// Sjekk om romnummer er sendt via GET
if (isset($_GET['romnummer'])) {
    $romnummer = $_GET['romnummer'];

    // Hent romdetaljer fra databasen
    $sql = "SELECT type, pris FROM rom WHERE romnummer = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $romnummer);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $type = $row['type'];
        $pris = $row['pris'];
    } else {
        die("Rommet finnes ikke.");
    }

    // Vis bookingskjema
    echo "<h2>Book Romnummer: $romnummer</h2>";
    echo "<p>Romtype: $type</p>";
    echo "<p>Pris: $pris NOK</p>";

    // Hvis brukeren er logget inn, hent brukerdata fra sesjon
    if (isset($_SESSION['bruker_id'])) {
        $bruker_id = $_SESSION['bruker_id'];
        echo "<p>Velkommen, " . $_SESSION['fornavn'] . " " . $_SESSION['etternavn'] . "</p>";
    } else {
        die("Du må være logget inn for å fullføre bestillingen.");
    }

    // Bookingskjema
    echo "<form method='post' action='bestill.php'>";
    echo "<label for='check_in'>Innsjekk:</label>";
    echo "<input type='date' id='check_in' name='check_in' required><br><br>";

    echo "<label for='check_out'>Utsjekk:</label>";
    echo "<input type='date' id='check_out' name='check_out' required><br><br>";

    echo "<input type='hidden' name='romnummer' value='$romnummer'>";
    echo "<input type='submit' value='Fullfør Bestilling'>";
    echo "</form>";
} else {
    echo "Romnummer ikke funnet.";
    
}

// Behandle bestillingen når skjemaet er sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $romnummer = $_POST['romnummer'];
    $innsjekk = $_POST['check_in'];
    $utsjekk = $_POST['check_out'];
    $bruker_id = $_SESSION['bruker_id']; // Hent brukerens ID fra sesjonen

    // Sett inn bestillingen i databasen
    $sql = "INSERT INTO reservasjoner (romnummer, gjest_id, innsjekk, utsjekk) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $romnummer, $bruker_id, $innsjekk, $utsjekk);

    if ($stmt->execute()) {
        echo "Rommet er bestilt!<br>";
        echo "Innsjekk: $innsjekk - Utsjekk: $utsjekk";

        // Oppdater rommets tilgjengelighet til 'Opptatt'
        $update_sql = "UPDATE Rom SET Tilgjengelighet = 'Opptatt' WHERE Romnummer = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $romnummer);
        $update_stmt->execute();
        
        // Om ønskelig, kan du omdirigere til en bekreftelsesside:
        // header("Location: confirmation.php");
    } else {
        echo "Feil ved bestilling: " . $stmt->error;
    }

    $stmt->close();

}

// Lukk tilkoblingen etter at alt er utført
$conn->close();
?>
