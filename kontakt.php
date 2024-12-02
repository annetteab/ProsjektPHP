<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt Oss - Solsiden Motell</title>
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

        /* Header og navigasjon */
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

        /* Container */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Kontaktskjema */
        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #555;
        }

        input, textarea {
            width: 92%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            margin-top: 10px;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            margin-top: auto;
        }
    </style>
</head>
<body>

<header>
    <h1>Velkommen til Solsiden Motell</h1>
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
    <h2>Kontakt Oss</h2>
    <form action="kontakt.php" method="post">
        <label for="navn">Navn:</label>
        <input type="text" id="navn" name="navn" required>

        <label for="email">E-post:</label>
        <input type="email" id="email" name="email" required>

        <label for="telefon">Telefon:</label>
        <input type="tel" id="telefon" name="telefon" required>

        <label for="melding">Melding:</label>
        <textarea id="melding" name="melding" rows="5" required></textarea>

        <button type="submit">Send melding</button>
    </form>

    <?php
    // PHP-kode for å håndtere innsending av skjemaet
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Hent data fra skjemaet
        $navn = htmlspecialchars($_POST["navn"]);
        $email = htmlspecialchars($_POST["email"]);
        $telefon = htmlspecialchars($_POST["telefon"]);
        $melding = htmlspecialchars($_POST["melding"]);

        // E-postdetaljer
        $til = "kontakt@solsiden.no"; 
        $emne = "Ny melding fra kontaktskjemaet";
        $innhold = "Navn: $navn\nE-post: $email\nTelefon: $telefon\n\nMelding:\n$melding";
        $headers = "From: $email";

        // Send e-posten
        if (mail($til, $emne, $innhold, $headers)) {
            echo "<p style='color: green;'>Takk for at du kontaktet oss, $navn. Vi svarer så snart som mulig.</p>";
        } else {
            echo "<p style='color: red;'>Noe gikk galt. Vennligst prøv igjen senere.</p>";
        }
    }
    ?>
</div>

</body>
</html>
