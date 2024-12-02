<?php
session_start(); // Start sessionen for å håndtere innlogging

// Sjekk om brukeren er logget inn
if (!isset($_SESSION["bruker_id"])) {
    // Hvis ikke innlogget, omdiriger til login-siden
    header("Location: login.php");
    exit();
}

// Hent brukerens ID fra sesjonen
$bruker_id = $_SESSION["bruker_id"];

$user = [];

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

// Hent brukerens data fra databasen
$sql = "SELECT fornavn, etternavn, epost, mobil FROM users WHERE bruker_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bruker_id);
$stmt->execute();
$result = $stmt->get_result();



// Hvis brukeren finnes, hent dataene
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Bruker ikke funnet.";
    exit();
}

// Lukk tilkoblingen
$conn->close();

// Variabler for feilmeldinger
$firstnameErr = $lastnameErr = $emailErr = $phoneErr = "";
$newData = array();

// Håndterer skjemainnsending og validering
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider fornavn
    if (empty($_POST["fornavn"])) {
        $firstnameErr = "Navn er obligatorisk";
    } else {
        $newData["fornavn"] = test_input($_POST["fornavn"]);
        if (!preg_match("/^[a-zA-ZæøåÆØÅ' \-]*$/", $newData["fornavn"])) {
            $firstnameErr = "Kun bokstaver, bindestrek og mellomrom tillatt";
        }
    }

    // Valider etternavn
    if (empty($_POST["etternavn"])) {
        $lastnameErr = "Navn er obligatorisk";
    } else {
        $newData["etternavn"] = test_input($_POST["etternavn"]);
        if (!preg_match("/^[a-zA-ZæøåÆØÅ' \-]*$/", $newData["etternavn"])) {
            $lastnameErr = "Kun bokstaver, bindestrek og mellomrom tillatt";
        }
    }

    // Valider e-post
    if (empty($_POST["epost"])) {
        $emailErr = "E-post er obligatorisk";
    } else {
        $newData["epost"] = test_input($_POST["epost"]);
        if (!filter_var($newData["epost"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Ugyldig e-post format";
        }
    }

    // Valider mobilnummer
    if (empty($_POST["mobil"])) {
        $phoneErr = "Mobilnummer er obligatorisk";
    } else {
        $newData["mobil"] = test_input($_POST["mobil"]);
        if (!preg_match("/^[0-9]{8}$/", $newData["mobil"])) {
            $phoneErr = "Mobilnummer må være 8 siffer";
        }
    }

    // Hvis ingen feil, oppdater brukerens data i databasen
    if (empty($firstnameErr) && empty($lastnameErr) && empty($emailErr) && empty($phoneErr)) {
        // Opprett ny tilkobling for å oppdatere brukerens data
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Tilkobling feilet: " . $conn->connect_error);
        }

        // SQL for å oppdatere brukerens profil
        $sql = "UPDATE users SET fornavn = ?, etternavn = ?, epost = ?, mobil = ? WHERE bruker_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $newData["fornavn"], $newData["etternavn"], $newData["epost"], $newData["mobil"], $bruker_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Brukerprofilen er oppdatert.<br>";
        } else {
            echo "Ingen endringer ble gjort.<br>";
        }

        $conn->close();
    }
}

// Funksjon for å rense inputdata
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brukerprofil</title>
    <link rel="stylesheet" href="css/main.css"> <!-- Eksternt CSS-dokument -->
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

        .login-box {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .login-box input[type="text"], 
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-box input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
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
    <h1>Velkommen til Motell Solsiden</h1>
    <nav>
        <ul>
            <li><a href="index.php">Hjem</a></li>
            <li><a href="book.php">Bestill rom</a></li>
            <li><a href="about.php">Om Oss</a></li>
            <li><a href="contact.php">Kontakt</a></li>
            <li><a href="login.php">Logg inn</a></li>
            <li class="right-align"><a href="admin.php">Admin</a></li>
        </ul>
    </nav>
</header>

<h2>Oppdater brukerprofil</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="register-form">
        <label for="fornavn">Fornavn:</label>
        <input type="text" id="firstname" name="fornavn" value="<?php echo $user["fornavn"]; ?>">
        <span class="error"><?php echo $firstnameErr; ?></span>
       
        <label for="etternavn">Etternavn:</label>
        <input type="text" id="etternavn" name="etternavn" value="<?php echo $user["etternavn"]; ?>">
        <span class="error"><?php echo $lastnameErr; ?></span>
        
        <label for="epost">E-post:</label>
        <input type="text" id="epost" name="epost" value="<?php echo $user["epost"]; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
        
        <label for="mobil">Mobilnummer:</label>
        <input type="text" id="mobil" name="mobil" value="<?php echo $user["mobil"]; ?>">
        <span class="error"><?php echo $phoneErr; ?></span>
        
        <input type="submit" name="submit" value="Oppdater">
    </form>
<footer>
    <p>&copy; 2024 Motell Solsiden. Alle rettigheter forbeholdt.</p>
</footer>

</body>
</html>
