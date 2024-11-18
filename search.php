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
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Sørger for at hele høyden fylles */
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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1; /* Fyller opp ledig plass */
        }

        .search-box {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            width: 100%;
            position: relative; 
        }

        .available-rooms {
            margin-top: 20px;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<header>
    <h1>Tilgjengelige rom</h1>
    <nav>
        <ul>
            <li><a href="home.php">Hjem</a></li>
            <li><a href="booking.php">Bestill rom</a></li>
            <li><a href="about.php">Om Oss</a></li>
            <li><a href="contact.php">Kontakt</a></li>
            <li><a href="gjesteprofil.php">Min profil</a></li>
            <li><a href="login.php">Logg inn</a></li>
            <li class="right-align"><a href="admin.php">Admin</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h2>Søk etter rom</h2>
    <form method="post" action="search.php">
        <label for="checkin_date">Innsjekkingsdato:</label>
        <input type="date" id="checkin_date" name="check_in" required>

        <label for="checkout_date">Utsjekkingsdato:</label>
        <input type="date" id="checkout_date" name="check_out" required>

        <label for="adults">Antall voksne:</label>
        <input type="number" id="adults" name="adults" min="1" required>

        <label for="children">Antall barn:</label>
        <input type="number" id="children" name="children" min="0" value="0">

        <input type="submit" value="Søk">
    </form>
</div>

    <?php
    // Koble til databasen
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "motell"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Sjekk tilkoblingen
    if ($conn->connect_error) {
        die("Tilkobling feilet: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Få datoer og antall gjester fra skjemaet
        $innsjekk = $_POST['check_in'];
        $utsjekk = $_POST['check_out'];
        $adults = $_POST['adults'];
        $children = $_POST['children'];

        // SQL-spørring for å finne tilgjengelige rom
        $sql = "SELECT * FROM rom WHERE tilgjengelighet = 'ledig' AND maks_voksne >= ? AND maks_barn >= ? 
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
                // Lag en lenke for å booke rommet
                $romnummer = $row["Romnummer"];
                $type = $row["Type"];
                $pris = $row["Pris"];
        
                echo "<div class='available-rooms'>";
                echo "<p><a href='bestill.php?romnummer=$romnummer'>Romnummer: $romnummer - Type: $type - Pris: $pris NOK</a></p>";
                echo "</div>";
            }
        } else {
            echo "Ingen tilgjengelige rom for valgte datoer.";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</div>

<footer>
    <p>&copy; 2024 Motell Booking. Alle rettigheter reservert.</p>
</footer>

</body>
</html>
