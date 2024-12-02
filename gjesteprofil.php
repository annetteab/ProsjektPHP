<?php
session_start(); // Start sessionen for å håndtere innlogging

// Sjekk om brukeren er logget inn
if (!isset($_SESSION["bruker_id"])) {
    header("Location: login.php");
    exit();
}

// Hent brukerens ID fra sesjonen
$bruker_id = $_SESSION["bruker_id"];

// Database tilkoblingsdetaljer
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "motell";

// Hent brukerens data fra databasen
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Tilkobling feilet: " . $conn->connect_error);
}

$sql = "SELECT fornavn, etternavn, epost, mobil FROM users WHERE bruker_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bruker_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->num_rows > 0 ? $result->fetch_assoc() : [];
$conn->close();

// Variabler for feilmeldinger og data
$firstnameErr = $lastnameErr = $emailErr = $phoneErr = "";
$newData = [];

// Funksjon for validering
function test_input($data) {
    return htmlspecialchars(trim(stripslashes($data)));
}

// Skjemavalidering og oppdatering
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fornavn"])) {
        $firstnameErr = "Navn er obligatorisk";
    } else {
        $newData["fornavn"] = test_input($_POST["fornavn"]);
    }

    if (empty($_POST["etternavn"])) {
        $lastnameErr = "Navn er obligatorisk";
    } else {
        $newData["etternavn"] = test_input($_POST["etternavn"]);
    }

    if (empty($_POST["epost"])) {
        $emailErr = "E-post er obligatorisk";
    } elseif (!filter_var($_POST["epost"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Ugyldig e-post format";
    } else {
        $newData["epost"] = test_input($_POST["epost"]);
    }

    if (empty($_POST["mobil"])) {
        $phoneErr = "Mobilnummer er obligatorisk";
    } elseif (!preg_match("/^[0-9]{8}$/", $_POST["mobil"])) {
        $phoneErr = "Mobilnummer må være 8 siffer";
    } else {
        $newData["mobil"] = test_input($_POST["mobil"]);
    }

    if (empty($firstnameErr) && empty($lastnameErr) && empty($emailErr) && empty($phoneErr)) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Tilkobling feilet: " . $conn->connect_error);
        }

        $sql = "UPDATE users SET fornavn = ?, etternavn = ?, epost = ?, mobil = ? WHERE bruker_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $newData["fornavn"], $newData["etternavn"], $newData["epost"], $newData["mobil"], $bruker_id);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        header("Location: profil.php?success=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brukerprofil</title>
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
        header nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            padding: 0;
        }
        header nav ul li {
            margin: 0 15px;
        }
        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            color: #333;
        }
        form label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        form input[type="text"],
        form input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form .error {
            color: red;
            font-size: 0.9em;
        }
        form input[type="submit"] {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form input[type="submit"]:hover {
            background-color: #555;
        }
        .logout-button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF; /* blå knapp */
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
}

.logout-button:hover {
    background-color: #0262c9; /* Mørkere blå ved hover */
}
    </style>
</head>
<body>
<header>
    <h1>Motell Solsiden</h1>
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
    <h2>Oppdater Brukerprofil</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="fornavn">Fornavn:</label>
        <input type="text" id="fornavn" name="fornavn" value="<?php echo $user["fornavn"] ?? ''; ?>">
        <span class="error"><?php echo $firstnameErr; ?></span>

        <label for="etternavn">Etternavn:</label>
        <input type="text" id="etternavn" name="etternavn" value="<?php echo $user["etternavn"] ?? ''; ?>">
        <span class="error"><?php echo $lastnameErr; ?></span>

        <label for="epost">E-post:</label>
        <input type="text" id="epost" name="epost" value="<?php echo $user["epost"] ?? ''; ?>">
        <span class="error"><?php echo $emailErr; ?></span>

        <label for="mobil">Mobilnummer:</label>
        <input type="text" id="mobil" name="mobil" value="<?php echo $user["mobil"] ?? ''; ?>">
        <span class="error"><?php echo $phoneErr; ?></span>

        <input type="submit" value="Oppdater">
        <a href="logout.php" class="logout-button">Logg ut</a>
    </form>
</div>
</body>
</html>
