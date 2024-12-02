<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt Oss - [Solsiden Motell]</title>
    <style>
        /* Enkel styling for å gjøre siden fin */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .contact-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
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
            width: 100%;
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
    </style>
</head>
<body>

<div class="contact-container">
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
