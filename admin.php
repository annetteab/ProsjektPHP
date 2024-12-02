<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Romadministrasjon</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .edit-link {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
        .edit-link:hover {
            text-decoration: underline;
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
            <li><a href="kontakt.php">Kontakt</a></li>
            <li><a href="gjesteprofil.php">Min profil</a></li>
            <li><a href="login.php">Logg inn</a></li>
            <li class="right-align"><a href="admin.php">Admin</a></li>
        </ul>
    </nav>
</header>

    <?php
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

 // Hvis admin er logget inn, vis siden
    session_start(); 

    if (isset($_SESSION['rolle']) && $_SESSION['rolle'] == 'admin') {
        echo "<p>Velkommen, " . $_SESSION['fornavn'] . "</p>";
    } else {
        die("Uautoriserte har ikke tilgang til denne siden.");
    }


    // SQL-spørring for å hente alle romdataene
    $sql = "SELECT Romnummer, Type, Beskrivelse, Pris, Maks_voksne, Maks_barn, Tilgjengelighet, innsjekk, utsjekk, Etasje, Nar_heis FROM Rom";
    $result = $conn->query($sql);

    // Sjekk om vi har resultater
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Romnummer</th><th>Type</th><th>Beskrivelse</th><th>Pris (NOK)</th><th>Maks Voksne</th><th>Maks Barn</th><th>Tilgjengelighet</th><th>Innsjekk</th><th>Utsjekk</th><th>Etasje</th><th>Nær Heis</th><th> </th></tr>";

        // Loop gjennom og vis hvert rom
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Romnummer"] . "</td>";
            echo "<td>" . $row["Type"] . "</td>";
            echo "<td>" . $row["Beskrivelse"] . "</td>";
            echo "<td>" . $row["Pris"] . "</td>";
            echo "<td>" . $row["Maks_voksne"] . "</td>";
            echo "<td>" . $row["Maks_barn"] . "</td>";
            echo "<td>" . $row["Tilgjengelighet"] . "</td>";
            echo "<td>" . $row["innsjekk"] . "</td>";
            echo "<td>" . $row["utsjekk"] . "</td>";
            echo "<td>" . $row["Etasje"] . "</td>";
            echo "<td>" . $row["Nar_heis"] . "</td>";
            echo "<td><a class='edit-link' href='edit_room.php?room=" . $row["Romnummer"] . "'>Rediger</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Ingen rom funnet.";
    }

    // Lukk tilkoblingen
    $conn->close();
    ?>
</body>
</html>
